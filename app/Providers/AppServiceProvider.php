<?php

namespace App\Providers;

use App\Services\Basket\Basket;
use App\Services\Cost\Contract\CostInterface;
use App\Services\Storage\Contracts\StorageInterface;
use App\Services\Storage\SessionStorage;
use App\Services\Cost\Contract\BasketCost;
use App\Services\Cost\ShippingCost;
use App\Services\Cost\TaxCost;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(StorageInterface::class,function ($app){
            return new SessionStorage('cart');
        });

        $this->app->bind(CostInterface::class,function ($app){
            $basketCost =new BasketCost($app->make(Basket::class));
            $taxCost = new TaxCost($basketCost);
            $shippingCost = new ShippingCost($taxCost);
            return $shippingCost;
        });
    }
}
