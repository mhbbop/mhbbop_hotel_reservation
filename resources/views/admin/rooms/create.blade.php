@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold text-white drop-shadow-lg mb-6">Tambah Kamar Baru</h1>

<div class="bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('admin.rooms.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="room_number" class="block text-gray-700 text-sm font-bold mb-2">Nomor Kamar:</label>
            <input type="text" name="room_number" id="room_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('room_number') }}">
            @error('room_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Tipe Kamar:</label>
            <select name="type" id="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Pilih Tipe</option>
                <option value="Single" {{ old('type') == 'Single' ? 'selected' : '' }}>Single</option>
                <option value="Double" {{ old('type') == 'Double' ? 'selected' : '' }}>Double</option>
                <option value="Deluxe" {{ old('type') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                <option value="Suite" {{ old('type') == 'Suite' ? 'selected' : '' }}>Suite</option>
            </select>
            @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="price_per_night" class="block text-gray-700 text-sm font-bold mb-2">Harga per Malam (Rp):</label>
            <input type="number" name="price_per_night" id="price_per_night" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('price_per_night') }}">
            @error('price_per_night') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
            <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-end">
            <a href="{{ route('admin.rooms.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-4">
                Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Kamar
            </button>
        </div>
    </form>
</div>
@endsection