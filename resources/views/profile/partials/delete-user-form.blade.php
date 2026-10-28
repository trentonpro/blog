<section class="flex flex-col gap-4">
    <h2 class="card-title">@lang('Delete Account')</h2>
    <p>@lang('Once your account is deleted, all of its resources and data will be permanently deleted.')</p>
    <button type="button" class="btn btn-error self-start" onclick="document.getElementById('confirm-user-deletion').showModal()">@lang('Delete Account')</button>

    <dialog id="confirm-user-deletion" class="modal" aria-labelledby="delete-account-heading">
        <div class="modal-box">
            <h3 id="delete-account-heading" class="text-lg font-bold">@lang('Are you sure you want to delete your account?')</h3>
            <p>@lang('Please enter your password to confirm you would like to permanently delete your account.')</p>
            <form method="POST" action="{{ route('profile.destroy') }}" class="flex flex-col gap-4">
                @csrf
                @method('delete')
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend"><label for="delete-password">@lang('Password')</label></legend>
                        <input id="delete-password" name="password" type="password"
                            class="input w-full @error('password', 'userDeletion') input-error @enderror" required autocomplete="current-password" autofocus>
                        @error('password', 'userDeletion')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                <div class="modal-action">
                    <button type="button" class="btn" onclick="this.closest('dialog').close()">@lang('Cancel')</button>
                    <button type="submit" class="btn btn-error">@lang('Delete Account')</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>@lang('Close')</button>
        </form>
    </dialog>
    @if ($errors->userDeletion->isNotEmpty())
        <script>document.getElementById('confirm-user-deletion').showModal();</script>
    @endif
</section>
