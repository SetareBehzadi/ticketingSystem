<?php

namespace App\Presenters\Products;

use App\Helper\Format\Number;
use App\Presenters\Contracts\Presenter;

class ProductPresenter extends presenter
{
    public function productPrice()
    {
       return  Number::PersianNumbers(number_format($this->entity->price)).' '.__('payment.toman');
    }

    public function productQuantity()
    {
        return  Number::PersianNumbers($this->entity->quantity);
    }

}
