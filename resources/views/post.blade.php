@extends('partials.layout')
@section('content')
    <div class="container mx-auto flex flex-col gap-2">
        @include('partials.post-card')
        <section id="comments">
            <h1 class="text-xl font-bold">Comments:</h1>
            @auth
                <form action="{{ route('comments.store', $post) }}" method="POST" class="card bg-base-300 p-3 flex flex-col gap-2">
                    @csrf
                    <label for="comment-body" class="fieldset-legend">Add a comment</label>
                    <textarea
                        id="comment-body"
                        name="body"
                        class="textarea w-full @error('body') textarea-error @enderror"
                        required
                    >{{ old('body') }}</textarea>
                    @error('body')
                        <p class="label text-error">{{ $message }}</p>
                    @enderror
                    <button class="btn btn-primary">Comment</button>
                </form>
            @else
                <p><a href="{{ route('login') }}" class="link">Log in</a> to comment.</p>
            @endauth
        </section>
        @foreach ($post->comments as $comment)
            <div class="card bg-base-300 shadow-sm">
                <div class="card-body">
                    <p>{{ $comment->body }}</p>
                    <span class="text-base-content/70">{{ $comment->user?->name ?? __('Unknown author') }}</span>
                    <time class="text-base-content/70" datetime="{{ $comment->created_at->toAtomString() }}">
                        {{ $comment->created_at->format('F j, Y') }}
                    </time>
                    <div class="card-actions justify-end"></div>
                </div>
            </div>
        @endforeach
    </div>
@endsection