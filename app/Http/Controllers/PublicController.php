<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PublicController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'images'])->latest()->simplePaginate(16);

        return view('welcome', compact('posts'));
    }

    public function buttons()
    {
        return view('buttons');
    }

    public function post(Post $post)
    {
        $post->load(['user', 'images', 'comments.user']);

        return view('post', compact('post'));
    }
}
