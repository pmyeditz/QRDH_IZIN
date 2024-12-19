<x-layout>
    @section('main')
    <x-header></x-header>
    <x-sidebar></x-sidebar>
    <main id="main" class="main">
        <div class="pagetitle">
            <h4>Surat Izin</h4>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Surat Izin</a></li>
                    <li class="breadcrumb-item active">Surat Izin</li>
                </ol>
            </nav>
        </div><!-- Akhir Judul Halaman -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Surat Izin</h5>
                            <button class="btn btn-primary mb-3" onclick="printDiv('kop-surat')">Cetak PDF</button>
                            <div id="kop-surat" class="kop-surat a4-paper">
                                <div class="kop-header text-center">
                                    <h4>Yayasan Pondok Pesantren DARUL HIKAM</h4>
                                    <h6>RIMBO ULU JALAN TERATAI, -, Kec. Rimbo Ulu, Kab. Tebo Prov. Jambi</h6>
                                    <hr>
                                </div>
                                <div class="kop-content">
                                    <p>Kepada Yth</p>
                                    <p>Bapak/Ibu guru kelas {{ $izin->santri->kelas->nama }}</p>
                                    <p>Pondok Pesantren Darul Hikam</p>
                                    <p>Dengan hormat, saya yang bernama di bawah ini:</p>
                                    <p><strong>Nama:</strong> {{ $izin->santri->nama }}</p>
                                    <p><strong>Nis:</strong> {{ $izin->santri->nis }}</p>
                                    <p><strong>Status Izin:</strong> {{ $izin->status }}</p>
                                    <p><strong>Tanggal:</strong> {{ $izin->mulai_tgl }} s/d {{ $izin->sampai_tgl }}</p>
                                    <p class="mt-2">Dengan surat ini saya meminta izin untuk tidak masuk sekolah dikarenakan {{ $izin->alasan }}. Oleh karena itu saya meminta kepada Bapak/Ibu guru untuk memberikan izin.</p>
                                    <p class="mt-2">Demikian surat izin ini saya ajukan. Atas perhatian dan izin yang sudah Bapak/Ibu guru berikan saya mengucapkan terima kasih.</p>
                                    <div class="text-end">
                                        <p class="mt-3">Hormat saya,</p>
                                        <p>{{ $izin->santri->nama }}</p>
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

<style>
    /* Ukuran Kertas A4 */
    .a4-paper {
        width: 100%;
        max-width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 0 auto;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    /* Umum */
    .kop-surat {
        margin: 0 auto;
        padding: 20mm;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #fff;
    }
    .kop-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .kop-header h4, .kop-header h6 {
        margin: 5px 0;
    }
    .kop-content {
        margin-top: 30px;
        line-height: 1.6;
    }
    .kop-content p {
        margin-bottom: 10px;
    }
    .kop-content .mt-2 {
        margin-top: 1rem !important;
    }
    .kop-content .mt-3 {
        margin-top: 1.5rem !important;
    }
    .text-end {
        text-align: right;
        margin-top: 30px;
    }

    /* Responsif */
    @media (max-width: 768px) {
        .a4-paper {
            padding: 10mm;
        }

        .kop-surat {
            padding: 10mm;
        }

        .kop-header h4 {
            font-size: 1.5rem;
        }

        .kop-header h6 {
            font-size: 1rem;
        }

        .kop-content {
            font-size: 0.875rem;
        }

        .kop-content p {
            margin-bottom: 8px;
        }

        .text-end {
            margin-top: 20px;
        }
    }

    @media (max-width: 480px) {
        .a4-paper {
            padding: 5mm;
        }

        .kop-surat {
            padding: 5mm;
        }

        .kop-header h4 {
            font-size: 1.25rem;
        }

        .kop-header h6 {
            font-size: 0.875rem;
        }

        .kop-content {
            font-size: 0.75rem;
        }

        .kop-content p {
            margin-bottom: 6px;
        }

        .text-end {
            margin-top: 15px;
        }
    }

    /* Pengaturan Cetak */
    @media print {
        .a4-paper {
            margin: 0;
            border: none;
            box-shadow: none;
            -webkit-print-color-adjust: exact;
        }
        .kop-surat {
            border: none;
        }

        /* Sembunyikan tombol cetak saat mencetak */
        .btn {
            display: none;
        }

        /* Sembunyikan header dan footer default dari browser */
        @page {
            margin: 0;
        }
        body {
            margin: 1cm;
        }
    }
</style>
<script>
    function printDiv(divId) {
        var divToPrint = document.getElementById(divId);
        var newWin = window.open('', '_blank');

        newWin.document.open();
        newWin.document.write('<html><head><title></title><style>' +
            '@media print { ' +
            '.a4-paper { width: 210mm; min-height: 297mm; padding: 20mm; margin: 0 auto; border: 1px solid #ddd; border-radius: 5px; background: white; box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); } ' +
            '.kop-surat { margin: 0 auto; padding: 20mm; border: 1px solid #ddd; border-radius: 10px; background-color: #fff; } ' +
            '.kop-header { text-align: center; margin-bottom: 20px; } ' +
            '.kop-header h4, .kop-header h6 { margin: 5px 0; } ' +
            '.kop-content { margin-top: 30px; line-height: 1.6; } ' +
            '.kop-content p { margin-bottom: 10px; } ' +
            '.kop-content .mt-2 { margin-top: 1rem !important; } ' +
            '.kop-content .mt-3 { margin-top: 1.5rem !important; } ' +
            '.text-end { text-align: right; margin-top: 30px; } ' +
            '.btn { display: none; } ' +
            '@page { margin: 0; } ' +
            'body { margin: 1cm; } ' +
            '}</style></head><body onload="window.print()">' +
            divToPrint.innerHTML +
            '</body></html>');
        newWin.document.close();

        setTimeout(function() {
            newWin.close();
        }, 10);
    }
</script>
