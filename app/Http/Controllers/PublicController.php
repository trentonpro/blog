<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;

class PublicController extends Controller
{
    public function index()
    {
        $posts = Schema::hasTable('posts')
            ? Post::query()->simplePaginate(16)
            : new LengthAwarePaginator([], 0, 16, 1);

        return view('welcome', compact('posts'));
    }

    public function buttons()
    {
        return view('buttons');
    }

    public function post(Post $post) {
        return view('post', compact('post'));

    }
}