<?php

namespace App\Services\Payment\Gateways;

use App\Models\Order;
use App\Services\Payment\Gateways\Contracts\GatewayFactoryInterface;
use Illuminate\Http\Request;

class Pasargad implements GatewayFactoryInterface
{

    public function pay(Order $order)
    {
        dd('Pasargad Payment');
    }

    public function verify(Request $request)
    {
        // TODO: Implement verify() method.
    }

    public function getGatewayName(): string
    {
        return 'Pasargad';
    }
}
