@extends('partials.layout')
@section('content')
    <div class="container mx-auto">
        @include('partials.post-card')
        <h1>>Comments:</h1>
        @foreach ($post->comments as $comment)
            <div class="card bg-base-300 shadow-sm">
                <div class="card-body">
                    <p>{ $comment->body }</p>

                    <span class="text-base-content/70">{{ $post->user?->name ?? __('Unknown author') }}</span>
                    <span class="text-base-content/70">{{ $post->created_at->diffForHumans() }}</span>
                    <div class="card-actions justify-end">
                    </div>
                </div>
        @endforeach
    </div>
@endsection
