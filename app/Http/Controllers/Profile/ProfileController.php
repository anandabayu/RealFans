<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
    }

    public function index()
    {
        return view('pages/profile/index');
    }

    public function changeAvatar(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],
        [
            'image.uploaded' => 'Failed to upload an image. The image maximum size is 2MB.'
        ]);

        $fileName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images/avatar', $fileName);

        $user = Auth::user();
        $user->avatar = $fileName;

        $this->userService->update($user);

        Auth::setUser($user);

        return back()->with('message',"Avatar updated successfully");
    }

    public function changeInfo(Request $request)
    {
        $request['username'] = Str::lower($request->username);

        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:250',
            'username' => 'required|regex:/^[a-zA-Z0-9]+$/u|string|min:4|max:20|unique:users,username,'.$user->id
        ]);

        $user->name = $request->name;
        $user->username = $request->username;

        $this->userService->update($user);

        Auth::setUser($user);

        return back()->with('message',"Info updated successfully");
    }

    public function followers()
    {
        $followers = Auth::user()->follower;
        $following = Auth::user()->following;

        $data = [
            'followers' => $followers,
            'following' => $following
        ];

        return view('pages/profile/follower', $data);
    }
}
