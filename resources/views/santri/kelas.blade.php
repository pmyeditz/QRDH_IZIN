<x-layout>
    @section('main')
    <x-header></x-header>
    <x-sidebar></x-sidebar>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Kelas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Data Santri</a></li>
                    <li class="breadcrumb-item active">Kekas</li>
                </ol>
            </nav>
        </div><!-- Akhir Judul Halaman -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Kelas</h5>
                            <!-- Tabel dengan baris terstrip -->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-santri">
                                Add <i class="ri-add-circle-line"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="tambah-santri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg"> <!-- Tambahkan kelas modal-lg di sini untuk modal yang lebih besar -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelas</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="card-title">Tambah kelas</h5>
                                            <form action="/tambahKelas" method="POST">
                                                @csrf
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="nama">
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
                            @if (session('success'))
                                <div class="mt-2 alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @error('nama')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                            <div class="table-responsive">
                            <table id="example" class="contoh table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <td>Nama</td>
                                        <td>Edit</td>
                                        <td>Hapus</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($kelas as $kls)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kls->nama }}</td>
                                        <td>
                                            <a href="#" class="bi bi-pencil-square btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{ $kls->id }}"> Edit</a>

                                            {{-- modal edit --}}
                                            <div class="modal fade" id="edit{{ $kls->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kelas</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('kelas.update', $kls->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="nama" class="form-label">Nama Kelas</label>
                                                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $kls->nama }}" required>
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
                                        </td>
                                        <td>
                                            <form action="/kelas/{{ $kls->id }}" method="POST" onsubmit="return confirm('Apakah yakin ingin menghapus?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm ri-delete-bin-line"> hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                            {{-- Akhir Tabel dengan baris terstrip --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- Akhir #main -->
    @endsection
</x-layout>

