<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginRegisterController extends Controller
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('pages');
        }
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
    }



    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('pages');
        }
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request['username'] = Str::lower($request->username);
        $request['email'] = Str::lower($request->email);

        $request->validate([
            'name' => 'required|string|max:250',
            'username' => 'required|regex:/^[a-zA-Z0-9]+$/u|string|min:4|max:20|unique:users',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $this->userService->create([
            'name' => $request->name,
            'username' => Str::lower($request->username),
            'email' => Str::lower($request->email),
            'is_google_account' => false,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }
}
