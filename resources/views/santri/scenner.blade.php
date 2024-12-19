<x-layout>
    @section('main')
    <x-header></x-header>
    <x-sidebar></x-sidebar>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Scan Qr</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/scanner">Scan Qr</a></li>
                    <li class="breadcrumb-item active">Scan Qr</li>
                </ol>
            </nav>
        </div><!-- Akhir Judul Halaman -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="row">
                                    <h5 class="card-title">Scan QR</h5>
                                </div>
                                <div class="row">
                                    <a href="/scanner" class="card-title">refresh<i class='bx bx-refresh'></i></a>
                                </div>
                            </div>
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="wrapper container">
                                <div class="row mt-4">
                                    <div class="position-relative" id="video-wrapper">
                                        <canvas id="canvas" class="w-100 h-100 position-absolute"></canvas>
                                        <video id="video" class="w-100 h-100" width="640" height="480" autoplay></video>
                                    </div>
                                    <div class="col-md-6" id="scanned">
                                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-santri">
                                            <i class="ri-add-circle-line"></i>Add
                                        </button> --}}
                                        <div class="modal fade" id="tambah-santri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Santri</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/izinTambah" method="POST" id="santri-form">
                                                            @csrf
                                                            <div class="row mb-3">
                                                                {{-- <label for="santri_id" class="col-sm-2 col-form-label">ID Santri</label> --}}
                                                                <div class="col-sm-10">
                                                                    <input type="hidden" class="form-control" id="santri_id" name="santri_id">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="alasan" class="col-sm-2 col-form-label">Alasan</label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control" name="alasan" id="alasan" rows="4"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="mulai_tgl" class="col-sm-2 col-form-label">Mulai</label>
                                                                <div class="col-sm-10">
                                                                    <input type="date" class="form-control" name="mulai_tgl" id="mulai_tgl">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="sampai_tgl" class="col-sm-2 col-form-label">Sampai</label>
                                                                <div class="col-sm-10">
                                                                    <input type="date" class="form-control" name="sampai_tgl" id="sampai_tgl">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            let codes = [];
            const seen = new Set();
            const barcodeDetector = new BarcodeDetector({ formats: ['qr_code'] });

            customElements.define('scaned-item', class extends HTMLElement {
                constructor() {
                    super();
                    const template = document.querySelector('#scaned-item').content;
                    this.attachShadow({mode: 'open'}).appendChild(template.cloneNode(true));
                };
            });

            const codesProxy = new Proxy(codes, {
                set(target, prop, value, receiver) {
                    if (typeof value === 'number') throw value;

                    target.push(value);

                    target = target.filter(c => {
                        if (c.rawValue !== window.barcodeVal) return c;
                        const d = seen.has(c.rawValue);
                        seen.add(c.rawValue);
                        return !d;
                    });

                    // Tampilkan modal jika belum tampil
                    const modal = document.getElementById('tambah-santri');
                    if (modal && !modal.classList.contains('show')) {
                        $('#tambah-santri').modal('show');
                    }

                    return true;
                }
            });

            const video = document.getElementById('video');

            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                const constraints = { video: true, audio: false };

                navigator.mediaDevices.getUserMedia(constraints).then(stream => video.srcObject = stream);
            }

            const drawCodePath = ({cornerPoints}) => {
                const canvas = document.querySelector('#canvas');
                const ctx = canvas.getContext('2d');
                const strokeGradient = ctx.createLinearGradient(0, 0, canvas.scrollWidth, canvas.scrollHeight);

                if (!cornerPoints) return ctx.clearRect(0, 0, canvas.width, canvas.height);

                ctx.clearRect(0, 0, canvas.width, canvas.height);
                strokeGradient.addColorStop('0', '#c471ed');
                strokeGradient.addColorStop('1', '#f7797d');
                ctx.strokeStyle = strokeGradient;
                ctx.lineWidth = 4;
                ctx.beginPath();

                for (const [i, {x, y}] of cornerPoints.entries()) {
                    if (i === 0) {
                        ctx.moveTo(x - ctx.lineWidth / 2, y);
                        continue;
                    }
                    ctx.lineTo(x, y);
                    if (i === cornerPoints.length - 1) ctx.lineTo(cornerPoints[0].x, cornerPoints[0].y);
                }

                ctx.stroke();
            }

            const detectCode = () => {
                barcodeDetector.detect(video).then(codes => {
                    if (codes.length === 0) return drawCodePath({});

                    for (const barcode of codes) {
                        drawCodePath(barcode);

                        if (seen.has(barcode.rawValue)) return;

                        // Memparse JSON dan mendapatkan nilai id
                        let parsedData;
                        try {
                            parsedData = JSON.parse(barcode.rawValue);
                        } catch (e) {
                            console.error("Error parsing JSON from QR code:", e);
                            continue;
                        }

                        if (parsedData && parsedData.idSantri) {
                            // Set nilai input ID Santri
                            document.getElementById('santri_id').value = parsedData.idSantri;

                            // Set nilai input Alasan (misalnya, nama santri yang ditemukan)
                            document.getElementById('alasan').value = `Izin untuk santri dengan ID ${parsedData.idSantri}`;

                            window.barcodeVal = barcode.rawValue;
                            codesProxy.push(barcode);
                        }
                    }
                }).catch(err => {
                    console.error(err);
                })
            }

            setInterval(detectCode, 100);
        </script>
    </main>
    @endsection
</x-layout>
