<x-layout>
    @section('main')
    <x-header></x-header>
    <x-sidebar></x-sidebar>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Guru</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Data Guru</a></li>
                    <li class="breadcrumb-item active">Guru</li>
                </ol>
            </nav>
        </div><!-- Akhir Judul Halaman -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Guru</h5>
                            <!-- Tabel dengan baris terstrip -->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-santri">
                                <i class="ri-add-circle-line"></i>Add
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="tambah-santri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg"> <!-- Tambahkan kelas modal-lg di sini untuk modal yang lebih besar -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Santri</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="card-title">Tambah santri</h5>
                                            <form action="/tambahGuruKelas" method="POST">
                                                @csrf
                                                {{-- nama --}}
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-4 col-form-label">Guru </label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="user_id" id="">
                                                            <option>pilih guru</option>
                                                            @foreach ($guruskelas as $user)
                                                            <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <label for="username" class="col-sm-4 col-form-label">Kelas Mengajar</label>
                                                    <div class="col-sm-8 mt-2">
                                                        <select class="form-control" name="kelas_id" id="">
                                                            @foreach($kelas as $kelasItem)
                                                                <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama }}</option>
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
                            @if (session('success'))
                                <div class="mt-2 alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table id="example" class="contoh table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            <td>Nama</td>
                                            <td>Alamat</td>
                                            <td>No hp</td>
                                            <td>Guru kelas</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($guruskelas as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->nama }}</td>
                                                <td>{{ $user->alamat }}</td>
                                                <td>{{ $user->no_hp }}</td>
                                                <td>
                                                    @foreach($user->kelas as $kelas)
                                                        {{ $kelas->nama }}<br>
                                                    @endforeach
                                                </td>
                                            {{-- <td>{{ optional($user->roles)->nama }}</td> --}}
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
