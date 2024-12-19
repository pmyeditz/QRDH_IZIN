<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Izin;
use App\Models\Kelas;
use App\Models\Santri;
use App\Exports\IzinLaporan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LogController extends Controller
{
    public function index(Request $request)
    {
        // Set timezone
        date_default_timezone_set('Asia/Jakarta');

        // Hari ini
        $today = Carbon::now('Asia/Jakarta')->toDateString();

        // Data santri
        $santris = Santri::with('kelas')->get();

        // Data izin yang berlaku hari ini
        $izinsHariIni = Izin::with(['santri.kelas'])
            ->whereDate('mulai_tgl', '<=', $today)
            ->whereDate('sampai_tgl', '>=', $today)
            ->get();

        // Semua data izin, dengan filter
        $allIzinsQuery = Izin::with(['santri.kelas']);

        // Filter berdasarkan bulan
        if ($request->has('filterDate')) {
            $filterDate = $request->input('filterDate');
            $year = Carbon::createFromFormat('Y-m', $filterDate)->year;
            $month = Carbon::createFromFormat('Y-m', $filterDate)->month;
            $allIzinsQuery->whereYear('mulai_tgl', $year)->whereMonth('mulai_tgl', $month);
        }

        $allIzins = $allIzinsQuery->get();

        // Menghitung jumlah izin per bulan
        $monthlyIzinCounts = Izin::select(
            DB::raw('YEAR(mulai_tgl) as year'),
            DB::raw('MONTH(mulai_tgl) as month'),
            DB::raw('COUNT(*) as count')
        )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return view('santri.logizin', compact('izinsHariIni', 'allIzins', 'santris', 'monthlyIzinCounts'));
    }
    public function exportIzin(Request $request)
    {
        // Menggunakan filter tanggal dari request jika ada
        $filterDate = $request->input('filterDate');

        // Format nama file berdasarkan filter tanggal jika ada
        $filename = 'laporan_izin_santri';
        if ($filterDate) {
            $date = Carbon::createFromFormat('Y-m', $filterDate);
            $filename .= '_' . $date->format('F_Y');
        }

        // Tambahkan tanggal cetak
        $filename .= '_' . Carbon::now()->format('Ymd_His');

        return Excel::download(new IzinLaporan($filterDate), $filename . '.xlsx');
    }

    public function print(Request $request)
    {
        // Set timezone
        date_default_timezone_set('Asia/Jakarta');

        // Semua data izin, dengan filter
        $allIzinsQuery = Izin::with(['santri.kelas']);

        // Filter berdasarkan bulan
        if ($request->has('filterDate')) {
            $filterDate = $request->input('filterDate');
            $year = Carbon::createFromFormat('Y-m', $filterDate)->year;
            $month = Carbon::createFromFormat('Y-m', $filterDate)->month;
            $allIzinsQuery->whereYear('mulai_tgl', $year)->whereMonth('mulai_tgl', $month);
        }

        $allIzins = $allIzinsQuery->get();

        // Menghitung jumlah izin per bulan
        $monthlyIzinCounts = Izin::select(
            DB::raw('YEAR(mulai_tgl) as year'),
            DB::raw('MONTH(mulai_tgl) as month'),
            DB::raw('COUNT(*) as count')
        )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Generate the print view
        return view('santri.print', compact('allIzins', 'monthlyIzinCounts'));
    }
}
