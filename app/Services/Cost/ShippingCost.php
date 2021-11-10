<?php

namespace App\Services\Cost;

use App\Services\Cost\Contract\CostInterface;

class ShippingCost implements CostInterface
{

    const SHIPING_COST = 2000;

    private $cost;

    public function __construct(CostInterface $cost)
    {
        $this->cost = $cost;
    }

    public function getCost()
    {
        return self::SHIPING_COST;
    }

    public function getTotalCosts()
    {
        return $this->cost->getTotalCosts() + $this->getCost();
    }

    public function PersianDescription()
    {
        return 'هزینه حمل و نقل';
    }

    public function getSummery()
    {
        return array_merge($this->cost->getSummery(), [$this->PersianDescription() => $this->getCost()]);
    }
}
