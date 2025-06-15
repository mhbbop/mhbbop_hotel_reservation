<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Menyimpan reservasi baru yang dibuat oleh tamu.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        $roomId = $validated['room_id'];
        $checkInDate = Carbon::parse($validated['check_in_date']);
        $checkOutDate = Carbon::parse($validated['check_out_date']);

        // 2. Cek Ketersediaan Kamar
        $isNotAvailable = Reservation::where('room_id', $roomId)
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->where(function ($q) use ($checkInDate, $checkOutDate) {
                    $q->where('check_in_date', '<=', $checkInDate)
                      ->where('check_out_date', '>', $checkInDate);
                })->orWhere(function ($q) use ($checkInDate, $checkOutDate) {
                    $q->where('check_in_date', '<', $checkOutDate)
                      ->where('check_out_date', '>=', $checkOutDate);
                })->orWhere(function ($q) use ($checkInDate, $checkOutDate) {
                    $q->where('check_in_date', '>=', $checkInDate)
                      ->where('check_out_date', '<=', $checkOutDate);
                });
            })->exists();

        if ($isNotAvailable) {
            return back()->withErrors(['check_in_date' => 'Kamar tidak tersedia pada rentang tanggal yang Anda pilih.'])->withInput();
        }

        // 3. Hitung Total Harga
        $room = Room::findOrFail($roomId);
        $numberOfNights = $checkInDate->diffInDays($checkOutDate);
        $totalPrice = $numberOfNights * $room->price_per_night;

        // 4. Buat Reservasi
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $roomId,
            'check_in_date' => $checkInDate,
            'check_out_date' => $checkOutDate,
            'total_price' => $totalPrice,
            'status' => 'pending_payment',
        ]);

        // 5. INI PERBAIKANNYA: Redirect ke halaman pembayaran
        return redirect()->route('guest.reservations.payment', $reservation);
    }

    /**
     * Menampilkan halaman instruksi pembayaran.
     * Pastikan method ini ada.
     */
    public function payment(Reservation $reservation)
    {
        // Pastikan tamu hanya bisa melihat halaman pembayaran reservasi miliknya
        if ($reservation->user_id != Auth::id()) {
            abort(403);
        }
        return view('guest.reservations.payment', compact('reservation'));
    }
}