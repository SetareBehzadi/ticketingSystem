<?php

namespace App\Models;

use App\Presenters\Contracts\Presentable;
use App\Presenters\Products\ProductPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,Presentable;

    protected $presenter = ProductPresenter::class;
    protected $table = 'products';
    protected $fillable = ['title','description','price','image','stock'];

    public function Orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
}
