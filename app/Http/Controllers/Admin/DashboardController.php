<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung Total Kamar
        $totalRooms = Room::count();

        // 2. Menghitung Tamu yang sedang Check-in
        $currentGuests = Reservation::where('status', 'checked_in')->count();

        // 3. Menghitung Reservasi Baru Hari Ini
        $newReservationsToday = Reservation::whereDate('created_at', Carbon::today())->count();

        // 4. Menghitung Total Pendapatan Bulan Ini
        $monthlyRevenue = Reservation::whereIn('status', ['checked_out', 'checked_in'])
                                     ->whereMonth('created_at', Carbon::now()->month)
                                     ->whereYear('created_at', Carbon::now()->year)
                                     ->sum('total_price');

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'totalRooms',
            'currentGuests',
            'newReservationsToday',
            'monthlyRevenue'
        ));
    }
}