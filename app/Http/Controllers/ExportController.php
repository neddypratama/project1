<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Models\InputApar;
use App\Models\SubUraian;
use App\Models\Uraian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AparExport;
use Barryvdh\DomPDF\Facade\Pdf; 

class ExportController extends Controller
{
    public function prepareData(string $tahun)
    {
        $apar = Apar::whereYear('tanggal', $tahun)->get();
        // dd($apar);
        $uraian = uraian::all();
        $sub_uraian = SubUraian::all();
        $input = InputApar::all();
        
        $tanggal =[];
        foreach ($apar as $a) {
            $tanggal[] = 
                 $a->tanggal;
        }
        $result = [];

        // Loop melalui array dan olah data
        foreach ($tanggal as $date) {
            // Konversi tanggal menjadi objek Carbon
            $carbonDate = Carbon::parse($date);

            // Ambil nama bulan dalam bahasa Inggris atau Indonesia
            $bulan = $carbonDate->translatedFormat('F');

            // Cari indeks bulan yang sama di hasil
            $foundIndex = array_search(strtolower($bulan), array_column($result, 'bulan'));

            // Jika bulan sudah ada di hasil, tambahkan jumlahnya
            if ($foundIndex !== false) {
                $result[$foundIndex]['jumlah']++;
            } else {
                // Jika bulan belum ada di hasil, tambahkan data baru
                $result[] = [
                    'bulan' => strtolower($bulan),
                    'jumlah' => 1,
                ];
            }
        }
        $bulan = $result;
        return [
            'bulan' => $bulan,
            'tanggal' => $tanggal,
            'apar' => $apar,
            'uraian' => $uraian,
            'input' => $input,
            'sub_uraian' => $sub_uraian,
        ];
    }

    // 📄 Download PDF Method
    // 📄 Download PDF Method
    public function downloadPDF(Request $request, string $tahun)
    {
        $data = $this->prepareData($tahun);

        if (!$data) {
            return response()->json(['error' => 'Data tidak ditemukan']);
        }

        $pdf = pdf::loadView('admin.apar.cetak', $data, compact('tahun'));

        return $pdf->download('laporan-apar-' . $tahun . '.pdf');
    }

    // 📊 Download Excel Method
    public function downloadExcel(Request $request, string $tahun)
    {
        $data = $this->prepareData($tahun);
        return Excel::download(new AparExport($data), 'laporan-apar.xlsx');
    }

    public function print(Request $request, string $tahun)
    {
        $data = $this->prepareData($tahun);

        if (!$data) {
            return response()->json(['error' => 'Data tidak ditemukan']);
        }

        return view('admin.apar.cetak', $data, compact('tahun'));
    }
}
