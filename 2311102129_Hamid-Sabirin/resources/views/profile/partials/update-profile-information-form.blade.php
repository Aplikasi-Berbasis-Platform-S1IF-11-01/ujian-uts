<section>
    <header>
        <h2 class="text-xl font-bold text-gray-900 mb-1">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block font-medium text-sm text-gray-900 mb-2">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="block w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:border-purple-600 focus:ring focus:ring-purple-600/20 outline-none transition text-gray-900" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-500" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block font-medium text-sm text-gray-900 mb-2">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="block w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:border-purple-600 focus:ring focus:ring-purple-600/20 outline-none transition text-gray-900" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-500" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-500">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-purple-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-600">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-full font-bold shadow-md transition transform hover:-translate-y-0.5">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
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
