<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    // Halaman users
    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        return view('users.index', [
            'user' => $users,
            'role' => $roles,
        ]);
    }

    // Tambah users
    public function tambahUser(Request $request)
    {
        // Validasi data yang diinput
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
            'nip' => 'nullable|string|regex:/^\d{9,18}$/|unique:users,nip',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20|unique:users,no_hp',
            'role_id' => 'required|exists:roles,id',
        ], [
            'nama.required' => 'Kolom nama harus diisi.',
            'username.required' => 'Kolom username harus diisi.',
            'username.unique' => 'Username sudah terdaftar.',
            'password.required' => 'Kolom kata sandi harus diisi.',
            'password.min' => 'Kata sandi minimal harus terdiri dari 8 karakter.',
            'nip.regex' => 'NIP harus terdiri dari 9 hingga 18 digit angka.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'alamat.required' => 'Kolom alamat harus diisi.',
            'no_hp.required' => 'Kolom nomor handphone harus diisi.',
            'no_hp.unique' => 'Nomor handphone sudah terdaftar.',
            'role_id.required' => 'Kolom peran harus diisi.',
            'role_id.exists' => 'Peran yang dipilih tidak valid.',
        ]);

        try {
            // Buat pengguna baru dengan data yang sudah divalidasi
            $user = User::create([
                'nama' => $validatedData['nama'],
                'username' => $validatedData['username'],
                'password' => bcrypt($validatedData['password']),
                'nip' => $validatedData['nip'],
                'alamat' => $validatedData['alamat'],
                'no_hp' => $validatedData['no_hp'],
                'role_id' => $validatedData['role_id'],
            ]);

            return redirect('user')->with('success', 'Data berhasil ditambahkan');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode === 1062) {
                return redirect()->back()->with('error', 'Data sudah ada. Harap gunakan data yang berbeda.');
            } else {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data.');
            }
        }
    }

    // Edit user
    public function edit($id)
    {
        // Ambil data user berdasarkan id
        $user = User::findOrFail($id);

        // Ambil semua role untuk dropdown pada form edit
        $roles = Role::all();

        // Tampilkan view dengan data user dan roles
        return view('user.user', compact('user', 'roles'));
    }

    // Fungsi update untuk menyimpan perubahan data user
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form dengan pesan khusus untuk username yang mengandung spasi
        $request->validate([
            'nama' => 'required|string|max:30',
            'username' => [
                'required',
                'string',
                'max:255',
                'unique:users,username,' . $id,
                'regex:/^\S*$/u' // memastikan username tidak ada spasi
            ],
            'password' => 'nullable|string|min:8',
            'nip' => 'nullable|string|regex:/^\d{9,18}$/|unique:users,nip,' . $id,
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:15|unique:users,no_hp,' . $id,
            'role_id' => 'required|exists:roles,id',
        ], [
            'username.regex' => 'Username tidak boleh menggunakan spasi.',
            'nip.regex' => 'NIP harus terdiri dari 9 hingga 18 digit angka.',
        ]);

        try {
            // Ambil data user berdasarkan id
            $user = User::findOrFail($id);

            // Update data user dengan data yang baru
            $user->nama = $request->nama;
            $user->username = strtolower($request->username); // ubah username menjadi huruf kecil
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->nip = $request->nip;
            $user->alamat = $request->alamat;
            $user->no_hp = $request->no_hp;
            $user->role_id = $request->role_id;

            // Simpan perubahan
            $user->save();

            // Redirect ke halaman yang sesuai dengan pesan sukses
            return redirect()->route('users.index')->with('success', 'Data user berhasil diupdate.');
        } catch (\Exception $e) {
            // Redirect ke halaman yang sesuai dengan pesan error jika terjadi kesalahan
            return redirect()->route('users.index')->with('error', 'Terjadi kesalahan saat mengupdate data user.');
        }
    }

    // Hapus user
    public function hapusUser(User $user)
    {
        try {
            $user->delete();
            return redirect()->back()->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus user.');
        }
    }
}
