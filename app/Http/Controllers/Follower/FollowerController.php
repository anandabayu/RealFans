<?php

namespace App\Http\Controllers\Follower;

use App\Http\Controllers\Controller;
use App\Services\FollowerService;
use App\Services\UserService;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    private $userService;
    private $followerService;

    public function __construct(
        UserService $userService,
        FollowerService $followerService
    ) {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->followerService = $followerService;
    }

    public function follow(Request $request, string $username)
    {
        $userToFollow = $this->userService->findByUsername($username);

        if ($userToFollow != null) {
            $this->followerService->follow($userToFollow);
        }

        return back()->with('message',"Success following " . $username);
    }

    public function unfollow(Request $request, string $username)
    {
        $userToFollow = $this->userService->findByUsername($username);

        if ($userToFollow != null) {
            $result = $this->followerService->unfollow($userToFollow);

            if ($result == 2) {
                return back()->withErrors([
                    'error' => "Can't unfollow this user because your subscription is still active"
                ]);
            } else if ($result == 0) {
                return back()->withErrors([
                    'error' => "Can't unfollow this user because you are not following them yet"
                ]);
            }
        }

        return back()->with('message',"Success unfollowing " . $username);
    }

}
