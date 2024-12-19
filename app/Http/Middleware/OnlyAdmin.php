<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah terautentikasi dan memiliki role_id 1
        if (Auth::check() && Auth::user()->role_id == 1) {
            // Lanjutkan permintaan ke tujuan berikutnya
            return $next($request);
        }

        // Jika pengguna tidak memiliki role_id 1, alihkan atau tampilkan pesan kesalahan
        return redirect('/dashboard'); // Alihkan ke halaman beranda atau halaman lain yang diinginkan
    }
}
