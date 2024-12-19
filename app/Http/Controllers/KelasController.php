<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();

        // Mengembalikan view dengan data santri
        return view('santri.kelas', compact('kelas'));
    }

    public function tambah(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255|unique:kelas,nama',
        ], [
            'nama.unique' => 'Nama kelas sudah ada. Silakan gunakan nama kelas yang berbeda.',
        ]);

        // Simpan data ke database
        Kelas::create([
            'nama' => $request->nama,
        ]);

        // Redirect ke halaman daftar kelas dengan pesan sukses
        return redirect()->route('santri.kelas')->with('success', 'Data kelas berhasil ditambahkan');
    }



    // edit kelas
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate(
            [
                'nama' => 'required|string|max:255|unique:kelas,nama,' . $id,
            ],
            [
                'nama.unique' => 'Nama kelas sudah ada. Silakan gunakan nama kelas yang berbeda.',
            ]
        );

        // Temukan kelas berdasarkan ID dan perbarui data
        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama' => $request->nama,
        ]);

        // Redirect ke halaman daftar kelas dengan pesan sukses
        return redirect()->route('santri.kelas')->with('success', 'Data kelas berhasil diperbarui');
    }


    public function hapus($id)
    {
        // Temukan kelas berdasarkan ID dan hapus data
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        // Redirect ke halaman daftar kelas dengan pesan sukses
        return redirect()->route('santri.kelas')->with('success', 'Data kelas berhasil dihapus');
    }
}
