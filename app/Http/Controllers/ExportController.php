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
        
        $tanggal = $apar->tanggal;
        $bulan = Carbon::parse($tanggal)->translatedFormat('F');

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
        
        $data = [];
        foreach ($uraian as $item) {
            $subid = SubUraian::where('uraian_id', $item->uraian_id)->first()->sub_uraian_id;
            

            $data[] = [
                'uraian' => $item->uraian_nama,
                'sub_id' => $subid,
                'sub_uraian' => explode('/', SubUraian::where('uraian_id', $item->uraian_id)->first()->sub_uraian_nama),
                // 'hasil' => $slug,
            ];
        }
        // dd($data , $slug);
        
        // Edit data tertentu
        foreach ($sub_uraian as $sub) {
            foreach ($data as &$row) {
                if ($row['sub_id'] == $sub->sub_uraian_id) {
                    $row['hasil'] = explode('/', InputApar::where('sub_uraian_id', $sub->sub_uraian_id)->where('apar_id', $id)->first()->hasil_apar);
                }
            }
        }
        // dd($data);

        // Kirim data ke view
        // return view('admin.apar.acc', compact('apar', 'uraian', 'sub_uraian', 'bulan' , 'data' ,'tanggal'));
        return [
            'bulan' => $bulan,
            'tanggal' => $tanggal,
            'apar' => $apar,
            'uraian' => $uraian,
            'input' => $input,
            'sub_uraian' => $sub_uraian,
        ];
    }
    // public function prepareData(string $tahun)
    // {
    //     $apar = Apar::whereYear('tanggal', $tahun)->get();
    //     // dd($apar);
    //     $uraian = uraian::all();
    //     $sub_uraian = SubUraian::all();
    //     $input = InputApar::all();
        
    //     $tanggal =[];
    //     foreach ($apar as $a) {
    //         $tanggal[] = 
    //              $a->tanggal;
    //     }
    //     $result = [];

    //     // Loop melalui array dan olah data
    //     foreach ($tanggal as $date) {
    //         // Konversi tanggal menjadi objek Carbon
    //         $carbonDate = Carbon::parse($date);

    //         // Ambil nama bulan dalam bahasa Inggris atau Indonesia
    //         $bulan = $carbonDate->translatedFormat('F');

    //         // Cari indeks bulan yang sama di hasil
    //         $foundIndex = array_search(strtolower($bulan), array_column($result, 'bulan'));

    //         // Jika bulan sudah ada di hasil, tambahkan jumlahnya
    //         if ($foundIndex !== false) {
    //             $result[$foundIndex]['jumlah']++;
    //         } else {
    //             // Jika bulan belum ada di hasil, tambahkan data baru
    //             $result[] = [
    //                 'bulan' => strtolower($bulan),
    //                 'jumlah' => 1,
    //             ];
    //         }
    //     }
    //     $bulan = $result;
    //     return [
    //         'bulan' => $bulan,
    //         'tanggal' => $tanggal,
    //         'apar' => $apar,
    //         'uraian' => $uraian,
    //         'input' => $input,
    //         'sub_uraian' => $sub_uraian,
    //     ];
    // }

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

        // dd($data);

        if (!$data) {
            return response()->json(['error' => 'Data tidak ditemukan']);
        }

        return view('admin.apar.cetak', $data, compact('tahun'));
    }
}
