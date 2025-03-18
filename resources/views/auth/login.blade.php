<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-red-900 via-orange-600 to-red-900">
        <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-lg">
            <div class="flex justify-center mb-4">
                <img src="{{asset('images/cecyteh_horizontal_logo.png')}}" alt="">
            </div>

            <x-validation-errors class="mb-4" />

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" class="text-red-900 font-semibold"/>
                    <x-input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-600 focus:border-orange-600" 
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-red-900 font-semibold"/>
                    <x-input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-600 focus:border-orange-600" 
                        type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" class="text-orange-600"/>
                        <span class="ml-2 text-sm text-gray-700">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-orange-600 hover:text-orange-800 underline" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="bg-red-800 hover:bg-red-900 text-white px-6 py-2 rounded-lg">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
