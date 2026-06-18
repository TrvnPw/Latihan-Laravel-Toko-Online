<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Pastikan user sudah login
        if (Auth::check()) {
            // 2. Cek role. Kalau dia Super Admin (1) atau Admin (0), silakan masuk!
            if (Auth::user()->role == 1 || Auth::user()->role == 0) {
                return $next($request);
            }

            // 3. Kalau dia Member Biasa (2), tendang balik ke halaman utama (frontend)
            return redirect('/')->with('error', 'Akses ditolak! Halaman ini khusus Admin.');
        }

        // Kalau belum login sama sekali, lempar ke halaman login
        return redirect()->route('login');
    }
}
