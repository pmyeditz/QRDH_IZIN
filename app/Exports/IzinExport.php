<?php

namespace App\Exports;

use App\Models\Izin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IzinExport implements FromCollection, WithHeadings, WithMapping
{
    private $counter = 0;

    public function collection()
    {
        return Izin::with('santri')->get();
    }

    public function map($izin): array
    {
        $this->counter++;

        return [
            $this->counter,            // Nomor urut
            $izin->santri->nama,       // Nama Santri
            $izin->alasan,             // Alasan
            $izin->status,             // Status
            $izin->mulai_tgl,          // Mulai Tanggal
            $izin->sampai_tgl,         // Sampai Tanggal
        ];
    }

    public function headings(): array
    {
        return [
            'No',    // Ubah menjadi nomor urut
            'Nama',
            'Alasan',
            'Status',
            'Mulai',
            'Sampai',
        ];
    }
}
