<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'caption',
        'user_id',
        'is_locked'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function isVisible()
    {
        $user = Auth::user();

        if ($this->user_id == $user->id) return true;

        if ($this->is_locked) return $user->isSubscribe($this->user);

        return true;
    }

    public function getImageAttribute($value)
    {
        if (!$this->isVisible()) {
            return "default/locked.png";
        }

        return "posts/".$value;
    }
}
