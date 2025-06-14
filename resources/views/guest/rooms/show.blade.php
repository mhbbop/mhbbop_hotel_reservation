<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pesan Kamar: {{ $room->type }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ 
        checkIn: '{{ old('check_in_date') }}', 
        checkOutMinDate: function() {
            if (this.checkIn) {
                let date = new Date(this.checkIn);
                date.setDate(date.getDate() + 1);
                return date.toISOString().slice(0, 10);
            }
            return '{{ now()->addDay()->toDateString() }}';
        } 
    }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $room->type }} (No. {{ $room->room_number }})</h3>
                            <div class="mt-4">
                                <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($room->price_per_night, 0, ',', '.') }}</span>
                                <span class="text-md text-gray-500">/ malam</span>
                            </div>
                            <p class="text-gray-600 mt-4">
                                {{ $room->description }}
                            </p>
                            <div class="mt-6 border-t pt-4">
                                <h4 class="font-semibold text-gray-700">Fasilitas:</h4>
                                <ul class="list-disc list-inside mt-2 text-gray-600">
                                    <li>Wi-Fi Kecepatan Tinggi</li>
                                    <li>AC</li>
                                    <li>TV Layar Datar</li>
                                    <li>Kamar Mandi Pribadi</li>
                                </ul>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">Formulir Reservasi</h3>
                            <form action="{{ route('guest.reservations.store') }}" method="POST" class="mt-4 space-y-4">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room->id }}">

                                <div>
                                    <label for="check_in_date" class="block text-sm font-medium text-gray-700">Tanggal Check-in</label>
                                    {{-- Menambahkan x-model untuk melacak perubahan tanggal --}}
                                    <input x-model="checkIn" type="date" name="check_in_date" id="check_in_date" min="{{ now()->toDateString() }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('check_in_date')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="check_out_date" class="block text-sm font-medium text-gray-700">Tanggal Check-out</label>
                                    {{-- Menambahkan :min untuk tanggal minimal dinamis --}}
                                    <input :min="checkOutMinDate()" type="date" name="check_out_date" id="check_out_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('check_out_date') }}">
                                </div>

                                <div class="pt-2 flex items-center justify-end space-x-4">
                                    <a href="{{ route('guest.rooms.index') }}" class="w-full md:w-auto text-center bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded transition-colors">
                                        Batal
                                    </a>
                                    <button type="submit" class="w-full md:w-auto text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded transition-colors">
                                        Konfirmasi Pemesanan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>