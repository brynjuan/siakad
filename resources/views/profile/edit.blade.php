<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto bg-white shadow sm:rounded-lg p-8">
            <div class="flex items-center gap-6 mb-8">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=f43f5e&color=fff&rounded=true&size=80"
                     alt="avatar"
                     class="w-20 h-20 rounded-full border-2 border-rose-300 shadow" />
                <div>
                    <h3 class="text-2xl font-bold text-rose-700">{{ Auth::user()->name }}</h3>
                    <p class="text-gray-600">{{ Auth::user()->email }}</p>
                    <span class="inline-block mt-2 px-3 py-1 bg-rose-100 text-rose-700 rounded-full text-xs font-semibold">
                        {{ ucfirst(Auth::user()->role ?? 'Mahasiswa') }}
                    </span>
                </div>
            </div>
            <div class="space-y-4 text-gray-700">
                <div>

                <div>
                    <span class="font-semibold">Nama:</span>
                    <span>{{ Auth::user()->name }}</span>
                </div>
                <div>
                    <span class="font-semibold">Email:</span>
                    <span>{{ Auth::user()->email }}</span>
                </div>
                <div>
                    <span class="font-semibold">Role:</span>
                    <span>{{ ucfirst(Auth::user()->role ?? 'Mahasiswa') }}</span>
                </div>

                <!-- Tambahkan field lain sesuai kebutuhan -->
            </div>
        </div>
    </div>
</x-app-layout>
