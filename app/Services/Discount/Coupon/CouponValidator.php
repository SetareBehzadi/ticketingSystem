<?php

namespace App\Services\Discount\Coupon;

use App\Models\Coupon;
use App\Services\Discount\Coupon\Validator\CanUseIt;
use App\Services\Discount\Coupon\Validator\IsExpired;

class CouponValidator
{
    public function isValid(Coupon $coupon)
    {
       $isExpired = resolve(IsExpired::class);
       $canUseIt = resolve(CanUseIt::class);

       $isExpired->nextValidator($canUseIt);
       
       return $isExpired->validate($coupon);
    }
}
