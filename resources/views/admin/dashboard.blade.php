@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold text-white drop-shadow-lg mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Kamar</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalRooms }}</p>
            </div>
            <div class="bg-blue-100 text-blue-500 p-4 rounded-full">
                <i class="fas fa-bed fa-2x"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Tamu Saat Ini (Check-in)</p>
                <p class="text-3xl font-bold text-gray-800">{{ $currentGuests }}</p>
            </div>
            <div class="bg-green-100 text-green-500 p-4 rounded-full">
                <i class="fas fa-user-check fa-2x"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Reservasi Baru (Hari ini)</p>
                <p class="text-3xl font-bold text-gray-800">{{ $newReservationsToday }}</p>
            </div>
            <div class="bg-yellow-100 text-yellow-500 p-4 rounded-full">
                <i class="fas fa-calendar-plus fa-2x"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Pendapatan (Bulan Ini)</p>
                <p class="text-3xl font-bold text-gray-800">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
            </div>
            <div class="bg-indigo-100 text-indigo-500 p-4 rounded-full">
                <i class="fas fa-dollar-sign fa-2x"></i>
            </div>
        </div>
    </div>

    <div class="mt-8">
        </div>
@endsection