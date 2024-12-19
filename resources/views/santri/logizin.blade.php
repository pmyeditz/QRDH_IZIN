<x-layout>
    @section('main')
    <x-header></x-header>
    <x-sidebar></x-sidebar>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Laporan perizinan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/logizin">Laporan Perizinan</a></li>
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
                            <div class="card-body pt-3">
                            <!-- Tab Bordered -->
                                <ul class="nav nav-tabs nav-tabs-bordered">

                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#laporanBulan">Laporan Izin</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#hariIni">Izin Hari Ini</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="laporanBulan">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <form id="filterForm" method="GET" action="{{ route('logizin.index') }}" class="d-flex">
                                            <div class="col">
                                                <div class="row mb-3 align-items-center">
                                                    <div class="col-md-6">
                                                        <label for="filterDate" class="form-label text-white">Pilih Tanggal</label>
                                                        <input type="month" id="filterDate" name="filterDate" class="form-control" value="{{ request('filterDate') }}">
                                                    </div>
                                                    <div class="col-md-4 align-self-end">
                                                        <button type="submit" class="btn btn-primary">Filter</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        @php
                                            $role = Auth::user()->role->nama;
                                        @endphp
                                        @if($role == 'pengurus' || $role == 'admin')
                                        <a href="{{ route('logizin.export', ['filterDate' => request('filterDate')]) }}" class="btn btn-info">
                                            <i class='bx bx-printer'></i> Export
                                        </a>
                                        @endif
                                    </div>

                                    <div class="table-responsive" id="printTable">
                                        <table id="example" class="contoh table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <td>No</td>
                                                    <td>Nama</td>
                                                    <td>Kelas</td>
                                                    <td>Alasan</td>
                                                    <td>Status</td>
                                                    <td>Mulai</td>
                                                    <td>Sampai</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allIzins as $izin)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $izin->santri->nama }}</td>
                                                        <td>{{ $izin->santri->kelas->nama }}</td>
                                                        <td>{{ $izin->alasan }}</td>
                                                        <td>{{ $izin->status }}</td>
                                                        <td>{{ $izin->mulai_tgl }}</td>
                                                        <td>{{ $izin->sampai_tgl }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <script>
                                    function printTable() {
                                        const printContent = document.getElementById('printTable').outerHTML;
                                        const originalContent = document.body.innerHTML;

                                        document.body.innerHTML = printContent;
                                        window.print();
                                        document.body.innerHTML = originalContent;
                                        location.reload();
                                    }
                                </script>


                                <div class="tab-pane fade profile-edit pt-3" id="hariIni">
                                    <div class="table-responsive">
                                        <table id="example" class="contoh table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <td>No</td>
                                                    <td>Nama</td>
                                                    <td>Kelas</td>
                                                    <td>Alasan</td>
                                                    <td>Status</td>
                                                    <td>Mulai</td>
                                                    <td>Sampai</td>
                                                    <td>Kop Surat</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($izinsHariIni as $izin)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $izin->santri->nama }}</td>
                                                        <td>{{ $izin->santri->kelas->nama }}</td>
                                                        <td>{{ $izin->alasan }}</td>
                                                        <td>{{ $izin->status }}</td>
                                                        <td>{{ $izin->mulai_tgl }}</td>
                                                        <td>{{ $izin->sampai_tgl }}</td>
                                                        <td>
                                                            <a href="/kopsurat/{{ $izin->slug }}" class="btn btn-warning btn-sm"><i class='bx bx-envelope'></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- Akhir #main -->
    @endsection
</x-layout>

