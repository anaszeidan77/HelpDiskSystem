<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-purple-900" />
            <x-text-input id="name" class="block mt-1 w-full border-purple-300 rounded-md shadow-sm focus:border-purple-700 focus:ring focus:ring-purple-600 focus:ring-opacity-50" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-purple-700" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-purple-900" />
            <x-text-input id="email" class="block mt-1 w-full border-purple-300 rounded-md shadow-sm focus:border-purple-700 focus:ring focus:ring-purple-600 focus:ring-opacity-50" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-purple-700" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-purple-900" />
            <x-text-input id="password" class="block mt-1 w-full border-purple-300 rounded-md shadow-sm focus:border-purple-700 focus:ring focus:ring-purple-600 focus:ring-opacity-50"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-purple-700" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-purple-900" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-purple-300 rounded-md shadow-sm focus:border-purple-700 focus:ring focus:ring-purple-600 focus:ring-opacity-50"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-purple-700" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-purple-700 hover:text-purple-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-600" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-purple-900 text-white hover:bg-purple-700 focus:ring-purple-600">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
