<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Models\InputApar;
use App\Models\SubUraian;
use App\Models\uraian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stringable;

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

        // dd($result , $tanggal);

        $bulan = $result;

        $data = [];

        foreach ($uraian as $item) {
            $data[] = [
                'uraian' => $item->uraian_nama,
                'sub_id' => SubUraian::where('uraian_id', $item->uraian_id)->first()->sub_uraian_id,
                'sub_uraian' => explode('/', SubUraian::where('uraian_id', $item->uraian_id)->first()->sub_uraian_nama),
                // 'hasil' => '',
            ];
        }
        
        // Edit data tertentu
        foreach ($sub_uraian as $sub) {
            foreach ($data as &$row) {
                if ($row['sub_id'] == $sub->sub_uraian_id) {
                    $row['hasil'] = explode('/', InputApar::where('sub_uraian_id', $sub->sub_uraian_id)->first()->hasil_apar);
                }
            }
        }
        
        // dd($data);

        return view('admin.apar.index', compact('apar', 'uraian', 'sub_uraian', 'bulan' , 'data' ,'tanggal'));
    }

    public function create()
    {
        // $apar = Apar::all();
        $uraian = uraian::all();
        $sub_uraian = SubUraian::all();

        $data = [];
        foreach ($uraian as $item) {
            $slug = [];
            $s = explode('/', SubUraian::where('uraian_id', $item->uraian_id)->first()->sub_uraian_nama);
            foreach ($s as $key => $value) {
                $slug[] = [
                    'slug' => Str::slug($value),
                    'sub_uraian' => $value
                ];
                // Str::slug($value);
            }
            $data[] = [
                'uraian' => $item->uraian_nama,
                'sub_id' => SubUraian::where('uraian_id', $item->uraian_id)->first()->sub_uraian_id,
                'tipe' => SubUraian::where('uraian_id', $item->uraian_id)->first()->sub_uraian_tipe,
                'sub_uraian' => $slug,
                'slug' => $slug,
                // 'hasil' => '',
            ];
            // Str::slug($value)
        }


        // foreach ($sub_uraian as $sub) {
        //     foreach ($data as $row) {
        //         if ($row['sub_id'] == $sub->sub_uraian_id) {
        //             $row['hasil'] = explode('/', InputApar::where('sub_uraian_id', $sub->sub_uraian_id)->first()->hasil_apar);
        //         }
        //     }
        // }

        // dd($data);

        return view('admin.apar.create' , compact('uraian', 'sub_uraian', 'data'));
    }
}
