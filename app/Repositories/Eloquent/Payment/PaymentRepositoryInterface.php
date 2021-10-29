<?php


namespace App\Repositories\Eloquent\Payment;


use App\Models\Product;
use App\Repositories\Contracts\RepositoryInterface;

interface PaymentRepositoryInterface extends RepositoryInterface
{
    public function isOnline($paymentId);

}
