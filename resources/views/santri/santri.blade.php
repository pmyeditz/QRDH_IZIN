<x-layout>
    @section('main')
    <x-header></x-header>
    <x-sidebar></x-sidebar>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Santri</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Data Santri</a></li>
                    <li class="breadcrumb-item active">Santri</li>
                </ol>
            </nav>
        </div><!-- Akhir Judul Halaman -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Santri</h5>
                            <!-- Tabel dengan baris terstrip -->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-santri">
                                <i class="ri-add-circle-line"></i>Add
                            </button>
                            {{-- Tombol Cetak --}}
                            <a class="btn btn-info" href="/cetakSantri"><i class='bx bx-printer'></i>Export</a>

                            <!-- Modal -->
                            <div class="modal fade" id="tambah-santri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg"> <!-- Tambahkan kelas modal-lg di sini untuk modal yang lebih besar -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Santri</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <h5 class="card-title">form Data santri</h5>
                                                <form action="{{ route('santri.tambah') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}">
                                                            @error('nama')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="nis" class="col-sm-2 col-form-label">Nis</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="nis" class="form-control" id="nis" value="{{ old('nis') }}">
                                                            @error('nis')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="alamat" class="form-control" id="alamat" value="{{ old('alamat') }}">
                                                            @error('alamat')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="no_hp" class="form-control" id="no_hp" value="{{ old('no_hp') }}">
                                                            @error('no_hp')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-select" name="jenis_kelamin" aria-label="Default select example" id="jenis_kelamin">
                                                                <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                                <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                            </select>
                                                            @error('jenis_kelamin')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="foto" class="col-sm-2 col-form-label">File Upload</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" name="foto" type="file" id="foto">
                                                            @error('foto')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label">Kelas</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="kelas_id" id="kelas_id">
                                                                @foreach($kelas as $r)
                                                                    <option value="{{ $r->id }}" {{ old('kelas_id') == $r->id ? 'selected' : '' }}>{{ $r->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('kelas_id')
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
                            </div>
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
                                        <td>No</td>
                                        <td>Nama</td>
                                        <td>Nis</td>
                                        <td>alamat</td>
                                        <td>No HP</td>
                                        <td>Kelas</td>
                                        <td>Foto</td>
                                        <td>Edit</td>
                                        <td>Hapus</td>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($santris as $snt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $snt->nama }}</td>
                                        <td>{{ $snt->nis }}</td>
                                        <td>{{ $snt->alamat }}</td>
                                        <td>{{ $snt->no_hp }}</td>
                                        <td>{{ $snt->kelas ? $snt->kelas->nama : 'Tidak ada kelas' }}</td>
                                        <td class="photo-cell">
                                            @if ($snt->foto)
                                                <div class="photo-container">
                                                    <div class="photo-wrapper">
                                                        <img src="{{ asset('storage/' . $snt->foto) }}" alt="Foto Santri">
                                                        <div class="hover-overlay">
                                                            <i class="bi bi-eye" data-bs-toggle="modal" data-bs-target="#imageModal{{ $loop->index }}"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal img -->
                                                <div class="modal fade" id="imageModal{{ $loop->index }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $loop->index }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center">
                                                                <img src="{{ asset('storage/' . $snt->foto) }}" class="img-fluid" alt="Foto Santri">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span>Tidak ada foto</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#editsantri{{ $snt->idSantri }}"> Edit</a>

                                            {{-- modal edit --}}
                                            <div class="modal fade" id="editsantri{{ $snt->idSantri }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg"> <!-- Tambahkan kelas modal-lg di sini untuk modal yang lebih besar -->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Santri</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5 class="card-title">Edit User</h5>
                                                            <form action="{{ route('santri.update', $snt->idSantri) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row mb-3">
                                                                <label for="nama" class="col-sm-2 col-form-label text-black">Nama</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="nama" value="{{ $snt->nama }}">
                                                                    @error('nama')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="nis" class="col-sm-2 col-form-label text-black">Nis</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="nis" value="{{ $snt->nis }}">
                                                                    @error('nis')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="alamat" class="col-sm-2 col-form-label text-black">Alamat</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="alamat" value="{{ $snt->alamat }}">
                                                                    @error('alamat')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="no_hp" class="col-sm-2 col-form-label text-black">No hp</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="no_hp" value="{{ $snt->no_hp }}">
                                                                    @error('no_hp')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="jenis_kelamin" class="col-sm-2 col-form-label text-black">Jenis Kelamin</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-select" name="jenis_kelamin" aria-label="Default select example" id="jenis_kelamin">
                                                                        <option value="laki-laki" {{ $snt->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                                        <option value="perempuan" {{ $snt->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                                    </select>
                                                                    @error('jenis_kelamin')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="foto" class="col-sm-2 col-form-label text-black">Foto</label>
                                                                <div class="col-sm-10">
                                                                    @if($snt->foto)
                                                                        <input type="hidden" name="foto_old" value="{{ $snt->foto }}">
                                                                        <img src="{{ asset('storage/' . $snt->foto) }}" alt="Foto Santri" width="100">
                                                                    @endif
                                                                    <input type="file" class="form-control mb-2" id="foto" name="foto">
                                                                    @error('foto')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="kelas" class="col-sm-2 col-form-label text-black">Kelas</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-control" name="kelas_id">
                                                                        @foreach($kelas as $r)
                                                                            <option value="{{ $r->id }}" @if($r->id == $snt->kelas_id) selected @endif>{{ $r->nama }}</option>
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
                                            <form action="{{ route('santri.hapus', $snt->idSantri) }}" method="POST" onsubmit="return confirm('Apakah yakin ingin menghapus?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm ri-delete-bin-line"> Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                            <!-- Akhir Tabel dengan baris terstrip -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- Akhir #main -->
    @endsection
</x-layout>

