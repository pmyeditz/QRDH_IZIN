

<x-layout>
    @section('main')
    <x-header></x-header>
    <x-sidebar></x-sidebar>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Card Izin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/card">Kartu Izin</a></li>
                    <li class="breadcrumb-item active">Kartu</li>
                </ol>
            </nav>
        </div><!-- Akhir Judul Halaman -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Kartu</h5>
                            <div class="card card-custom">
                                <div class="card-header card-header-custom">
                                    SANTRIS CARD
                                </div>
                                <img src="{{ asset('storage/' . $santri->foto) }}" class="card-img-top card-img-top-custom" alt="Foto Santri">
                                <div class="card-body card-body-custom">
                                    <h6 class="card-title-custom">Kartu Santri</h6>
                                    <p class="card-text card-text-custom"><strong>Nama:</strong> {{ $santri->nama }}</p>
                                    <p class="card-text card-text-custom"><strong>NIS:</strong> {{ $santri->nis }}</p>
                                    <p class="card-text card-text-custom"><strong>Alamat:</strong> {{ $santri->alamat }}</p>
                                    <p class="card-text card-text-custom"><strong>Jenis Kelamin:</strong> {{ $santri->jenis_kelamin }}</p>
                                </div>
                                <div class="card-footer card-footer-custom">
                                    <div class="qrcode">
                                        {!! $qrcode !!}
                                    </div>
                                </div>
                            </div>
                        <button class="btn btn-primary mt-3" onclick="printCard()">Print</button>
                        <script>
                            function printCard() {
                                var originalContents = document.body.innerHTML;
                                var printContents = document.querySelector('.card.card-custom').outerHTML;
                                document.body.innerHTML = printContents;
                                window.print();
                                document.body.innerHTML = originalContents;
                            }
                        </script>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- Akhir #main -->
    @endsection
</x-layout>

