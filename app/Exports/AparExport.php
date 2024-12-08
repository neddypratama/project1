<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\InputApar;
use App\Models\Apar;

class AparExport implements FromCollection, WithHeadings
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        // Mengembalikan data dari query untuk diolah menjadi format Excel
        return collect($this->data['data']);
    }

    public function headings(): array
    {
        return [
            'Uraian',
            'Sub Uraian',
            'Hasil',
        ];
    }
}
