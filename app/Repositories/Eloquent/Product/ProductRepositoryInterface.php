<?php


namespace App\Repositories\Eloquent\Product;


use App\Models\Product;
use App\Repositories\Contracts\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function checkStock(Product $product , int $quantity):bool; //check mojodi

    public function findProductsByArrayOfData(string $column,array $data);

}
