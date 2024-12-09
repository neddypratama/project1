<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AparExport implements FromArray, WithHeadings, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data; 
    }

    public function array(): array
    {
        $exportData = [];
        
        // Membuat data untuk export
        foreach ($this->data['data'] as $row) {
            foreach ($row['sub_uraian'] as $key => $sub) {
                $hasilRow = [];
                
                $hasilRow[] = $row['uraian']; 
                $hasilRow[] = $sub;

                foreach ($row['hasil'] as $item) {
                    if (isset($item[$key])) {
                        if ($item[$key] == 1) {
                            $hasilRow[] = '✅';
                        } elseif ($item[$key] == 0) {
                            $hasilRow[] = '❌';
                        } else {
                            $hasilRow[] = '';
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

    public function headings(): array
    {
        $headings = ['Uraian', 'Sub Uraian'];

        foreach ($this->data['bulan'] as $b) {
            $headings[] = $b['bulan'];
        }

        return $headings;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function ($event) {
                $sheet = $event->sheet;

                $currentRow = 3; 
                foreach ($this->data['data'] as $row) {
                    $subUraianCount = count($row['sub_uraian']); 
                    $mergeRange = "A{$currentRow}:A" . ($currentRow + $subUraianCount - 1);

                    // Perbaikan agar semua sub_uraian benar tergabung dengan grup induknya
                    $sheet->mergeCells($mergeRange);
                    $sheet->getStyle($mergeRange)->applyFromArray([
                        'font' => ['bold' => true],
                        'alignment' => [
                            'horizontal' => 'center',
                            'vertical' => 'center',
                        ],
                    ]);

                    $currentRow += $subUraianCount; 
                }

                $columnsCount = count($this->data['bulan']) + 2;
                $sheet->getStyle('A1:' . chr(65 + $columnsCount - 1) . $sheet->getHighestRow())
                    ->getAlignment()
                    ->setWrapText(true);
            }
        ];
    }
}
