<x-guest-layout>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Title --}}
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-gray-800">
                Welcome Back 👋
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Login to your dashboard
            </p>
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email"
                          class="block mt-1 w-full"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required
                          autofocus
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password"
                          class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required
                          autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Remember + Forgot --}}
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me"
                       type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                       name="remember">
                <span class="ms-2 text-sm text-gray-600">
                    {{ __('Remember me') }}
                </span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:underline"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot?') }}
                </a>
            @endif
        </div>

        {{-- Login Button ONLY --}}
        <div class="mt-6">
            <x-primary-button class="w-full justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        {{-- <p class="mt-4 text-sm text-center">
    Don't have an account?
    <a href="{{ route('register') }}" class="text-blue-600 underline">
        Register
    </a>
</p> --}}

    </form>

</x-guest-layout>