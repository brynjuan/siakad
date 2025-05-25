<x-guest-layout>
    <div class="flex flex-col md:flex-row ">
        <!-- Left Column - Login -->
        <div class="p-8 md:p-10 md:w-1/2 border-r border-gray-200">
            <div class="mb-6 text-center">
             <img src="{{ asset('images/logo-untad.png') }}" alt="Logo Untad" class="w-16 h-16 mx-auto" />
                <h1 class="text-3xl font-bold text-gray-800 mt-4">Login</h1>
                <p class="text-sm text-gray-600">Siakad Untad</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Login Input -->
                <div class="mb-4">
                    <x-input-label for="login" :value="__('NIM / Email')" />
                    <x-text-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required autofocus />
                    <x-input-error :messages="$errors->get('login')" class="mt-2" />
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>


                <!-- Remember and Login Button -->
                <div class="flex items-center justify-between mt-6">
                    <label class="flex items-center text-sm">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                        <span class="ml-2 text-gray-600">Ingat saya</span>
                    </label>
                    <x-primary-button class="ml-3 bg-pink-600 hover:bg-pink-700">
                        {{ __('Sign In') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- Right Column - Pengumuman -->
        <div class="bg-gray-50 p-8 md:p-10 md:w-1/2">
            <h2 class="text-lg font-semibold text-gray-700 flex items-center mb-4">
                <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 13V6a3 3 0 00-3-3H5a3 3 0 00-3 3v11a3 3 0 003 3h10a3 3 0 003-3v-1l4 4V9l-4 4z"/>
                </svg>
                Pengumuman
            </h2>

            <!-- Himbauan -->
            <div class="bg-pink-200 text-pink-800 p-4 rounded mb-4">
                <h3 class="font-bold mb-2">Himbauan</h3>
                <ul class="list-disc ml-5 text-sm space-y-1">
                    <li>Diharapkan mahasiswa berhati-hati terhadap penipuan yang mengatasnamakan dosen.</li>
                    <li>Penerimaan mahasiswa baru tahun 2023 telah ditutup. Abaikan info penambahan kuota dari oknum.</li>
                </ul>
            </div>

            <!-- Kuesioner -->
            <div class="bg-cyan-200 text-cyan-900 p-4 rounded text-sm">
                <h3 class="font-bold mb-1">Kuesioner</h3>
                <p>Bagi seluruh mahasiswa diharapkan untuk mengisi kuesioner <span class="font-semibold">sebelum mengisi KRS pada halaman input KRS</span>.</p>
                <p class="mt-2">Kuesioner ini bertujuan untuk mengevaluasi dan meningkatkan layanan akademik Universitas Tadulako.</p>
            </div>
        </div>
    </div>
</x-guest-layout>
