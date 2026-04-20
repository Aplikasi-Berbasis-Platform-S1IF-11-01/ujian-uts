<section>
    <header>
        <h2 class="text-xl font-bold text-gray-900 mb-1">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block font-medium text-sm text-gray-900 mb-2">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="block w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:border-purple-600 focus:ring focus:ring-purple-600/20 outline-none transition text-gray-900" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-500" />
        </div>

        <div>
            <label for="update_password_password" class="block font-medium text-sm text-gray-900 mb-2">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" class="block w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:border-purple-600 focus:ring focus:ring-purple-600/20 outline-none transition text-gray-900" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-500" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block font-medium text-sm text-gray-900 mb-2">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:border-purple-600 focus:ring focus:ring-purple-600/20 outline-none transition text-gray-900" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-full font-bold shadow-md transition transform hover:-translate-y-0.5">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-700 bg-green-50 border border-green-200 px-3 py-1 rounded"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
