<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    function redirect()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return Socialite::driver('google')->redirect();
    }

    function callback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $socialAccount = $this->userService->findByEmail($user->getEmail());

        if ($socialAccount && $socialAccount->is_google_account) {
            Auth()->login($socialAccount);
            return redirect()->route('home');
        } else if ($socialAccount && !$socialAccount->is_google_account) {
            return redirect()->route('login')
                ->withErrors([
                    'error' => 'You already registered using email address please login using password instead!'
                ]);
        } else {
            $lastId = $this->userService->lastId() + 1;
            $username = 'realfans' . $lastId;

            $savedUser = $this->userService->create([
                'name' => $user->getName(),
                'username' => $username,
                'email' => Str::lower($user->getEmail()),
                'is_google_account' => true,
                'password' => Hash::make($username)
            ]);
            Auth()->login($savedUser);
            return redirect()->route('home');
        }
    }
}
