<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Menampilkan semua kamar yang tersedia untuk tamu
    public function index()
    {
        $rooms = Room::where('status', 'available')->orderBy('price_per_night', 'asc')->get();
        return view('guest.rooms.index', compact('rooms'));
    }

    // ===== TAMBAHKAN METHOD BARU DI SINI =====
    // Menampilkan detail satu kamar spesifik
    public function show(Room $room)
    {
        return view('guest.rooms.show', compact('room'));
    }
}