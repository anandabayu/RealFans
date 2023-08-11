<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function create($user)
    {
        return User::create($user);
    }

    public function update(User $user)
    {
        return $user->save();
    }

    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function findByUsername(string $username)
    {
        return User::where('username', $username)->first();
    }

    public function lastId() {
        return User::max('id');
    }

    public function findWhoToFollow()
    {
        $user = Auth::user();

        return User::where('id', '!=', $user->id)
            ->inRandomOrder()->limit(5)->get();
    }
}
