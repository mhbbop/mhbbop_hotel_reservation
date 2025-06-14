<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil data reservasi milik user tersebut, beserta data kamar yang terhubung
        $reservations = $user->reservations()->with('room')->latest()->get();

        // Kirim data ke view
        return view('dashboard', compact('reservations'));
    }
}