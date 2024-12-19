<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        $santris = Santri::with('kelas')->get();
        $kelas = Kelas::all();

        return view('santri.card', [
            'kelas' => $kelas,
            'santris' => $santris,
        ]);
    }

    public function generateQrCode($slug)
    {
        $santri = Santri::where('slug', $slug)->firstOrFail();

        $santriData = [
            'idSantri' => $santri->idSantri // Or any other data you want to include in the QR code
        ];
        $santriJson = json_encode($santriData);

        $qrcode = QrCode::size(80)->generate($santriJson);
        return view('santri.kartuSantri', compact('santri', 'qrcode'));
    }

    // cetak kartu
}
