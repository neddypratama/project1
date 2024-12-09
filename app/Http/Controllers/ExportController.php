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
        $uraian = uraian::all();
        $sub_uraian = SubUraian::all();
        
        $tanggal =  Apar::whereYear('tanggal', $tahun)->pluck('tanggal')->toArray(); // $apar->tanggal; 


        $apar_id =  Apar::whereYear('tanggal', $tahun)->pluck('apar_id')->toArray(); // $apar->tanggal; 
        // dump($apar_id);

        $result = [];

        // Loop melalui array tanggal dan olah data
        foreach ($tanggal as $date) {
            // Konversi tanggal menjadi objek Carbon
            $carbonDate = Carbon::parse($date);

            // Ambil nama bulan dalam bahasa Inggris atau Indonesia
            $bulan = $carbonDate->translatedFormat('F');

            // Cari indeks bulan yang sama di $result
            $foundIndex = array_search(strtolower($bulan), array_column($result, 'bulan'));

            // Jika bulan sudah ada di hasil, tambahkan tanggal ke dalam daftar tanggal
            if ($foundIndex !== false) {
                $result[$foundIndex]['tanggal'][] = $carbonDate->toDateString();
                $result[$foundIndex]['jumlah'] += 1;
            } else {
                // Jika bulan belum ada di hasil, tambahkan data baru
                $result[] = [
                    'bulan' => strtolower($bulan),
                    'jumlah' => 1,
                    'tanggal' => [$carbonDate->toDateString()] // Tambahkan tanggal sebagai array
                ];
            }
        }


        $bulan = $result;
        // $bulan['tanggal'] = $tanggal;
        
        $data = [];
        foreach ($uraian as $item) {
            $subid = SubUraian::where('uraian_id', $item->uraian_id)->first()->sub_uraian_id;
            

            $data[] = [
                'tanggal' => $tanggal,
                'bulan' => $bulan,
                'uraian' => $item->uraian_nama,
                'sub_id' => $subid,
                'sub_uraian' => explode('/', SubUraian::where('uraian_id', $item->uraian_id)->first()->sub_uraian_nama),
                // 'hasil' => $slug,
            ];
        }
        // dd($data);
        
        // Edit data tertentu

        $hasil = [];

        foreach ($sub_uraian as $key => $sub) {
            $q = InputApar::select('hasil_apar' , 'apar_id')->where('sub_uraian_id', $sub->sub_uraian_id)->get()->toArray();

            $d = explode("/", $sub->sub_uraian_nama);

            // $hasil[$sub->sub_uraian_id]['sub_uraian'] = [$d];
            foreach ($q as $keyy => $e) {
                foreach ($apar_id as  $a) {
                    // dump($a , $e);
                    if ($a == $e['apar_id']) {
                        $p = explode('/', $e['hasil_apar']);
                        // $k = $keyy;
                        $hasil[$sub->sub_uraian_id][$keyy] = $p ;
                    }
                }
                // dump($d , $p );
            }
            // foreach ($data as $row) {
            //     if ($row['sub_id'] == $sub->sub_uraian_id) {
            //         // $row['hasil'] = explode('/', InputApar::where('sub_uraian_id', $sub->sub_uraian_id)->get()->toArray());
            //         $row['hasil'] = $q;
            //     }
            // }
        }
        foreach ($data as $key => $row) {
            $data[$key]['hasil'] = $hasil[$row['sub_id']];
        }
        // dd($data , $bulan, $tanggal, $apar, $uraian, $sub_uraian , $hasil);
        // dd(InputApar::where('sub_uraian_id', $sub->sub_uraian_id)->get()->toArray());
        // dd($data);
        // Kirim data ke view
        // return view('admin.apar.acc', compact('apar', 'uraian', 'sub_uraian', 'bulan' , 'data' ,'tanggal'));
        return [
            'bulan' => $bulan,
            'tanggal' => $tanggal,
            'apar' => $apar,
            'uraian' => $uraian,
            'sub_uraian' => $sub_uraian,
            'data' => $data,
            'hasil' => $hasil,
        ];
    }
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

        // dd(count($data['data'][4]['sub_uraian']));

        if (!$data) {
            return response()->json(['error' => 'Data tidak ditemukan']);
        }

        return view('admin.apar.cetak2', $data, compact('tahun'));
    }
}
