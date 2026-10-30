@extends('partials.layout')
@section('content')
    <div class="container mx-auto">
        <a href="{{ route('tags.index') }}" class="btn btn-primary">Back</a>
        <h1 class="text-xl font-bold">{{ $tag->name }}</h1>
        <div class="grid grid-cols-4 gap-2">
            @forelse ($posts as $post)
                @include('partials.post-card')
            @empty
                <p>No posts.</p>
            @endforelse
        </div>
    </div>
@endsection
