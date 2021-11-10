<?php
namespace App\Services\Discount\Coupon\Validator;

use App\Models\Coupon;
use App\Services\Discount\Coupon\Validator\Contract\AbstractCouponValidator;
use Exception;

class IsExpired extends AbstractCouponValidator
{
    public function validate(Coupon $coupon)
    {
        dd($coupon->IsExpired());
       if($coupon->IsExpired){
        dd($coupon->IsExpired);
           return new Exception();
       }

    }
    
}
