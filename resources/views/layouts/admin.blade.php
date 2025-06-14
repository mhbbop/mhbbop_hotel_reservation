<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hotel Kami</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans"> <div class="flex">
       <div class="w-64 min-h-screen bg-white/80 backdrop-blur-sm text-gray-800 p-4 flex flex-col justify-between shadow-lg z-10">
            <div>
                <h2 class="text-2xl font-bold mb-6 text-center text-gray-900">Hotel Admin</h2>
                <nav>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 text-gray-700">
                        <i class="fas fa-tachometer-alt w-6"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.rooms.index') }}" class="flex items-center mt-2 py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 text-gray-700">
                        <i class="fas fa-bed w-6"></i>
                        <span class="ml-3">Manajemen Kamar</span>
                    </a>
                    <a href="{{ route('admin.reservations.index') }}" class="flex items-center mt-2 py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 text-gray-700">
                        <i class="fas fa-users w-6"></i>
                        <span class="ml-3">Manajemen Tamu</span>
                    </a>
                </nav>
            </div>
        </div>

        {{-- Tambahkan kelas hotel-bg di sini --}}
        <div class="w-full flex flex-col hotel-bg">
            <header class="w-full bg-white/80 backdrop-blur-sm p-4 flex justify-end items-center shadow-sm">
                <div class="flex items-center">
                    <span class="mr-4 font-semibold">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-red-500 transition duration-200">
                            <i class="fas fa-sign-out-alt fa-lg"></i>
                        </button>
                    </form>
                </div>
            </header>

            <main class="w-full p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>