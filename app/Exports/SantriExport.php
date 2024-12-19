<?php

namespace App\Exports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SantriExport implements FromCollection, WithHeadings, WithMapping
{
    private $counter = 0;

    public function collection()
    {
        return Santri::with('kelas')->get();
    }

    public function map($santri): array
    {
        $this->counter++;

        return [
            $this->counter,            // Nomor urut
            $santri->nama,             // Nama Santri
            $santri->nis,              // NIS
            $santri->alamat,           // Alamat
            $santri->no_hp,            // No HP
            $santri->jenis_kelamin,    // Jenis Kelamin
            $santri->kelas->nama // Nama Kelas
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'NIS',
            'Alamat',
            'No HP',
            'Jenis Kelamin',
            'Kelas',
        ];
    }
}
