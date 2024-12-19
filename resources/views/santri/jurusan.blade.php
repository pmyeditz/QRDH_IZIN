<x-layout>
    @section('main')
    <x-header></x-header>
    <x-sidebar></x-sidebar>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Jurusan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Data Santri</a></li>
                    <li class="breadcrumb-item active">Jurusan</li>
                </ol>
            </nav>
        </div><!-- Akhir Judul Halaman -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jurusan</h5>
                            <!-- Tabel dengan baris terstrip -->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-santri">
                                Tambah
                            </button>

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
                                                <h5 class="card-title">General Form Elements</h5>
                                                <form>
                                                    <div class="row mb-3">
                                                        <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                        <div class="col-sm-10">
                                                            <input type="email" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputNumber" class="col-sm-2 col-form-label">Number</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="file" id="formFile">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                                                        <div class="col-sm-10">
                                                            <input type="date" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputTime" class="col-sm-2 col-form-label">Time</label>
                                                        <div class="col-sm-10">
                                                            <input type="time" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputPassword" class="col-sm-2 col-form-label">Textarea</label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" style="height: 100px"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label">Select</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-select" aria-label="Default select example">
                                                                <option selected="">Open this select menu</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                            <table id="example" class="contoh table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <td>Id</td>
                                        <td>Nama</td>
                                        <td>alamat</td>
                                        <td>jenis kelamin</td>
                                        <td>Tahun Masuk</td>
                                        <td>Generate</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($santri as $snt)
                                        <tr>
                                            <td>{{ $snt->id }}</td>
                                            <td>{{ $snt->nama }}</td>
                                            <td>{{ $snt->alamat }}</td>
                                            <td>{{ $snt->jenis_kelamin }}</td>
                                            <td>{{ $snt->tahun_masuk }}</td>
                                            <td>
                                                <a href="{{ route('generate', $snt->id) }}" class="btn btn-primary">Generate</a>
                                            </td>
                                    @endforeach --}}
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

