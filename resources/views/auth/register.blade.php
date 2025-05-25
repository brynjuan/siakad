<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-200 via-purple-200 to-pink-200 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white rounded-xl shadow-lg p-8">
            <div class="flex flex-col items-center mb-6">
                <img class="mx-auto h-16 w-16 rounded-full shadow" src="https://ui-avatars.com/api/?name=Register&background=4f46e5&color=fff" alt="Register Icon">
                <h2 class="mt-4 text-center text-3xl font-extrabold text-indigo-700">Create your account</h2>
                <p class="mt-2 text-sm text-gray-500">Please fill in the form to continue</p>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" class="text-indigo-700 font-semibold" />
                    <x-text-input id="name" class="block mt-1 w-full border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" class="text-indigo-700 font-semibold" />
                    <x-text-input id="email" class="block mt-1 w-full border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-indigo-700 font-semibold" />

                    <x-text-input id="password" class="block mt-1 w-full border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-indigo-700 font-semibold" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a class="underline text-sm text-gray-600 hover:text-indigo-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow transition">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
