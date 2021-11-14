<?php
namespace App\Services\Discount\Coupon\Validator;

use App\Exceptions\CouponCanUseException;
use App\Models\Coupon;
use App\Services\Discount\Coupon\Validator\Contract\AbstractCouponValidator;

class CanUseIt extends AbstractCouponValidator
{
    public function validate(Coupon $coupon)
    {
    
       if($coupon->CanUseIt()){
           return new CouponCanUseException('زمان استفاده از این کد تخفیف به پایان رسیده است.');
       }
       return parent::validate($coupon);

    }
    
}
