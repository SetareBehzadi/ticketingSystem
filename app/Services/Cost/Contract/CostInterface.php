<?php
namespace App\Services\Cost\Contract;

interface CostInterface
{
    public function getCost();
    public function getTotalCosts();
    public function PersianDescription();
    public function getSummery(); // mishe description,value ham hazinash mishe
}