<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AparExport implements FromArray, WithHeadings, WithEvents
{
    protected $data;
    // protected $;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
{
    $bulanHeader = ['Uraian', 'Sub Uraian'];
    $tanggalHeader = ['', ''];

    foreach ($this->data['bulan'] as $b) {
        // Tambahkan bulan ke header di baris pertama
        $jumlahTanggal = count($b['tanggal']);
        $bulanHeader = array_merge($bulanHeader, array_fill(0, $jumlahTanggal, $b['bulan']));

        // Tambahkan tanggal-tanggal ke header di baris kedua
        $tanggalHeader = array_merge($tanggalHeader, $b['tanggal']);
    }

    return [$bulanHeader, $tanggalHeader];
}

public function array(): array
{
    $exportData = [];

    foreach ($this->data['data'] as $row) {
        foreach ($row['sub_uraian'] as $key => $sub) {
            $hasilRow = [];

            // Tambahkan uraian
            $hasilRow[] = $row['uraian'];

            // Tambahkan sub uraian
            $hasilRow[] = $sub;

            // Tambahkan hasil berdasarkan tanggal
            foreach ($row['hasil'] as $item) {
                if (isset($item[$key])) {
                    if ($item[$key] == 1) {
                        $hasilRow[] = 'Iya';
                    } elseif ($item[$key] == 0) {
                        $hasilRow[] = 'Tidak';
                    } else {
                        $hasilRow[] = $item[$key];
                    }
                } else {
                    $hasilRow[] = '';
                }
            }

            $exportData[] = $hasilRow;
        }
    }

    return $exportData;
}




public function registerEvents(): array
{
    return [
        AfterSheet::class => function ($event) {
            $sheet = $event->sheet;

            // Merge untuk kolom bulan
            $startColumn = 3; // Kolom pertama setelah Uraian dan Sub Uraian
            foreach ($this->data['bulan'] as $b) {
                $columnCount = count($b['tanggal']);
                $endColumn = $startColumn + $columnCount - 1;

                // Merge nama bulan
                $sheet->mergeCellsByColumnAndRow($startColumn, 1, $endColumn, 1);

                $startColumn = $endColumn + 1;
            }

            // Merge heading Uraian dan Sub Uraian
            $sheet->mergeCells('A1:A2'); // Merge Uraian (vertikal)
            $sheet->mergeCells('B1:B2'); // Merge Sub Uraian (vertikal)

            // Styling heading
            $highestColumn = $sheet->getHighestColumn();
            $sheet->getStyle("A1:{$highestColumn}2")->applyFromArray([
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
                'font' => ['bold' => true],
            ]);

            // Merge Uraian dan Sub Uraian untuk setiap data
            $currentRow = 3; // Data dimulai dari baris ketiga
            foreach ($this->data['data'] as $row) {
                $subUraianCount = count($row['sub_uraian']);
                $mergeRangeUraian = "A{$currentRow}:A" . ($currentRow + $subUraianCount - 1);
                $sheet->mergeCells($mergeRangeUraian); // Merge untuk Uraian

                $sheet->getStyle($mergeRangeUraian)->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                    ],
                    'font' => ['bold' => true],
                ]);

                $currentRow += $subUraianCount;
            }

            // Wrap text dan border
            $highestRow = $sheet->getHighestRow();
            $sheet->getStyle("A1:{$highestColumn}{$highestRow}")->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
                'alignment' => ['wrapText' => false],
            ]);
        },
    ];
}



}
