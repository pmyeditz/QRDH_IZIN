<x-layout>
    @section('main')
    <x-header></x-header>
    <x-sidebar></x-sidebar>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Izin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Data Izin</a></li>
                    <li class="breadcrumb-item active">Izin</li>
                </ol>
            </nav>
        </div><!-- Akhir Judul Halaman -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Izin</h5>
                            <!-- Tabel dengan baris terstrip -->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-santri">
                                <i class="ri-add-circle-line"></i>Add
                            </button>

                            {{-- Tombol Cetak --}}
                            <a class="btn btn-info" href="/cetakIzin"><i class='bx bx-printer'></i>Export</a>



                            <!-- Modal -->
                            <div class="modal fade" id="tambah-santri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Santri</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <h5 class="card-title">Izin Santri</h5>
                                                <form action="{{ url('/izinTambah') }}" method="POST">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <label for="santri_id" class="col-sm-2 col-form-label">Nama</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="santri_id" id="santri_id">
                                                                @foreach ($santris as $santri)
                                                                    <option value="{{ $santri->idSantri }}">{{ $santri->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('santri_id')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="alasan" class="col-sm-2 col-form-label">Alasan</label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" name="alasan" id="alasan" rows="4"></textarea>
                                                            @error('alasan')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="mulai_tgl" class="col-sm-2 col-form-label">Mulai</label>
                                                        <div class="col-sm-10">
                                                            <input type="date" class="form-control" name="mulai_tgl" id="mulai_tgl">
                                                            @error('mulai_tgl')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="sampai_tgl" class="col-sm-2 col-form-label">Sampai</label>
                                                        <div class="col-sm-10">
                                                            <input type="date" class="form-control" name="sampai_tgl" id="sampai_tgl">
                                                            @error('sampai_tgl')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="status" class="col-sm-2 col-form-label">Izin</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="status" id="status">
                                                                <option value="pulang">Pulang</option>
                                                                <option value="keperluan">Keperluan</option>
                                                                <option value="darurat">Darurat</option>
                                                            </select>
                                                            @error('status')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
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
                                        <td>No</td>
                                        <td>Nama</td>
                                        <td>Alasan</td>
                                        <td>Status</td>
                                        <td>Mulai</td>
                                        <td>Sampai</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($izins as $izin)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $izin->santri->nama }}</td> <!-- Nama Santri -->
                                            <td>{{ $izin->alasan }}</td>
                                            <td>{{ $izin->status }}</td>
                                            <td>{{ $izin->mulai_tgl }}</td>
                                            <td>{{ $izin->sampai_tgl }}</td>
                                            <td>
                                                <form action="{{ route('izin.hapus', $izin->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm ri-delete-bin-line"> Hapus</button>
                                                </form>
                                            </td>
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

