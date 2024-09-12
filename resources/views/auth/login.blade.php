<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-purple-900" />
            <x-text-input id="email" class="block mt-1 w-full border-purple-300 rounded-md shadow-sm focus:border-purple-700 focus:ring focus:ring-purple-600 focus:ring-opacity-50" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-purple-700" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-purple-900" />
            <x-text-input id="password" class="block mt-1 w-full border-purple-300 rounded-md shadow-sm focus:border-purple-700 focus:ring focus:ring-purple-600 focus:ring-opacity-50"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-purple-700" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-purple-300 text-purple-700 shadow-sm focus:ring-purple-700">
                <span class="ms-2 text-sm text-purple-900">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-purple-700 hover:text-purple-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-600" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-purple-900 text-white hover:bg-purple-700 focus:ring-purple-600">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
