<x-layout>
    @section('main')
    <x-header></x-header>
    <x-sidebar></x-sidebar>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Izin Santri Hari ini</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Santri Izin</a></li>
                    <li class="breadcrumb-item active">Izin</li>
                </ol>
            </nav>
        </div><!-- Akhir Judul Halaman -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">laporan</h5>
                            @if(request('filterDate'))
                                <p>Filter: {{ request('filterDate') }}</p>
                            @endif
                            <table class="table">
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
                </div>
            </div>
        </section>
    </main><!-- Akhir #main -->
    @endsection
    <script>
    function submitPrintForm() {
        document.getElementById('printForm').submit();
    }
</script>
</x-layout>
