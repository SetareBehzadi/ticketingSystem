<?php
namespace App\Services\Cost\Contract;

use App\Services\Basket\Basket;
use App\Services\Cost\Contract\CostInterface;

class BasketCost implements CostInterface
{
    private $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;    
    }

    public function getCost(){
        return $this->basket->subTotal();
    }

    public function getTotalCosts()
    {
        return $this->getCost();
    }

    public function PersianDescription()
    {
        return 'سبد خرید';
    }

    public function getSummery()
    {
        return [$this->PersianDescription() => $this->getCost()];
    }

}