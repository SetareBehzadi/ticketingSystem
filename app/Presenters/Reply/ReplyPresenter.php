<?php

namespace App\Presenters\Reply;

use App\Helper\Format\DateFormat;
use App\Presenters\Contracts\Presenter;

class ReplyPresenter extends Presenter
{
    public function created_at()
    {
        $date = $this->entity->created_at;

        $shamsi = DateFormat::miladiToShamsi($date ,true);
        return $shamsi;
    }
}
