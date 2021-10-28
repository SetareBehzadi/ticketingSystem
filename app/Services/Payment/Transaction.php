<?php

namespace App\Services\Payment;

use App\Helper\Hash\HashGenerator;
use App\Models\Order;
use App\Repositories\Eloquent\Order\OrderRepositoryInterface;
use App\Repositories\Eloquent\Payment\PaymentRepositoryInterface;
use App\Services\Basket\Basket;
use Illuminate\Http\Request;

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
      $order = $this->makeOrder();

      $payment = $this->makePayment($order);

      $this->basket->clear();

      return $order;
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

}
