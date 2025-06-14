<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN rolenya adalah 'admin'
        if (Auth::check() && Auth::user()->role == 'admin') {
            // Jika ya, lanjutkan request
            return $next($request);
        }

        // Jika tidak, kembalikan ke halaman login atau halaman lain dengan pesan error
        return redirect('/login')->with('error', 'You do not have admin access.');
    }
}