<?php

namespace App\Services\Payment\Gateways\Contracts;

use App\Models\Order;
use Illuminate\Http\Request;

interface GatewayFactoryInterface
{
    const TRANSACTION_FAILED = 'transaction.failed';
    const TRANSACTION_SUCCESS = 'transaction.success';


    public function pay(Order $order , $amount);
    public function verify(Request $request);
    public function getGatewayName(): string;
}
