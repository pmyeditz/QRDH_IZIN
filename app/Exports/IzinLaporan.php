<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Izin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;

class IzinLaporan implements FromCollection, WithHeadings, WithStyles, WithEvents, WithTitle, WithCustomStartCell
{
    protected $filterDate;

    public function __construct($filterDate)
    {
        $this->filterDate = $filterDate;
    }

    public function collection()
    {
        $query = Izin::with(['santri.kelas']);

        if ($this->filterDate) {
            $year = Carbon::createFromFormat('Y-m', $this->filterDate)->year;
            $month = Carbon::createFromFormat('Y-m', $this->filterDate)->month;
            $query->whereYear('mulai_tgl', $year)->whereMonth('mulai_tgl', $month);
        }

        return $query->get()->map(function ($izin, $index) {
            return [
                'No' => $index + 1,
                'Nama' => $izin->santri->nama,
                'Kelas' => $izin->santri->kelas->nama,
                'Alasan' => $izin->alasan,
                'Status' => $izin->status,
                'Mulai' => $izin->mulai_tgl,
                'Sampai' => $izin->sampai_tgl,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Kelas',
            'Alasan',
            'Status',
            'Mulai',
            'Sampai',
        ];
    }

    public function title(): string
    {
        return 'Laporan Izin';
    }

    public function startCell(): string
    {
        return 'A6';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            6 => ['font' => ['bold' => true]],
            'A4:G4' => [
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],
            'A6:G6' => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => 'center'],
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'color' => ['argb' => '000000'],
                    ],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => 'FFCCFFCC'],
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Menggabungkan sel untuk kop
                $event->sheet->getDelegate()->mergeCells('A2:G2');
                $event->sheet->getDelegate()->mergeCells('A3:G3');
                $event->sheet->getDelegate()->mergeCells('A4:G4');

                // Mengatur nilai untuk kop
                $event->sheet->getDelegate()->setCellValue('A2', 'YAYASAN PONDOK PESANTREN DARUL HIKAM');
                $event->sheet->getDelegate()->setCellValue('A3', 'RIMBO ULU JALAN TERATAI, -, Kec. Rimbo Ulu, Kab. Tebo Prov. Jambi');

                if ($this->filterDate) {
                    $date = Carbon::createFromFormat('Y-m', $this->filterDate);
                    $event->sheet->getDelegate()->setCellValue('A4', 'Laporan Bulan: ' . $date->format('F Y'));
                } else {
                    $event->sheet->getDelegate()->setCellValue('A4', 'Laporan Izin Semua Santri');
                }

                // Memformat kop
                $event->sheet->getDelegate()->getStyle('A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $event->sheet->getDelegate()->getStyle('A3')->applyFromArray([
                    'font' => [
                        'bold' => false,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $event->sheet->getDelegate()->getStyle('A4')->applyFromArray([
                    'font' => [
                        'bold' => false,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Mengatur ukuran kolom otomatis sesuai isi
                $event->sheet->getDelegate()->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('D')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('E')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('F')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('G')->setAutoSize(true);

                // Gaya tambahan
                $event->sheet->getDelegate()->getStyle('A6:G6')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Menerapkan border pada baris data
                $event->sheet->getDelegate()->getStyle('A7:G' . ($event->sheet->getHighestRow()))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Mengatur ukuran kertas menjadi A4
                $event->sheet->getDelegate()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

                // Menambahkan ttd, nama pengguna, dan peran mereka
                $highestRow = $event->sheet->getHighestRow();
                $user = Auth::user(); // Mendapatkan user yang sedang login
                $userName = $user ? $user->nama : 'Nama Pengguna Tidak Ditemukan'; // Mendapatkan nama pengguna
                $roleName = $user ? $user->role->nama : 'Peran Tidak Ditemukan'; // Mendapatkan peran pengguna

                // Menghilangkan tulisan "Tanda Tangan" dan menjadikannya rata tengah
                $event->sheet->getDelegate()->mergeCells('F' . ($highestRow + 2) . ':G' . ($highestRow + 2));
                $event->sheet->getDelegate()->setCellValue('F' . ($highestRow + 2), '');
                $event->sheet->getDelegate()->getStyle('F' . ($highestRow + 2))->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Menambahkan nama pengguna di kolom F dan rata tengah
                $event->sheet->getDelegate()->mergeCells('F' . ($highestRow + 3) . ':G' . ($highestRow + 3));
                $event->sheet->getDelegate()->setCellValue('F' . ($highestRow + 3), 'rimbo ulu...bln...thn...');
                $event->sheet->getDelegate()->getStyle('F' . ($highestRow + 3))->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $event->sheet->getDelegate()->mergeCells('F' . ($highestRow + 4) . ':G' . ($highestRow + 4));
                $event->sheet->getDelegate()->setCellValue('F' . ($highestRow + 4), $userName);
                $event->sheet->getDelegate()->getStyle('F' . ($highestRow + 4))->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Menambahkan peran pengguna di kolom F dan rata tengah
                $event->sheet->getDelegate()->mergeCells('F' . ($highestRow + 5) . ':G' . ($highestRow + 5));
                $event->sheet->getDelegate()->setCellValue('F' . ($highestRow + 5), '');
                $event->sheet->getDelegate()->getStyle('F' . ($highestRow + 5))->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $event->sheet->getDelegate()->mergeCells('F' . ($highestRow + 6) . ':G' . ($highestRow + 6));
                $event->sheet->getDelegate()->setCellValue('F' . ($highestRow + 6), $roleName);
                $event->sheet->getDelegate()->getStyle('F' . ($highestRow + 6))->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $event->sheet->getDelegate()->getStyle('F' . ($highestRow + 3) . ':G' . ($highestRow + 6))->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
            },
        ];
    }
}
