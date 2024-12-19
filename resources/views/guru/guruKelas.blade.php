<x-layout>
    @section('main')
    <x-header></x-header>
    <x-sidebar></x-sidebar>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>guru</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/guru">Data Guru</a></li>
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
                                        <td>Nip</td>
                                        <td>Alamat</td>
                                        <td>No hp</td>
                                    </tr>
                                </thead>
                                <tbody>
                               @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->nip }}</td>
                                    <td>{{ $user->alamat }}</td>
                                    <td>{{ $user->no_hp }}</td>
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

