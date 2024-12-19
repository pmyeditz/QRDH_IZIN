<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\GuruKelas;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 2)->get();
        return view('guru.gurukelas', [
            'users' => $users
        ]);
    }



    // tambah guru kels
    // public function tambah(Request $request)
    // {
    //     // Validasi data yang dikirimkan dari formulir
    //     $validatedData = $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'kelas_id' => 'required|exists:kelas,id',
    //     ]);

    //     // Periksa apakah guru sudah memiliki kelas yang sama
    //     $guru = User::findOrFail($validatedData['user_id']);
    //     $kelas = Kelas::findOrFail($validatedData['kelas_id']);

    //     if ($guru->kelas()->where('kelas_id', $kelas->id)->exists()) {
    //         return redirect()->route('guru.index')->with('error', 'Guru sudah memiliki kelas ini.');
    //     }

    //     // Simpan data GuruKelas jika belum memiliki kelas yang sama
    //     GuruKelas::create([
    //         'user_id' => $validatedData['user_id'],
    //         'kelas_id' => $validatedData['kelas_id'],
    //     ]);

    //     return redirect()->route('guru.index')->with('success', 'Data kelas berhasil ditambahkan');
    // }


    // public function edit(Request $request)
    // {
    //     // Validasi data yang dikirimkan dari formulir
    //     $validatedData = $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'kelas_id' => 'required|exists:kelas,id',
    //     ]);

    //     if ($request->filled('id')) {
    //         // Edit data
    //         $guruKelas = GuruKelas::findOrFail($request->id);
    //         $guruKelas->update([
    //             'user_id' => $validatedData['user_id'],
    //             'kelas_id' => $validatedData['kelas_id'],
    //         ]);
    //     } else {
    //         // Tambah data baru
    //         GuruKelas::create([
    //             'user_id' => $validatedData['user_id'],
    //             'kelas_id' => $validatedData['kelas_id'],
    //         ]);
    //     }

    //     return redirect()->route('guru.index')->with('success', 'Data kelas berhasil disimpan');
    // }

    // // tampil
    // public function guruKelas()
    // {
    //     $guru = GuruKelas::all();
    //     $users = User::with('Kelas')->where('role_id', 2)->get();
    //     return view('guru.gurukelas', [
    //         'user' => $users,
    //         'guru' => $guru,
    //     ]);
    // }
}
