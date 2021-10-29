<?php

namespace App\Repositories\Eloquent\Order;

use App\Models\Order;
use App\Repositories\Contracts\EloquentBaseRepository;



class EloquentOrderRepository extends EloquentBaseRepository implements OrderRepositoryInterface
{

    protected $model = Order::class;


    public function getOrderByResNumber($resNumber)
    {
        $query = $this->model::query();
       return $query->where('code', $resNumber)->firstOrFail();
    }
}
