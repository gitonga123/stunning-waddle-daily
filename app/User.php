<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get top up numbers
     * 
     * @return mixed
     */
    public function topUpNumbers()
    {
        return $this->hasMany(TopUpNumbers::class, 'user_id');
    }

    /**
     * Get top up numbers
     * 
     * @return mixed
     */
    public function toppedAmount()
    {
        return $this->hasMany(ToppedUp::class, 'user_id');
    }


}
