<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Models\InputApar;
use App\Models\SubUraian;
use App\Models\uraian;
use App\Models\User;
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
        return view('admin.apar.create');
    }

    public function update()
    {
        return view('admin.apar.create');
    }

    public function riwayat(Request $request)
    {
        $limit = $request->input('limit', 10);  // Default pagination limit
        $search = $request->search;

        // Sorting
        $sortBy = $request->get('sort_by', 'apar_id');  // Default sorting column (ganti dengan kolom yang ada di tabel Role)
        $order = $request->get('order', 'asc');   // Default sorting order ('asc' atau 'desc')

        // Query dasar
        $data = Apar::query();

        // Filter pencarian
        if ($search) {
            $data->where('status', 'like', "%{$search}%")
                    ->orWhere('tanggal', 'like', "%{$search}%");
        }

        // Terapkan sorting
        $data->orderBy($sortBy, $order);

        // Pagination atau semua data
        if ($limit == 'all') {
            $data = $data->get();  // Ambil semua data
        } else {
            $data = $data->paginate($limit)->appends($request->only('search', 'limit', 'sort_by', 'order')); // Tambahkan query params
        }

        $user = User::all();
        $input = InputApar::all();

        // Kirim data ke view
        return view('admin.apar.riwayat', compact('data', 'input', 'user', 'sortBy', 'order'));
    }

    public function tampil(Request $request, $id)
    {
        $apar = Apar::find($id);
        $uraian = uraian::where('apar_id', $apar->first()->apar_id)->get();
        $sub_uraian = SubUraian::all();
        
        $tanggal = $apar->tanggal;
        $bulan = Carbon::parse($tanggal)->translatedFormat('F');
        
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

        // Kirim data ke view
        return view('admin.apar.show', compact('apar', 'uraian', 'sub_uraian', 'bulan' , 'data' ,'tanggal'));
    }
}
