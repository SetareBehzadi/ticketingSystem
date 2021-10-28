<?php

namespace App\Repositories\Eloquent\Product;

use App\Models\Product;
use App\Repositories\Contracts\EloquentBaseRepository;


class EloquentProductRepository extends EloquentBaseRepository implements ProductRepositoryInterface
{

    protected $model = Product::class;

    /**
     * @param int $quantity
     * @return bool
     */
    public function checkStock(Product $product , int $quantity):bool
    {
        $query = $this->model::find($product->id);
       return $query->stock >= $quantity;
    }

    public function findProductsByArrayOfData(string $column,array $data)
    {
        $query = $this->model::query();
       return $query-> whereIn($column, $data)->get();

    }
}
