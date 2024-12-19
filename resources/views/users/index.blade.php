<x-layout>
    @section('main')
    <x-header></x-header>
    <x-sidebar></x-sidebar>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Data pengguna</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </nav>
        </div><!-- Akhir Judul Halaman -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">User</h5>
                            <!-- Tabel dengan baris terstrip -->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-user">
                                Add <i class="ri-add-circle-line"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="tambah-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg"> <!-- Tambahkan kelas modal-lg di sini untuk modal yang lebih besar -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="card-title">Tambah users</h5>
                                            <form action="/user" method="POST">
                                                @csrf
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="nama">
                                                        @error('nama')
                                                                <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Username</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="username">
                                                        @error('username')
                                                                <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Password </label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" name="password">
                                                        @error('password')
                                                                <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Nip</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="nip">
                                                        @error('nip')
                                                                <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Alamat</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="alamat">
                                                        @error('alamat')
                                                                <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">No Hp</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="no_hp">
                                                        @error('no_hp')
                                                                <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Roles</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="role_id" id="role_id">
                                                            @foreach($role as $r) <!-- Ubah variabel dari $role menjadi $r -->
                                                                <option value="{{ $r->id }}">{{ $r->nama }}</option> <!-- Ubah $role menjadi $r -->
                                                            @endforeach
                                                        </select>
                                                        @error('role_id')
                                                                <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- tampil pesan --}}
                            @if ($errors->any())
                            <div class="mt-2 alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                            @endif

                            @if (session('success'))
                                <div class="mt-2 alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="mt-2 alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                            <table id="example" class="contoh table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <td>Nama</td>
                                        <td>Username</td>
                                        <td>Alamat</td>
                                        <td>No hp</td>
                                        <td>Status</td>
                                        <td>Edit</td>
                                        <td>Hapu</td>
                                    </tr>
                                </thead>
                                <tbody>
                               @foreach ($user as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->alamat }}</td>
                                    <td>{{ $user->no_hp }}</td>
                                    <td>{{ $user->role->nama }}</td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#edituser{{ $user->id }}"> Edit</a>

                                        {{-- modal edit --}}
                                        <div class="modal fade" id="edituser{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg"> <!-- Tambahkan kelas modal-lg di sini untuk modal yang lebih besar -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5 class="card-title">Edit User</h5>
                                                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row mb-3">
                                                                <label for="nama" class="col-sm-2 col-form-label text-black">Nama</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="nama" value="{{ old('nama', $user->nama) }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="username" class="col-sm-2 col-form-label text-black">Username</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="password" class="col-sm-2 col-form-label text-black">Password</label>
                                                                <div class="col-sm-10">
                                                                    <input type="password" class="form-control" name="password">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="nip" class="col-sm-2 col-form-label text-black">NIP</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="nip" value="{{ old('nip', $user->nip) }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="alamat" class="col-sm-2 col-form-label text-black">Alamat</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $user->alamat) }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="no_hp" class="col-sm-2 col-form-label text-black">No Hp</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control text-black" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="role_id" class="col-sm-2 col-form-label text-black">Roles</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-control" name="role_id">
                                                                        @foreach($role as $r)
                                                                            <option value="{{ $r->id }}" {{ $user->role_id == $r->id ? 'selected' : '' }}>{{ $r->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('user.hapus', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm ri-delete-bin-line" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                @endsection
                            </table>
                            </div>
                            {{-- Akhir Tabel dengan baris terstrip --}}
                        </div>
                    </div>
                </div>
            </div>


        </section>
    </main><!-- Akhir #main -->
</x-layout>

