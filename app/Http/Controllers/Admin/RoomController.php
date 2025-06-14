<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Menampilkan daftar semua kamar.
     */
    public function index()
    {
        // PERUBAHAN DI SINI: Mengurutkan berdasarkan nomor kamar
        $rooms = Room::orderBy('room_number', 'asc')->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Menampilkan form untuk membuat kamar baru.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Menyimpan kamar baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number',
            'type' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Room::create($validated);

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Menampilkan form untuk mengedit kamar.
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Memperbarui data kamar di database.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number,' . $room->id,
            'type' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $room->update($validated);

        return redirect()->route('admin.rooms.index')->with('success', 'Data kamar berhasil diperbarui!');
    }

    /**
     * Menghapus kamar dari database.
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil dihapus!');
    }
}