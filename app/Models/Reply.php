<?php

namespace App\Models;

use App\Presenters\Contracts\Presentable;
use App\Presenters\Reply\ReplyPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory,Presentable;

    protected $presenter = ReplyPresenter::class;


    protected $table = 'replies';
    protected $fillable = ['ticket_id','comment','repliable_type','repliable_id'];
    public function repliable()
    {
        return $this->morphTo();
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
