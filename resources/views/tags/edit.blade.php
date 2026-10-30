@extends('partials.layout')
@section('content')
    <div class="container mx-auto">
        <form action="{{ route('tags.update', $tag) }}" method="POST" class="card bg-base-300 shadow-sm w-2/3 mx-auto p-3">
            @csrf
            @method('PUT')
            <fieldset class="fieldset">
                <legend class="fieldset-legend"><label for="name">Name</label></legend>
                <input id="name" name="name" type="text" value="{{ old('name', $tag->name) }}"
                    class="input w-full @error('name') input-error @enderror" required>
                @error('name')
                    <p class="label text-error">{{ $message }}</p>
                @enderror
            </fieldset>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('tags.index') }}" class="btn btn-link">Back</a>
        </form>
    </div>
@endsection
