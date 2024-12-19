<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SantriController extends Controller
{
    public function index()
    {
        $santris = Santri::with('kelas')->get();
        $kelas = Kelas::all();

        return view('santri.santri', [
            'kelas' => $kelas,
            'santris' => $santris,
        ]);
    }



    public function tambahSantri(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'nis' => 'required|digits:10|unique:santris,nis',
            'alamat' => 'required',
            'no_hp' => 'nullable|digits_between:10,12|unique:santris,no_hp',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kelas_id' => 'required|exists:kelas,id',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nis.required' => 'NIS harus diisi.',
            'nis.digits' => 'NIS harus terdiri dari 10 digit.',
            'nis.unique' => 'NIS sudah ada.',
            'alamat.required' => 'Alamat harus diisi.',
            'no_hp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 12 digit.',
            'no_hp.unique' => 'Nomor HP sudah ada.',
            'jenis_kelamin.in' => 'Jenis kelamin harus diisi dengan "laki-laki" atau "perempuan".',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
            'kelas_id.required' => 'Kelas harus diisi.',
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid.',
        ]);

        try {
            $santri = new Santri();
            $santri->nama = $validatedData['nama'];
            $santri->nis = $validatedData['nis'];
            $santri->alamat = $validatedData['alamat'];
            $santri->no_hp = $validatedData['no_hp'];
            $santri->jenis_kelamin = $validatedData['jenis_kelamin'];
            $santri->kelas_id = $validatedData['kelas_id'];

            // Generate a random alphanumeric slug
            $slug = Str::random(18);
            $santri->slug = $slug;

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = 'santri_' . time() . '.' . $foto->getClientOriginalExtension();
                $fotoPath = $foto->storeAs('public/uploads', $fotoName);
                $santri->foto = 'uploads/' . $fotoName;
            }

            $santri->save();

            return redirect('santri')->with('success', 'Data berhasil ditambahkan');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode === 1062) {
                if (str_contains($e->getMessage(), 'santris.nis')) {
                    return redirect()->back()->with('error', 'NIS sudah ada.');
                }
                if (str_contains($e->getMessage(), 'santris.no_hp')) {
                    return redirect()->back()->with('error', 'Nomor HP sudah ada.');
                }
                return redirect()->back()->with('error', 'Duplikat! Data sudah ada.');
            } else {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah foto.');
        }
    }


    public function edit($idSantri)
    {
        $santri = Santri::findOrFail($idSantri);
        $kelas = Kelas::all();
        return view('santri.edit', compact('santri', 'kelas'));
    }

    public function update(Request $request, $idSantri)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'nis' => 'required|digits:10|unique:santris,nis,' . $idSantri . ',idSantri',
            'alamat' => 'required',
            'no_hp' => 'nullable|digits_between:10,12|unique:santris,no_hp,' . $idSantri . ',idSantri',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kelas_id' => 'required|exists:kelas,id',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nis.required' => 'NIS harus diisi.',
            'nis.digits' => 'NIS harus terdiri dari 10 digit.',
            'nis.unique' => 'NIS sudah ada.',
            'alamat.required' => 'Alamat harus diisi.',
            'no_hp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 12 digit.',
            'no_hp.unique' => 'Nomor HP sudah ada.',
            'jenis_kelamin.in' => 'Jenis kelamin harus diisi dengan "laki-laki" atau "perempuan".',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
            'kelas_id.required' => 'Kelas harus diisi.',
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid.',
        ]);

        try {
            $santri = Santri::findOrFail($idSantri);
            $santri->nama = $validatedData['nama'];
            $santri->nis = $validatedData['nis'];
            $santri->alamat = $validatedData['alamat'];
            $santri->no_hp = $validatedData['no_hp'];
            $santri->jenis_kelamin = $validatedData['jenis_kelamin'];
            $santri->kelas_id = $validatedData['kelas_id'];

            if ($request->hasFile('foto')) {
                // Delete old photo if it exists
                if ($santri->foto) {
                    Storage::delete('public/' . $santri->foto);
                }

                $foto = $request->file('foto');
                $fotoName = 'santri_' . time() . '.' . $foto->getClientOriginalExtension();
                $fotoPath = $foto->storeAs('public/uploads', $fotoName);
                $santri->foto = 'uploads/' . $fotoName;
            }

            $santri->save();

            return redirect('santri')->with('success', 'Data berhasil diupdate');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode === 1062) {
                if (str_contains($e->getMessage(), 'santris.nis')) {
                    return redirect()->back()->with('error', 'NIS sudah ada.');
                }
                if (str_contains($e->getMessage(), 'santris.no_hp')) {
                    return redirect()->back()->with('error', 'Nomor HP sudah ada.');
                }
                return redirect()->back()->with('error', 'Duplikat! Data sudah ada.');
            } else {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah foto.');
        }
    }




    public function hapus($idSantri)
    {
        $santri = Santri::findOrFail($idSantri);

        if ($santri->foto) {
            Storage::delete('public/' . $santri->foto);
        }

        $santri->delete();

        return redirect('santri')->with('success', 'Data santri berhasil dihapus');
    }


    // scanner
    // public function scanner()
    // {
    //     $santri = Santri::first();
    //     return view('santri.scenner', compact('santri'));
    // }
}
