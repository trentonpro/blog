@extends('partials.layout')
@section('content')
    <main class="mx-auto my-6 flex max-w-2xl flex-col gap-6 px-4">
        <h1 class="text-2xl font-bold">@lang('Profile')</h1>
        <div class="card bg-base-200 shadow-sm">
            <div class="card-body">@include('profile.partials.update-profile-information-form')</div>
        </div>
        <div class="card bg-base-200 shadow-sm">
            <div class="card-body">@include('profile.partials.update-password-form')</div>
        </div>
        <div class="card bg-base-200 shadow-sm">
            <div class="card-body">@include('profile.partials.delete-user-form')</div>
        </div>
    </main>
@endsection
