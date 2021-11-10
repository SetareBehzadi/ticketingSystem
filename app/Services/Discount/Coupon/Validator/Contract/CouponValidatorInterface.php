<?php
namespace App\Services\Discount\Coupon\Validator\Contract;

use App\Models\Coupon;

interface CouponValidatorInterface
{
    public function setNextValidator(CouponValidatorInterface $validator);
   
    public function validate(Coupon $coupon);
}