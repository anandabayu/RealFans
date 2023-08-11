<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /** @var UserService */
    private $userService;
    private $postService;

    public function __construct(
        UserService $userService,
        PostService $postService
    ) {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->postService = $postService;
    }

    public function post(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'caption' => 'required|string|max:255',
        ],
        [
            'image.uploaded' => 'Failed to upload an image. The image maximum size is 2MB.'
        ]);

        $fileName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images/posts', $fileName);

        $this->postService->create([
            'image' => $fileName,
            'caption' => $request->caption,
            'user_id' => Auth::user()->id,
            'is_locked' => (bool)$request->is_checked
        ]);

        return back()->with('message',"Your content has been posted!");
    }
}
