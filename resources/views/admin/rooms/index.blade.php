@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-white drop-shadow-lg mb-6">Manajemen Kamar</h1>
    <a href="{{ route('admin.rooms.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        + Tambah Kamar
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white p-6 rounded-lg shadow-md">
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">No. Kamar</th>
                <th class="py-2 px-4 border-b">Tipe</th>
                <th class="py-2 px-4 border-b">Harga/Malam</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rooms as $room)
                <tr class="text-center">
                    <td class="py-2 px-4 border-b">{{ $room->room_number }}</td>
                    <td class="py-2 px-4 border-b">{{ $room->type }}</td>
                    <td class="py-2 px-4 border-b">Rp {{ number_format($room->price_per_night, 0, ',', '.') }}</td>
                    <td class="py-2 px-4 border-b">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $room->status == 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($room->status) }}
                        </span>
                    </td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('admin.rooms.edit', $room->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                        
                        {{-- Tombol Hapus --}}
                        <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 ml-4">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Belum ada data kamar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection