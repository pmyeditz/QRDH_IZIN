<x-layout>

    @section('main')
    <x-header></x-header>
    <x-sidebar></x-sidebar>
    <main id="main" class="main">
        <div class="pagetitle">
          <h1>Dashboard</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </nav>
        </div>

        <section class="section dashboard">
          <div class="row">

            <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">
                        {{-- jumlah semua santri --}}
                        <div class="col-xxl-6 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Data <span>| Santri</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6> {{ $jumlahSantri }}</h6>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        {{-- jumlah guru --}}
                        {{-- <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Guru <span>| Pengajar</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $jumlahUserDenganId2 }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> --}}

                        {{-- jumlah santri izin hari ini --}}
                        <div class="col-xxl-6 col-xl-12">

                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Jumlah <span>| Izin Hari ini</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $jumlahSantriIzinHariIni }}</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                <div class="col-md">
                    <div class="row">
                        <div class="col-xl-4 col-xl-12">
                            <div class="card info-card revenue-card">
                                {{-- Tambahkan kode chart di sini --}}
                                <canvas id="izinChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Right side columns -->
            <div class="col-lg-4">
              <!-- Recent Activity -->
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Santri izin <span>| hari ini</span></h5>
                        <div class="activity">
                            @php
                                // Daftar kelas warna Bootstrap
                                $colors = ['text-success', 'text-danger', 'text-primary', 'text-info', 'text-warning', 'text-muted', 'text-secondary', 'text-dark'];
                            @endphp
                            @foreach ($izinsHariIni as $izin)
                            @php
                                // Pilih warna acak
                                $randomColor = $colors[array_rand($colors)];
                            @endphp
                            <div class="activity-item d-flex">
                                <div class="col-md-4">
                                    <div class="activite-label">{{ $loop->iteration }}. {{ $izin->santri->nama }}</div>
                                </div>
                                <i class='bi bi-circle-fill activity-badge {{ $randomColor }} align-self-start'></i>
                                {{ $izin->status }},
                                <div class="activity-content">
                                    {{ $izin->alasan }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <script>
    var ctx = document.getElementById('izinChart').getContext('2d');
    var izinChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ],
            datasets: [{
                label: 'Jumlah Izin',
                data: {!! json_encode($jumlahSantriIzinPerBulan) !!},
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
      </main><!-- End #main -->
    @endsection

</x-layout>
