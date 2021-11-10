<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public function IsExpired()
    {
       return Carbon::now()->isAfter(Carbon::parse($this->exire_time));
    }
}