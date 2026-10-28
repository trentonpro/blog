@extends('partials.layout')
@section('content')
    <main class="mx-auto my-6 w-full max-w-lg px-4">
        <div class="card bg-base-200 shadow-sm">
            <div class="card-body">
                <h1 class="card-title">@lang('Forgot your password?')</h1>
                <p>@lang('Enter your email address to receive a password reset link.')</p>
                @if (session('status'))
                    <div role="status" class="alert alert-success">{{ session('status') }}</div>
                @endif
                <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-4">
                    @csrf
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend"><label for="email">@lang('Email')</label></legend>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            class="input w-full @error('email') input-error @enderror" required autofocus autocomplete="email">
                        @error('email')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <button type="submit" class="btn btn-primary">@lang('Email Password Reset Link')</button>
                    <a href="{{ route('login') }}" class="btn btn-link">@lang('Log in')</a>
                </form>
            </div>
        </div>
    </main>
@endsection
