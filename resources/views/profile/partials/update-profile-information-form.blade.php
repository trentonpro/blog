<section class="flex flex-col gap-4">
    <h2 class="card-title">@lang('Profile Information')</h2>
    @if (session('status') === 'profile-updated')
        <div role="status" class="alert alert-success">@lang('Saved.')</div>
    @endif
    @if (session('status') === 'verification-link-sent')
        <div role="status" class="alert alert-success">@lang('A new verification link has been sent to your email address.')</div>
    @endif
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="POST" action="{{ route('profile.update') }}" class="flex flex-col gap-4">
        @csrf
        @method('patch')
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend"><label for="profile-name">@lang('Name')</label></legend>
                        <input id="profile-name" name="name" type="text" value="{{ old('name', $user->name) }}"
                            class="input w-full @error('name') input-error @enderror" required autofocus autocomplete="name">
                        @error('name')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend"><label for="profile-email">@lang('Email')</label></legend>
                        <input id="profile-email" name="email" type="email" value="{{ old('email', $user->email) }}"
                            class="input w-full @error('email') input-error @enderror" required autocomplete="username">
                        @error('email')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <p>@lang('Your email address is unverified.')</p>
            <button type="submit" form="send-verification" class="btn btn-link">@lang('Click here to re-send the verification email.')</button>
        @endif
        <button type="submit" class="btn btn-primary self-start">@lang('Save')</button>
    </form>
</section>
