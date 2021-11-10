<?php

namespace App\Services\Basket;

use App\Exceptions\QuantityException;
use App\Models\Product;
use App\Repositories\Eloquent\Product\ProductRepositoryInterface;
use App\Services\Storage\Contracts\StorageInterface;

class Basket
{

    private $sessionStorage;
    private $productRepository;

    /**
     * @param $sessionStorage
     */
    public function __construct(StorageInterface $sessionStorage,ProductRepositoryInterface $productRepository)
    {
        $this->sessionStorage = $sessionStorage;
        $this->productRepository = $productRepository;
    }

    public function addToBasket(Product $product,int $quantity)
    {
        if ($this->has($product)){
            $quantity = $this->get($product)['quantity'] + $quantity;
        } 
        $this->update($product,$quantity);

    }

    public function has(Product $product)
    {
        return $this->sessionStorage->exists($product->id);
    }

    public function get(Product $product)
    {
        return $this->sessionStorage->get($product->id);
    }

    public function update(Product $product,int $quantity)
    {

        if (!$quantity){
            return   $this->sessionStorage->unset($product->id);
        }


        if (! $this->productRepository->checkStock($product,$quantity)){
            throw new QuantityException();
        }


        $this->sessionStorage->set($product->id,['quantity'=>$quantity]);

    }

    public function itemCount()
    {
        return $this->sessionStorage->count();
    }

    public function all()
    {

       $products =  $this->productRepository->findProductsByArrayOfData('id',array_keys($this->sessionStorage->all()));
       foreach ($products as $product){
           $product['quantity'] = $this->sessionStorage->get($product->id)['quantity'];
       }

       return $products;

    }

    public function subTotal()
    {
        $total = 0;
        foreach ($this->all() as $item){
            $total += $item['price']* $item['quantity'];
        }

        return $total;
    }

    public function clear()
    {
        $this->sessionStorage->clear();
    }

}
