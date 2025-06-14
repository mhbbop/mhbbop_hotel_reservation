<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Selamat Datang - Hotel Kami</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative min-h-screen flex flex-col items-center justify-center hotel-bg">

            <div class="absolute top-0 right-0 p-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2 font-semibold text-white bg-black/20 rounded-md hover:bg-black/40 transition">Dashboard</a>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="px-5 py-2 font-semibold text-white rounded-md hover:bg-white/10 transition-colors duration-200">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2 font-semibold text-white bg-white/10 border border-white/30 rounded-md hover:bg-white/20 transition-colors duration-200">
                                Register
                            </a>
                        @endif
                    </div>
                @endauth
            </div>

            <div class="text-center text-white p-10 bg-black/50 rounded-lg shadow-xl backdrop-blur-sm">
                <h1 class="text-5xl font-bold tracking-wider">
                    Selamat Datang di Hotel Kami
                </h1>
                <p class="mt-4 text-lg text-white/80">
                    Nikmati kenyamanan dan pelayanan terbaik selama Anda menginap.
                </p>
            </div>

        </div>
    </body>
</html>