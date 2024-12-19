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
                            {{-- Tombol Cetak --}}
                            {{-- <a class="btn btn-info" href="/cetakKartu"><i class='bi bi-person-vcard'></i> Cetak Kartu</a> --}}
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
                                        <td>Card</td>
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
                                        <td>
                                            @if ($snt->foto)
                                                <img src="{{ asset('storage/' . $snt->foto) }}" width="40" alt="Foto Santri">
                                            @else
                                                <span>Tidak ada foto</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{ route('santri.qrcode', $snt->slug) }}"><i class='bi bi-person-vcard'> Generate</i></a>
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

