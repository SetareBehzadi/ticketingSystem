<?php

namespace App\Services\Payment;

use App\Events\OrderRegistered;
use App\Helper\Hash\HashGenerator;
use App\Models\Order;
use App\Repositories\Eloquent\Order\OrderRepositoryInterface;
use App\Repositories\Eloquent\Payment\PaymentRepositoryInterface;
use App\Repositories\Eloquent\Product\ProductRepositoryInterface;
use App\Services\Basket\Basket;
use App\Services\Payment\Gateways\Contracts\GatewayFactoryInterface;
use App\Services\Payment\Gateways\Pasargad;
use App\Services\Payment\Gateways\Saman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Transaction
{
    private $request;
    private $basket;

    /**
     * @param $request
     * @param $basket
     */
    public function __construct(Request $request,Basket $basket)
    {
        $this->request = $request;
        $this->basket = $basket;
    }

    public function checkout()
    {
        DB::beginTransaction();

        try {
            $order = $this->makeOrder();

            $payment = $this->makePayment($order);

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return  $exception->getMessage();
        }

        $paymentRepo = resolve(PaymentRepositoryInterface::class);
      /*  dd(($paymentRepo->isOnline($payment->id))?1:0);*/
        if($paymentRepo->isOnline($payment->id) ) {

           return $this->gatewayFactory()->pay($order);
        }

        $this->completeOrder($order);

        return $order;
    }

    private function gatewayFactory()
    {
        $gateway = [
            'saman' => Saman::class,
            'pasargad' => Pasargad::class
        ][$this->request->gateway];

        return resolve($gateway);

    }

    private function makeOrder()
    {
        $orderRepo = resolve(OrderRepositoryInterface::class);
       $order =  $orderRepo->store([
            'user_id' => auth()->user()->id,
            'code' => HashGenerator::make(16),
            'amount' => $this->basket->subTotal(),
                    ]);
        $order->products()->attach($this->products());

       return $order;

    }

    private function makePayment(Order $order)
    {
        $paymentRepo = resolve(PaymentRepositoryInterface::class);
        $payment = $paymentRepo->store([
            'order_id' => $order->id,
            'payment_method' => $this->request['method'],
            'amount' => $order->amount

        ]);
       return $payment;
    }

    private function products()
    {
        foreach ($this->basket->all() as $product){
            $products[$product['id']] = ['quantity'=>$product->quantity];
        }

        return $products;
    }

    public function verify()
    {
        $result = $this->gatewayFactory()->verify($this->request);

        if ($result['status'] === GatewayFactoryInterface::TRANSACTION_FAILED) return false;
        $this->confirmPayment($result);

        $this->completeOrder($result['order']);


        return true;
    }

    private function confirmPayment($result)
    {
        return $result['order']->payment->confirm($result['refNum'], $result['gateway']);
    }
    private function completeOrder($order)
    {

        $this->normalizeQuantity($order);

        event(new OrderRegistered($order));

        $this->basket->clear();
    }


    private function normalizeQuantity($order)
    {
        $productRepo = resolve(ProductRepositoryInterface::class);
        foreach ($order->products as $product) {
            $productRepo->decrementStock($product->id,(int) $product->pivot->quantity);
        }
    }


}
