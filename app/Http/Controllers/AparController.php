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

        $tanggal = $apar->first()->tanggal;
        $bulan = Carbon::parse($tanggal)->translatedFormat('F');
        
        $insertData = [];

        foreach ($sub_uraian as $item) {
            $subUraianNamas = explode('/', $item['sub_uraian_nama']); // Pecah berdasarkan '/'
            foreach ($subUraianNamas as $nama) {
                $insertData[] = [// Tetap gunakan ID yang sama
                    $item->sub_uraian_id => $nama,               // Gunakan nama yang sudah dipecah
                ];
            }
        }

        dd($insertData);


        return view('admin.apar.index', compact('apar', 'uraian', 'sub_uraian', 'bulan'));
    }
}
