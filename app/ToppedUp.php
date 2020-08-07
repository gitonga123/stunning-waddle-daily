<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToppedUp extends Model
{
    
    protected $fillable = [
        'user_id',
        'balanced',
        'amount'
    ];

    /**
     * Get user
     * 
     * @return mixed
     */
    public function user()
    {
        return $this->BelongsTo(User::class, 'user_id');
    }
}
