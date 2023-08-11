<?php

namespace App\Services;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function create($post)
    {
        return Post::create($post);
    }

    public function findHomeContent()
    {
        $myPosts = Post::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc');

        $posts = Post::select('posts.*')
            ->join('follower', 'follower.follow_to_id', '=', 'posts.user_id')
            ->where('follower.user_id', Auth::user()->id)
            ->union($myPosts)
            ->orderBy('created_at', 'desc')->get();

        return $posts;
    }
}
