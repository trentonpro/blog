@extends('partials.layout')
@section('content')
    <main class="mx-auto my-6 w-full max-w-lg px-4">
        <div class="card bg-base-200 shadow-sm">
            <div class="card-body">
                <h1 class="card-title">@lang('Log in')</h1>
                @if (session('status'))
                    <div role="status" class="alert alert-success">{{ session('status') }}</div>
                @endif
                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                    @csrf
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend"><label for="email">@lang('Email')</label></legend>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            class="input w-full @error('email') input-error @enderror" required autofocus autocomplete="username">
                        @error('email')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend"><label for="password">@lang('Password')</label></legend>
                        <input id="password" name="password" type="password"
                            class="input w-full @error('password') input-error @enderror" required autocomplete="current-password">
                        @error('password')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <label class="label" for="remember_me">
                        <input id="remember_me" type="checkbox" name="remember" class="checkbox" @checked(old('remember'))>
                        @lang('Remember me')
                    </label>
                    <div class="flex flex-wrap items-center gap-2">
                        <button type="submit" class="btn btn-primary">@lang('Log in')</button>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="btn btn-link">@lang('Forgot your password?')</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
