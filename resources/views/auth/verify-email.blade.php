@extends('partials.layout')
@section('content')
    <main class="mx-auto my-6 w-full max-w-lg px-4">
        <div class="card bg-base-200 shadow-sm">
            <div class="card-body">
                <h1 class="card-title">@lang('Verify Email')</h1>
                <p>@lang('Please verify your email address using the link we sent you.')</p>
                @if (session('status') === 'verification-link-sent')
                    <div role="status" class="alert alert-success">
                        @lang('A new verification link has been sent to your email address.')
                    </div>
                @endif
                <div class="flex flex-wrap gap-2">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">@lang('Resend Verification Email')</button>
                    </form>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link">@lang('Log Out')</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
