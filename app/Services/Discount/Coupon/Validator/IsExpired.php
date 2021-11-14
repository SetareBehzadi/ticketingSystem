<?php
namespace App\Services\Discount\Coupon\Validator;

use App\Exceptions\CouponHasExpiredException;
use App\Models\Coupon;
use App\Services\Discount\Coupon\Validator\Contract\AbstractCouponValidator;
use Exception;

class IsExpired extends AbstractCouponValidator
{
    public function validate(Coupon $coupon)
    {
        //dd($coupon->IsExpired());
       if($coupon->IsExpired()){
           return new CouponHasExpiredException('زمان استفاده از این کد تخفیف به پایان رسیده است.');
       }
       return parent::validate($coupon);

    }
    
}
