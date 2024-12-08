<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Models\SubUraian;
use App\Models\uraian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AparController extends Controller
{
    public function index(Request $request)
    {
        $apar = Apar::all();
        $uraian = uraian::where('apar_id', $apar->first()->apar_id)->get();
        $sub_uraian = SubUraian::all();
        
        $tanggal =[];
        foreach ($apar as $a) {
            $tanggal[] = 
                 $a->tanggal
            ;
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

        // dd($result , $tanggal);

        $bulan = $result;
        
        $sub_uraian_nama = [];

        $data = [];

        foreach ($uraian as $item) {
            $data[] = [
                'uraian' => $item->uraian_nama,
                'sub_uraian' => explode('/', SubUraian::where('uraian_id', $item->uraian_id)->first()->sub_uraian_nama)
            ];
        }
        return view('admin.apar.index', compact('apar', 'uraian', 'sub_uraian', 'bulan' , 'data' ,'tanggal'));
    }
}
