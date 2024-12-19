<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Ambil semua peran dari basis data
        $roles = Role::all();

        // Kirim data pengguna dan peran ke view
        return view('profiles.profile', compact('user', 'roles'));
    }


    // update

    public function update(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'role_id' => 'required|exists:roles,id',
            'current_password' => 'required',
            'new_password' => 'nullable|min:8|confirmed', // Memastikan kata sandi baru cocok dengan konfirmasi kata sandi baru
        ], [
            'nama.required' => 'Kolom nama harus diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'username.required' => 'Kolom username harus diisi.',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter.',
            'alamat.required' => 'Kolom alamat harus diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'no_hp.required' => 'Kolom no hp harus diisi.',
            'no_hp.max' => 'No hp tidak boleh lebih dari 20 karakter.',
            'role_id.required' => 'Kolom peran harus diisi.',
            'role_id.exists' => 'Peran yang dipilih tidak valid.',
            'current_password.required' => 'Masukan Password saat ini untuk mengubah data.',
            'new_password.min' => 'Kata sandi baru minimal harus terdiri dari 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        try {
            $user = Auth::user();

            // Jika pengguna mengirimkan kata sandi baru, kita perbarui kata sandi mereka
            if ($request->filled('new_password')) {
                $user->update(['password' => bcrypt($validatedData['new_password'])]);
            }

            $user->update($validatedData);

            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui profil.');
        }
    }
}
