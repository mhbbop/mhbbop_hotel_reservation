<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     * ===== TAMBAHKAN METHOD INI =====
     */
    public function index()
    {
        // Ambil data reservasi beserta data user dan kamar yang terhubung
        $reservations = Reservation::with(['user', 'room'])->latest()->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        // Logika Hapus yang sudah kita buat sebelumnya
        if ($reservation->status === 'checked_in') {
            $reservation->room->update(['status' => 'available']);
        }
        $reservation->delete();
        return redirect()->route('admin.reservations.index')->with('success', 'Reservasi berhasil dihapus.');
    }

    /**
     * Mengonfirmasi pembayaran reservasi.
     */
    public function confirmPayment(Reservation $reservation)
    {
        // Ubah status reservasi menjadi 'confirmed'
        $reservation->update(['status' => 'confirmed']);

        return redirect()->route('admin.reservations.index')->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }
}