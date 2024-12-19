<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function proses(Request $request)
    {
        // Validasi kredensial input
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // Coba autentikasi pengguna
        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil
            $user = Auth::user();

            // Periksa role_id pengguna dan tangani setiap peran dengan tepat
            if ($user->role_id == 1) {
                // Tangani role_id 1
                // Contoh, alihkan ke dashboard admin
                return redirect()->intended('/dashboard');
            } elseif ($user->role_id == 2) {
                // Tangani role_id 2
                // Contoh, alihkan ke dashboard pengguna
                return redirect()->intended('/dashboard');
            } elseif ($user->role_id == 3) {
                // Tangani role_id 3
                // Contoh, alihkan ke dashboard moderator
                return redirect()->intended('/dashboard');
            } else {
                // Tangani peran lainnya atau alihkan ke halaman default
                return redirect()->intended('/dashboard');
            }
        }

        // Autentikasi gagal, tampilkan pesan kesalahan
        session()->flash('gagal', 'Username dan password salah!!!');
        return redirect('/login')->withInput($request->only('username')); // Mempertahankan username di field input
    }



    // logout

    public function logout(Request $request)
    {
        Session::flush();

        Auth::logout();

        return redirect('/login');
    }
}
