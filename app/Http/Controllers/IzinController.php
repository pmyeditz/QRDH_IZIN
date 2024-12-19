<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Izin;
use App\Models\Santri;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;

class IzinController extends Controller
{
    public function index()
    {
        // data santri
        $santris = Santri::all();
        $izins = Izin::with('santri')->get();

        // Mengembalikan view dengan data santri dan izin
        return view('santri.izin', compact('izins', 'santris'));
    }

    // tambah izin

    public function tambah(Request $request)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'alasan' => 'required|string|max:255',
            'mulai_tgl' => 'required|date',
            'sampai_tgl' => 'required|date|after_or_equal:mulai_tgl',
            'status' => 'required|string|in:pulang,keperluan,darurat',
            'santri_id' => 'required|exists:santris,idSantri',
        ], [
            'alasan.required' => 'Alasan wajib diisi.',
            'alasan.string' => 'Alasan harus berupa teks.',
            'alasan.max' => 'Alasan tidak boleh lebih dari 255 karakter.',
            'mulai_tgl.required' => 'Tanggal mulai wajib diisi.',
            'mulai_tgl.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'sampai_tgl.required' => 'Tanggal sampai wajib diisi.',
            'sampai_tgl.date' => 'Tanggal sampai harus berupa tanggal yang valid.',
            'sampai_tgl.after_or_equal' => 'Tanggal sampai harus sama atau setelah tanggal mulai.',
            'status.required' => 'Status wajib diisi.',
            'status.in' => 'Status harus berupa "pulang", "keperluan", atau "darurat".',
            'santri_id.required' => 'ID santri wajib diisi.',
            'santri_id.exists' => 'ID santri tidak ditemukan dalam database.',
        ]);

        // Cek apakah ada izin yang tumpang tindih
        $izinTumpangTindih = Izin::where('santri_id', $validatedData['santri_id'])
            ->where(function ($query) use ($validatedData) {
                $query->whereBetween('mulai_tgl', [$validatedData['mulai_tgl'], $validatedData['sampai_tgl']])
                    ->orWhereBetween('sampai_tgl', [$validatedData['mulai_tgl'], $validatedData['sampai_tgl']])
                    ->orWhere(function ($query) use ($validatedData) {
                        $query->where('mulai_tgl', '<=', $validatedData['mulai_tgl'])
                            ->where('sampai_tgl', '>=', $validatedData['sampai_tgl']);
                    });
            })->exists();

        if ($izinTumpangTindih) {
            return redirect()->back()->withErrors(['error' => 'Santri sudah izin dalam rentang tanggal tersebut.']);
        }

        // Cek apakah santri sedang dalam keadaan izin "pulang", "keperluan", atau "darurat"
        $izinAktif = Izin::where('santri_id', $validatedData['santri_id'])
            ->where('mulai_tgl', '<=', Carbon::now())
            ->where('sampai_tgl', '>=', Carbon::now())
            ->whereIn('status', ['pulang', 'keperluan', 'darurat'])
            ->exists();

        if ($izinAktif) {
            return redirect()->back()->withErrors(['error' => 'Santri sedang dalam keadaan izin. Tidak dapat mengajukan izin baru.']);
        }

        try {
            $slug = Str::random(18); // Generate slug acak dengan 18 karakter
            Izin::create([
                'slug' => $slug,
                'alasan' => $validatedData['alasan'],
                'mulai_tgl' => $validatedData['mulai_tgl'],
                'sampai_tgl' => $validatedData['sampai_tgl'],
                'status' => $validatedData['status'],
                'santri_id' => $validatedData['santri_id'],
            ]);

            return redirect()->route('santri.izin')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage()]);
        }
    }

    public function print(Request $request)
    {
        $filterDate = $request->query('filterDate');
        if ($filterDate) {
            $year = Carbon::parse($filterDate)->year;
            $month = Carbon::parse($filterDate)->month;
            $izins = Izin::with(['santri.kelas'])
                ->whereYear('mulai_tgl', $year)
                ->whereMonth('mulai_tgl', $month)
                ->get();
        } else {
            $izins = Izin::with(['santri.kelas'])->get();
        }

        $pdf = Pdf::loadView('santri.cetakIzin', compact('izins'));
        return $pdf->download('izin.pdf');
    }

    public function printToday()
    {
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $izins = Izin::with(['santri.kelas'])
            ->whereDate('mulai_tgl', '<=', $today)
            ->whereDate('sampai_tgl', '>=', $today)
            ->get();

        $pdf = Pdf::loadView('santri.cetakIzinHariIni', compact('izins'));
        return $pdf->download('izin_hari_ini.pdf');
    }




    // hapus izin
    public function hapus($id)
    {
        try {
            $izin = Izin::findOrFail($id);
            $izin->delete();

            return redirect()->route('santri.izin')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }

    public function scanner()
    {
        return view('santri.scenner');
    }


    // kop surat
    public function showKopSurat($slug)
    {
        $izin = Izin::where('slug', $slug)->firstOrFail();
        return view('santri.kopsurat', compact('izin'));
    }
}
