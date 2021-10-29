<?php

namespace App\Services\Payment\Gateways;

use App\Models\Order;
use App\Repositories\Eloquent\Order\OrderRepositoryInterface;
use App\Services\Payment\Gateways\Contracts\GatewayFactoryInterface;
use Illuminate\Http\Request;

class Saman implements GatewayFactoryInterface
{
    private $merchantId;
    private $callback;

    /**
     * @param $merchantId
     * @param $callback
     */
    public function __construct()
    {
        $this->merchantId = '452585658';
        $this->callback = route('web.payment.verify', $this->getGatewayName());
    }


    public function pay(Order $order)
    {

        $this->redirectToBank($order);
    //    dd('end of payment');
    }

    private function redirectToBank($order)
    {
        $amount = $order->amount + 10000;
        echo "<form id='samanpeyment' action='https://sep.shaparak.ir/payment.aspx' method='post'>
		<input type='hidden' name='Amount' value='{$amount}' />
		<input type='hidden' name='ResNum' value='{$order->code}'>
		<input type='hidden' name='RedirectURL' value='{$this->callback}'/>
		<input type='hidden' name='MID' value='{$this->merchantId}'/>
		</form><script>document.forms['samanpeyment'].submit()</script>";

       /* exit();*/
    }
    public function verify(Request $request)
    {
      /*   if (!$request->has('State') || $request->input('State') !== "OK") {
             return $this->transactionFailed();
         }*/

        $soapClient = new \SoapClient('https://acquirer.samanepay.com/payments/referencepayment.asmx?WSDL');

        $response = $soapClient->VerifyTransaction($request->input('RefNum'), $this->merchantId);

        $order = $this->getOrder($request->input('ResNum'));
        $response = $order->amount + 10000;
        $request->merge(['RefNum' => '45852525']);

        return $response == ($order->amount + 10000)
            ? $this->transactionSuccess($order, $request->input('RefNum'))
            : $this->transactionFailed();

    }

    private function getOrder($resNum)
    {
        $orderRepo = resolve(OrderRepositoryInterface::class);
        return $orderRepo->getOrderByResNumber($resNum);

    }

    private function transactionSuccess($order, $refNum)
    {
        return [
            'status' => self::TRANSACTION_SUCCESS,
            'order' => $order,
            'refNum' => $refNum,
            'gateway' => $this->getGatewayName()
        ];
    }

    private function transactionFailed()
    {
        return [
            'status' => self::TRANSACTION_FAILED
        ];
    }

    public function getGatewayName(): string
    {
        return 'saman';
    }
}
