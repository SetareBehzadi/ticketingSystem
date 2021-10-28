<?php

namespace App\Repositories\Eloquent\Order;

use App\Models\Order;
use App\Repositories\Contracts\EloquentBaseRepository;



class EloquentOrderRepository extends EloquentBaseRepository implements OrderRepositoryInterface
{

    protected $model = Order::class;


}
