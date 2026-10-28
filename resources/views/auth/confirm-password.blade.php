@extends('partials.layout')
@section('content')
    <main class="mx-auto my-6 w-full max-w-lg px-4">
        <div class="card bg-base-200 shadow-sm">
            <div class="card-body">
                <h1 class="card-title">@lang('Confirm Password')</h1>
                <p>@lang('Please confirm your password before continuing.')</p>
                <form method="POST" action="{{ route('password.confirm') }}" class="flex flex-col gap-4">
                    @csrf
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend"><label for="password">@lang('Password')</label></legend>
                        <input id="password" name="password" type="password"
                            class="input w-full @error('password') input-error @enderror" required autofocus autocomplete="current-password">
                        @error('password')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <button type="submit" class="btn btn-primary">@lang('Confirm')</button>
                </form>
            </div>
        </div>
    </main>
@endsection
