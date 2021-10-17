<?php

namespace App\Presenters\Tickets;

use App\Helper\Format\DateFormat;
use App\Helper\Format\Number;
use App\Presenters\Contracts\Presenter;

class TicketPresenter extends Presenter
{

    public function status()
    {
        $status = $this->entity->status;

        switch ($status) {
            case 0:
               return 'باز';
            case 1:
                return 'پاسخ داده شد';
            case 2:
                return 'بسته ';
            default:
                throw new \Exception('something is wrong');
        }
    }

    public function created_at()
    {
        $date = $this->entity->created_at;

        $shamsi = DateFormat::miladiToShamsi($date ,true);
        return $shamsi;
    }

    public function ticket_number()
    {
        return Number::PersianNumbers($this->entity->ticket_number);
    }
}
