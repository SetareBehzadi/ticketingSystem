<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class TicketAdmin extends Authenticatable
{
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = 'ticket_admins';
    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id'
    ];
    protected $guarded = 'ticket_admin';

    public function tickets()
    {
        return $this->hasMany(Ticket::class,'department_id','department_id');
    }

    public function replies()
    {
        return $this->morphMany(Reply::class,'repliable');
    }

    public function isAdmin()
    {
        return $this instanceof TicketAdmin;
    }
}
