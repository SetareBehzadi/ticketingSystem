<?php

namespace App\Services\Cost;

use App\Services\Cost\Contract\CostInterface;

class TaxCost implements CostInterface
{

    const TAX_COST = 0.09;

    private $cost;

    public function __construct(CostInterface $cost)
    {
        $this->cost = $cost;
    }

    public function getCost()
    {
        return $this->cost->getCost() * 0.09;
    }

    public function getTotalCosts()
    {
        return $this->cost->getTotalCosts() + $this->getCost();
    }

    public function PersianDescription()
    {
        return 'مالیات 9 درصد';
    }

    public function getSummery()
    {
        return array_merge($this->cost->getSummery(), [$this->PersianDescription() => $this->getCost()]);
    }
}
