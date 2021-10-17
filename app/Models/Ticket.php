<?php

namespace App\Models;

use App\Presenters\Contracts\Presentable;
use App\Presenters\Tickets\TicketPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ticket extends Model
{
    use HasFactory,Presentable;

    protected $presenter = TicketPresenter::class;

    protected $table = 'tickets';
    protected $fillable = [
        'ticket_number','title','department_id','message','file_path','priority','status'
    ];

    protected $attributes = [
        'status' => 0
    ];
    const LOW = 0;
    const MID = 1;
    const HIGH = 2;

    public function getPriority()
    {
        return [
            self::LOW => 'پایین',
            self::MID => 'متوسط',
            self::HIGH => 'بالا',
        ];
    }
  /*  public function department()
    {
        return $this->belongsTo(Department::class);
    }*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPriorityAttribute($value)
    {
        return $this->getPriority()[$value];

    }

    public function hasFile()
    {

        return !is_null($this->file_path);
    }

    public function file()
    {
        return $this->hasFile()?Storage::url($this->file_path):null;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function isCreated()
    {
        return $this->status == 0;
    }
    public function isReplied()
    {
      $this->status = 1;
      $this->save();
    }

    public function close()
    {
        $this->status = 2;
        $this->save();
    }

    public function isClosed()
    {
        return $this->status == 2;
    }

    public function lastRecord()
    {
        return self::latest()->first();
    }
}
