<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Izin;
use App\Models\User;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Set the timezone to WIB (Waktu Indonesia Bagian Barat)
        date_default_timezone_set('Asia/Jakarta');

        // Jumlah guru
        $jumlahGuru = User::count();
        // Hitung jumlah santri
        $jumlahSantri = Santri::count();
        // Hitung jumlah users dengan ID 2
        $jumlahUserDenganId2 = User::where('id', 2)->count();

        // Ambil tanggal hari ini dalam format WIB
        $today = Carbon::now('Asia/Jakarta')->toDateString();

        // Ambil data izin yang mulai_tgl sampai sampai_tgl mencakup hari ini
        $izinsHariIni = Izin::with('santri')
            ->whereDate('mulai_tgl', '<=', $today)
            ->whereDate('sampai_tgl', '>=', $today)
            ->get();

        // Hitung jumlah santri yang izin hari ini
        $jumlahSantriIzinHariIni = $izinsHariIni->count();

        // Hitung jumlah santri yang izin dalam bulan ini
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->endOfMonth();

        $jumlahSantriIzinBulanIni = Izin::whereBetween('mulai_tgl', [$firstDayOfMonth, $lastDayOfMonth])
            ->orWhereBetween('sampai_tgl', [$firstDayOfMonth, $lastDayOfMonth])
            ->count();

        // Mendapatkan tahun saat ini
        $currentYear = Carbon::now('Asia/Jakarta')->year;

        // Menginisialisasi array untuk menyimpan jumlah izin tiap bulan
        $jumlahSantriIzinPerBulan = [];

        // Looping dari bulan 1 hingga bulan 12
        for ($i = 1; $i <= 12; $i++) {
            // Mengambil tanggal awal dan akhir bulan
            $firstDayOfMonth = Carbon::createFromDate($currentYear, $i, 1)->startOfMonth()->toDateString();
            $lastDayOfMonth = Carbon::createFromDate($currentYear, $i, 1)->endOfMonth()->toDateString();

            // Menghitung jumlah izin untuk bulan ini
            $jumlahIzinBulanIni = Izin::whereBetween('mulai_tgl', [$firstDayOfMonth, $lastDayOfMonth])
                ->orWhereBetween('sampai_tgl', [$firstDayOfMonth, $lastDayOfMonth])
                ->count();

            // Menyimpan jumlah izin ke dalam array
            $jumlahSantriIzinPerBulan[] = $jumlahIzinBulanIni;
        }

        // Kirim data ke view
        return view('admin.dashboard', compact('jumlahGuru', 'jumlahSantri', 'jumlahUserDenganId2', 'izinsHariIni', 'jumlahSantriIzinHariIni', 'jumlahSantriIzinBulanIni', 'jumlahSantriIzinPerBulan'));
    }
}
