<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Reservasi Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold">Riwayat Reservasi Anda</h3>
                        <a href="{{ route('guest.rooms.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Buat Reservasi Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-2 px-4 border-b text-left">Tipe Kamar</th>
                                    <th class="py-2 px-4 border-b text-left">Check-in</th>
                                    <th class="py-2 px-4 border-b text-left">Check-out</th>
                                    <th class="py-2 px-4 border-b text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reservations as $reservation)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b">{{ $reservation->room->type }} (No. {{ $reservation->room->room_number }})</td>
                                        <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($reservation->check_in_date)->format('d M Y') }}</td>
                                        <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($reservation->check_out_date)->format('d M Y') }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($reservation->status == 'checked_in') bg-blue-100 text-blue-800
                                                @elseif($reservation->status == 'confirmed') bg-yellow-100 text-yellow-800
                                                @elseif($reservation->status == 'checked_out') bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $reservation->status)) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-gray-500">Anda belum memiliki riwayat reservasi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>