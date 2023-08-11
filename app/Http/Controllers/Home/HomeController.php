<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** @var UserService */
    private $userService;

    /** @var PostService */
    private $postService;

    public function __construct(UserService $userService, PostService $postService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->postService = $postService;
    }

    public function index()
    {
        $whoToFollow = $this->userService->findWhoToFollow();
        $contents = $this->postService->findHomeContent();

        $data = [
            'whoToFollow' => $whoToFollow,
            'contents' => $contents
        ];

        return view('pages/home/index', $data);
    }
}
