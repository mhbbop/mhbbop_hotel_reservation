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
                            <div class="flex items-center justify-center gap-2">
                                @if($reservation->status == 'pending_payment')
                                    <form action="{{ route('admin.reservations.confirm', $reservation->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="border border-green-500 text-green-600 hover:bg-green-500 hover:text-white text-xs font-semibold py-1 px-3 rounded-md transition-colors">
                                            Konfirmasi Bayar
                                        </button>
                                    </form>
                                @elseif($reservation->status == 'confirmed')
                                    <form action="{{ route('admin.reservations.checkin', $reservation->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="border border-blue-500 text-blue-600 hover:bg-blue-500 hover:text-white text-xs font-semibold py-1 px-3 rounded-md transition-colors">
                                            Check-in
                                        </button>
                                    </form>
                                @elseif($reservation->status == 'checked_in')
                                    <span class="text-green-600 font-semibold">Checked In</span>
                                @else
                                    <span class="text-gray-500">Selesai</span>
                                @endif

                                {{-- Form untuk Hapus --}}
                                <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus reservasi ini secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border border-red-500 text-red-500 hover:bg-red-500 hover:text-white text-xs font-semibold py-1 px-3 rounded-md transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
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