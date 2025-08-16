<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="flex items-center justify-center mt-4">
            <a href="{{ route('google.redirect') }}"
                class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 488 512">
                    <path
                        d="M488 261.8c0-17.6-1.6-34.5-4.6-51H249v96.5h134c-5.8 31-23.1 57.1-49.2 74.6v61h79.4c46.3-42.7 74.8-105.6 74.8-181.1z"
                        fill="#4285F4" />
                    <path
                        d="M249 492c66.4 0 122.3-21.9 163.1-59.4l-79.4-61c-22.1 14.9-50.4 23.7-83.7 23.7-64.3 0-118.8-43.5-138.4-102.1H28.4v63.8C69.1 426 152.9 492 249 492z"
                        fill="#34A853" />
                    <path
                        d="M110.6 293.2c-9.2-27.6-9.2-57.6 0-85.2v-63.8H28.4c-19.1 37.8-28.4 80.6-28.4 127s9.3 89.2 28.4 127l82.2-63z"
                        fill="#FBBC05" />
                    <path
                        d="M249 97.3c35.9 0 68.3 12.4 93.7 36.4l70.2-70.2C371.3 24.1 315.4 0 249 0 152.9 0 69.1 66 28.4 164.2l82.2 63c19.6-58.6 74.1-102 138.4-102z"
                        fill="#EA4335" />
                </svg>
                {{ __('Login with Google') }}
            </a>
        </div>

    </form>
</x-guest-layout>
