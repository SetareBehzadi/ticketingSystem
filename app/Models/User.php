<?php

namespace App\Models;

use App\Jobs\sendEmail;
use App\Mail\ResetPassword;
use App\Mail\VerificationEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function replies()
    {
        return $this->morphMany(Reply::class,'repliable');
    }

    public function isAdmin()
    {
        return $this instanceof TicketAdmin;
    }

    public function sendEmailVerificationNotification()
    {
      /*  dd('sss');*/
            sendEmail::dispatch($this , new VerificationEmail($this));
    }

    public function sendPasswordResetNotification($token)
    {
            SendEmail::dispatch($this,new ResetPassword($this,$token));
    }
}
