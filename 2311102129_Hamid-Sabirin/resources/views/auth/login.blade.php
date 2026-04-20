<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-purple-200/80">{{ __('Email Address') }}</label>
            <input id="email" class="block mt-2 w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:border-purple-500 focus:ring focus:ring-purple-500/20 outline-none transition text-white placeholder-purple-200/30" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-500" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <label for="password" class="block font-medium text-sm text-purple-200/80">{{ __('Password') }}</label>
            <div class="relative mt-2">
                <input id="password" class="block w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:border-purple-500 focus:ring focus:ring-purple-500/20 outline-none transition text-white placeholder-purple-200/30"
                                type="password"
                                name="password"
                                required autocomplete="current-password" placeholder="••••••••" />
                
                <!-- Toggle Password Visibility (Keeping the previous logic if it exists, or just adding the button structure) -->
                <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-purple-200/50 hover:text-white">
                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-500" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-6">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <div class="relative flex items-center justify-center">
                    <input id="remember_me" type="checkbox" class="peer appearance-none w-5 h-5 border border-white/20 rounded bg-white/5 checked:bg-purple-600 checked:border-purple-600 transition-all cursor-pointer" name="remember">
                    <svg class="absolute w-3 h-3 text-white pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <span class="ms-3 text-sm text-purple-200/60 group-hover:text-purple-200 transition-colors">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col mt-8 space-y-4">
            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-fuchsia-600 hover:from-purple-500 hover:to-fuchsia-500 text-white px-6 py-3.5 rounded-xl font-bold shadow-lg shadow-purple-500/25 transition transform hover:-translate-y-0.5">
                {{ __('Sign In to Dashboard') }}
            </button>
            
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="text-sm text-purple-200/60 hover:text-white transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            @endif
        </div>
    </form>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />';
            } else {
                password.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />';
            }
        });
    </script>
</x-guest-layout>
