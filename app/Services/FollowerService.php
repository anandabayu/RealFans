<?php

namespace App\Services;

use App\Models\User;
use App\Models\Follower;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FollowerService
{
    public function follow(User $user)
    {
        return Follower::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'follow_to_id' => $user->id
            ],
            [
                'user_id' => Auth::user()->id,
                'follow_to_id' => $user->id
            ]
        );
    }

    public function unfollow(User $user)
    {
        $follower = Follower::where('user_id', Auth::user()->id)
            ->where('follow_to_id', $user->id)->first();

        if ($follower && (!$follower->is_subscribe || $follower->subscription_expiry < Carbon::now())) {
            $follower->delete();

            return 1;
        } else if ($follower && $follower->is_subscribe) {
            return 2;
        }

        return 0;
    }

    public function subscribe(User $user)
    {
        return Follower::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'follow_to_id' => $user->id
            ],
            [
                'user_id' => Auth::user()->id,
                'follow_to_id' => $user->id,
                'is_subscribe' => true,
                'subscription_expiry' => Carbon::now()->addDays(30)
            ]
        );
    }
}
