<?php

namespace App\Http\Controllers\FrontEnd;

use App\Exceptions\QuantityException;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Basket\Basket;
use App\Services\Payment\Transaction;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    private $basket;
    private $transactionService;

    public function __construct(Basket $basket,Transaction $transaction)
    {
        $this->middleware('auth')->only(['checkoutForm', 'checkout']);
        $this->basket = $basket;
        $this->transactionService = $transaction;
    }

    public function index()
    {
        $items = $this->basket->all();

        return view('FrontEnd.Basket.basket',compact('items'));
    }

    public function add(Product $product)
    {

        try {
            $this->basket->addToBasket($product,1);

            return back()->with('success',__('payment.added to basket'));
        }catch (QuantityException $e){
            return  back()->with('error', __('payment.quantity exceeded'));
        }

    }

    public function update(Request $request,Product $product)
    {
      //  dd((int) $request->quantity);
        $this->basket->update($product,(int) $request->quantity);
        return back();
    }

    public function checkoutForm()
    {
        return view('FrontEnd.Basket.checkout');
    }

    public function checkout(Request $request)
    {
        $this->validateForm($request);
       $order = $this->transactionService->checkout();

       return redirect()->route('web.basket.index')->with('success',__('payment.your order has been registered',['orderNum' => $order->id]));
    }

    private function validateForm($request)
    {
        $request->validate([
            'method' => ['required'],
            'gateway' =>['required_if:method,online']
        ]);


    }

}
