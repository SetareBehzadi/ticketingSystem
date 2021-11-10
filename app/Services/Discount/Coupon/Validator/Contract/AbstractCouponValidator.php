<?php

namespace App\Services\Discount\Coupon\Validator\Contract;

use App\Models\Coupon;

abstract class AbstractCouponValidator implements CouponValidatorInterface
{
    private $nextValidator;
    
    public function setNextValidator(CouponValidatorInterface $validator){
        $this->nextValidator = $validator;
    }
   
    public function validate(Coupon $coupon)
    {

        dd($coupon);

        if($this->nextValidator === null){
            return true;
        }

        return $this->nextValidator->validate($coupon);

    }


}

