@extends('partials.layout')
@section('content')
    <main class="mx-auto my-6 w-full max-w-lg px-4">
        <div class="card bg-base-200 shadow-sm">
            <div class="card-body">
                <h1 class="card-title">@lang('Dashboard')</h1>
                <p>{{ __("You're logged in!") }}</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">@lang('Profile')</a>
            </div>
        </div>
    </main>
@endsection
