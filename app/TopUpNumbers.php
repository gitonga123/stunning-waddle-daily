<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopUpNumbers extends Model
{
    protected $fillable = [
        'phone_number',
        'user_id',
        'top_up_time',
        'amount',
        'published'
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
