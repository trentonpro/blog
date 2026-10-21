<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Post $post): RedirectResponse
    {
        $comment = $post->comments()->make($request->validated());
        $comment->user()->associate($request->user());
        $comment->save();

        return redirect()->route('post', $post)->withFragment('comments');
    }
}
