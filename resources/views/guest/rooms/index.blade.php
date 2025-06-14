<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pilih Kamar Impian Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-transparent overflow-hidden">
                <div class="p-6 text-gray-900">

                    {{-- Daftar Kamar dalam bentuk Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse ($rooms as $room)
                            <div class="bg-white/80 backdrop-blur-sm rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                {{-- Placeholder untuk gambar kamar --}}
                                <div class="h-48 bg-gray-300 bg-cover bg-center" style="background-image: url('https://via.placeholder.com/400x300.png/CCCCCC/FFFFFF?text=Hotel+Room');">
                                </div>
                                <div class="p-6">
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $room->type }} (No. {{ $room->room_number }})</h3>
                                    <p class="text-sm text-gray-600 mt-2 h-20 overflow-hidden">{{ $room->description }}</p>

                                    <div class="mt-4 flex justify-between items-center">
                                        <span class="text-xl font-bold text-indigo-600">Rp {{ number_format($room->price_per_night, 0, ',', '.') }}</span>
                                        <span class="text-sm text-gray-500">/ malam</span>
                                    </div>

                                    <div class="mt-6">
                                        <a href="{{ route('guest.rooms.show', $room->id) }}" class="w-full text-center block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                            Pesan Sekarang
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 col-span-3">Mohon maaf, saat ini tidak ada kamar yang tersedia.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>