<?php

namespace App\Providers;


use App\Repositories\Eloquent\Order\EloquentOrderRepository;
use App\Repositories\Eloquent\Payment\EloquentPaymentRepository;
use App\Repositories\Eloquent\Payment\PaymentRepositoryInterface;
use App\Repositories\Eloquent\Product\EloquentProductRepository;
use App\Repositories\Eloquent\Order\OrderRepositoryInterface;
use App\Repositories\Eloquent\Product\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, EloquentOrderRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, EloquentPaymentRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
