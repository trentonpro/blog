<section class="flex flex-col gap-4">
    <h2 class="card-title">@lang('Update Password')</h2>
    @if (session('status') === 'password-updated')
        <div role="status" class="alert alert-success">@lang('Saved.')</div>
    @endif
    <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-4">
        @csrf
        @method('put')
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend"><label for="update-current-password">@lang('Current Password')</label></legend>
                        <input id="update-current-password" name="current_password" type="password"
                            class="input w-full @error('current_password', 'updatePassword') input-error @enderror" required autocomplete="current-password">
                        @error('current_password', 'updatePassword')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend"><label for="update-password">@lang('New Password')</label></legend>
                        <input id="update-password" name="password" type="password"
                            class="input w-full @error('password', 'updatePassword') input-error @enderror" required autocomplete="new-password">
                        @error('password', 'updatePassword')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend"><label for="update-password-confirmation">@lang('Confirm Password')</label></legend>
                        <input id="update-password-confirmation" name="password_confirmation" type="password"
                            class="input w-full @error('password_confirmation', 'updatePassword') input-error @enderror" required autocomplete="new-password">
                        @error('password_confirmation', 'updatePassword')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
        <button type="submit" class="btn btn-primary self-start">@lang('Save')</button>
    </form>
</section>
