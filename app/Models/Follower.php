<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Follower extends Model
{
    use HasFactory;

    protected $table = 'follower';

    protected $fillable = [
        'user_id',
        'follow_to_id',
        'is_subscribe',
        'subscription_expiry'
    ];

    public $timestamps = false;

    public function userToFollow(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userWhoFollow(): BelongsTo
    {
        return $this->belongsTo(User::class, 'follow_to_id', 'id');
    }
}
