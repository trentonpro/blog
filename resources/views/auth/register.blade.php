@extends('partials.layout')
@section('content')
    <main class="mx-auto my-6 w-full max-w-lg px-4">
        <div class="card bg-base-200 shadow-sm">
            <div class="card-body">
                <h1 class="card-title">@lang('Register')</h1>
                <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
                    @csrf
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend"><label for="name">@lang('Name')</label></legend>
                        <input id="name" name="name" type="text" value="{{ old('name') }}"
                            class="input w-full @error('name') input-error @enderror" required autofocus autocomplete="name">
                        @error('name')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend"><label for="email">@lang('Email')</label></legend>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            class="input w-full @error('email') input-error @enderror" required autocomplete="username">
                        @error('email')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend"><label for="password">@lang('Password')</label></legend>
                        <input id="password" name="password" type="password"
                            class="input w-full @error('password') input-error @enderror" required autocomplete="new-password">
                        @error('password')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend"><label for="password_confirmation">@lang('Confirm Password')</label></legend>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="input w-full @error('password_confirmation') input-error @enderror" required autocomplete="new-password">
                        @error('password_confirmation')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <div class="flex flex-wrap items-center gap-2">
                        <button type="submit" class="btn btn-primary">@lang('Register')</button>
                        <a href="{{ route('login') }}" class="btn btn-link">@lang('Already registered?')</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
