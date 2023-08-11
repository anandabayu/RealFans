<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'avatar',
        'is_google_account',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function follower(): HasMany
    {
        return $this->hasMany(Follower::class, 'follow_to_id', 'id');
    }

    public function following(): HasMany
    {
        return $this->hasMany(Follower::class, 'user_id', 'id');
    }

    public function isFollowing(User $user)
    {
        return !! $this->following()->where('follow_to_id', $user->id)->count();
    }

    public function isSubscribe(User $user)
    {
        $follower = $this->following()
            ->where('user_id', $this->id)
            ->where('follow_to_id', $user->id)
            ->first();

        if ($follower != null && $follower->is_subscribe && $follower->subscription_expiry > Carbon::now())
        {
            return true;
        }

        return false;
    }

    public function getSubscriptionEndDate(User $user)
    {
        $follower = $this->following()
            ->where('user_id', $this->id)
            ->where('follow_to_id', $user->id)
            ->first();

        return Carbon::parse($follower->subscription_expiry)->format('d M Y');
    }

    public function getAvatarAttribute($value)
    {
        if (is_null($value)) {
            return "default/avatar.jpeg";
        }

        return "avatar/".$value;
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'id')
            ->orderBy('created_at', 'desc');
    }
}
