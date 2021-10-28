<?php

namespace App\Repositories\Eloquent\Payment;

use App\Models\Payment;
use App\Repositories\Contracts\EloquentBaseRepository;


class EloquentPaymentRepository extends EloquentBaseRepository implements PaymentRepositoryInterface
{

    protected $model = Payment::class;


}
