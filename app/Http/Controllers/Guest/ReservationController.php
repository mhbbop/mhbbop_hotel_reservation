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

        // 2. Cek Ketersediaan Kamar pada Rentang Tanggal yang Dipilih
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
        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $roomId,
            'check_in_date' => $checkInDate,
            'check_out_date' => $checkOutDate,
            'total_price' => $totalPrice,
            'status' => 'pending_payment',
        ]);

        // 5. Redirect ke Dashboard Tamu dengan Pesan Sukses
        return redirect()->route('dashboard')->with('success', 'Reservasi Anda berhasil dibuat!');
    }
}