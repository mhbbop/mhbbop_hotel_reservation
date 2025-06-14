@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-white drop-shadow-lg mb-6">Manajemen Tamu & Reservasi</h1>
    </div>

<div class="bg-white p-6 rounded-lg shadow-md">
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nama Tamu</th>
                <th class="py-2 px-4 border-b">Nomor Kamar</th>
                <th class="py-2 px-4 border-b">Check-in</th>
                <th class="py-2 px-4 border-b">Check-out</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $reservation)
                <tr class="text-center">
                    <td class="py-2 px-4 border-b">{{ $reservation->user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $reservation->room->room_number }}</td>
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
                    <td class="py-2 px-4 border-b">
                        @if($reservation->status == 'pending_payment')
                            <form action="{{ route('admin.reservations.confirm', $reservation->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">
                                    Konfirmasi Bayar
                                </button>
                            </form>
                        @elseif($reservation->status == 'confirmed')
                            {{-- Tombol Check-in akan kita buat nanti --}}
                            <button class="bg-blue-500 text-white text-xs font-bold py-1 px-2 rounded opacity-50 cursor-not-allowed">Check-in</button>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Belum ada data reservasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection