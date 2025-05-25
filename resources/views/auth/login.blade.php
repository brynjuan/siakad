<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-red-100 via-pink-100 to-rose-100 py-8">
        <div class="flex flex-col md:flex-row w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden bg-white/90 backdrop-blur-md border border-red-200">
            <!-- Left Column - Login -->
            <div class="p-8 md:p-10 md:w-1/2 border-b md:border-b-0 md:border-r border-red-200 bg-white/80">
                <div class="mb-6 text-center">
                    <div class="flex justify-center">
                        <div class="bg-gradient-to-tr from-red-500 to-pink-400 rounded-full p-1 shadow-lg inline-block">
                            <img src="{{ asset('images/logo-untad.png') }}" alt="Logo Untad" class="w-16 h-16 rounded-full border-4 border-white shadow-md" />
                        </div>
                    </div>
                    <h1 class="text-3xl font-extrabold text-gray-800 mt-4 tracking-tight">Login</h1>
                    <p class="text-sm text-gray-600">Siakad Untad</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Login Input -->
                    <div class="mb-4">
                        <x-input-label for="login" :value="__('NIM / Email')" />
                        <x-text-input id="login" class="block mt-1 w-full rounded-lg border-red-300 focus:border-red-500 focus:ring-red-400 shadow-sm" type="text" name="login" :value="old('login')" required autofocus />
                        <x-input-error :messages="$errors->get('login')" class="mt-2" />
                    </div>

                    <!-- Password Input -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full rounded-lg border-red-300 focus:border-red-500 focus:ring-red-400 shadow-sm" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember and Login Button -->
                    <div class="flex items-center justify-between mt-6">
                        <label class="flex items-center text-sm">
                            <input type="checkbox" name="remember" class="rounded border-red-300 text-red-600 shadow-sm focus:ring-red-500">
                            <span class="ml-2 text-gray-600">Ingat saya</span>
                        </label>
                        <x-primary-button class="ml-3 bg-gradient-to-tr from-red-600 to-pink-500 hover:from-red-700 hover:to-pink-600 shadow-lg px-6 py-2 rounded-lg font-semibold">
                            {{ __('Sign In') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Right Column - Pengumuman -->
            <div class="bg-gradient-to-tr from-rose-50 to-red-50 p-8 md:p-10 md:w-1/2 flex flex-col justify-center">
                <h2 class="text-lg font-semibold text-gray-700 flex items-center mb-4">
                    <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 13V6a3 3 0 00-3-3H5a3 3 0 00-3 3v11a3 3 0 003 3h10a3 3 0 003-3v-1l4 4V9l-4 4z"/>
                    </svg>
                    Pengumuman
                </h2>

                <!-- Himbauan -->
                <div class="bg-red-200/80 text-red-800 p-4 rounded-lg mb-4 shadow">
                    <h3 class="font-bold mb-2">Himbauan</h3>
                    <ul class="list-disc ml-5 text-sm space-y-1">
                        <li>Diharapkan mahasiswa berhati-hati terhadap penipuan yang mengatasnamakan dosen.</li>
                        <li>Penerimaan mahasiswa baru tahun 2023 telah ditutup. Abaikan info penambahan kuota dari oknum.</li>
                    </ul>
                </div>

                <!-- Kuesioner -->
                <div class="bg-pink-200/80 text-pink-900 p-4 rounded-lg text-sm shadow">
                    <h3 class="font-bold mb-1">Kuesioner</h3>
                    <p>Bagi seluruh mahasiswa diharapkan untuk mengisi kuesioner <span class="font-semibold">sebelum mengisi KRS pada halaman input KRS</span>.</p>
                    <p class="mt-2">Kuesioner ini bertujuan untuk mengevaluasi dan meningkatkan layanan akademik Universitas Tadulako.</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
