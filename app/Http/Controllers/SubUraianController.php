<?php

namespace App\Http\Controllers;

use App\Models\SubUraian;
use App\Models\uraian;
use Illuminate\Http\Request;

class SubUraianController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10); // Mengambil nilai limit dari URL
        $search = $request->search;

        // Sorting
        $sortBy = $request->get('sort_by', 'sub_uraian_id');  // Kolom default untuk sorting
        $order = $request->get('order', 'asc');   // Urutan default ('asc' atau 'desc')

        // Query dasar
        $data = SubUraian::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $uraian = uraian::where('uraian_nama', 'like', "%{$search}%")->get();
            if ($uraian->isNotEmpty()) {
                $data->where(function ($q) use ($search, $uraian) {
                    $q->whereIn('uraian_id', $uraian->pluck('uraian_id'))
                        ->orWhere('sub_uraian_nama', 'like', "%{$search}%")
                        ->orWhere('sub_uraian_tipe', 'like', "%{$search}%");
                });
            } else {
                $data->whereRaw('1 = 0'); // Tidak ada hasil
            }
        }

        // Sorting berdasarkan kolom yang dipilih
        $data->orderBy($sortBy, $order);

        // Handling limit untuk pagination
        if ($limit == 'all') {
            $data = $data->get(); // Ambil semua data tanpa pagination
        } else {
            $data = $data->paginate($limit)->appends($request->only('search', 'limit', 'sort_by', 'order')); // Tambahkan query params
        }

        $uraian = uraian::all();
        $sub = SubUraian::all();
        

        return view('admin.suburaian.index', compact('data', 'uraian', 'sortBy', 'order'));
    }

    public function store(Request $request)
    {
        // Validasi input dari formulir
        $validated = $request->validate([
            'uraian_id' => 'required',
            'sub_uraian_tipe' => 'required|string|max:255',
            'sub_uraian_nama' => 'required|array|min:1',
            'sub_uraian_nama.*' => 'required|string|max:255',
        ]);
        // Gabungkan array menjadi satu string dengan pemisah "/"
        $combinedSubUraianNama = implode('/', $validated['sub_uraian_nama']);
        // dd($combinedSubUraianNama);

        // Simpan data ke database
        SubUraian::create([
            'sub_uraian_tipe' => $validated['sub_uraian_tipe'],
            'sub_uraian_nama' => $combinedSubUraianNama,
            'uraian_id' =>  $validated['uraian_id'],
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('suburaian.index')->withStatus(__('Sub Uraian berhasil ditambahkan.'));
    }



    public function update(Request $request, $id) {
        $request->validate([
            'edit_sub_uraian_nama' => 'required|string|unique:sub_uraians,sub_uraian_nama,' . $id . ',sub_uraian_id',
            'edit_sub_uraian_tipe' => 'required',
            'edit_uraian_id' => 'required|exists:uraians,uraian_id',
        ]);
        
        $suburaian = suburaian::findOrFail($id);

        $suburaian->update([
            'sub_uraian_nama' => $request->edit_sub_uraian_nama,
            'sub_uraian_tipe' => $request->edit_sub_uraian_tipe,
            'uraian_id'   => $request->edit_uraian_id,
            'updated_at'     => now(),
        ]);
        return redirect()->route('suburaian.index')->withStatus(__('Sub Uraian berhasil diperbaharui.'));        
    }
    
    public function destroy(String $id)
    {
        $check = suburaian::findOrFail($id);
        if(!$check){
            return redirect()->route('suburaian.index')->withError(__('Sub Uraian tidak ditemukan.'));
        }
        try{
                suburaian::destroy($id);
                return redirect()->route('suburaian.index')->withStatus(__('Sub Uraian berhasil dihapus.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('suburaian.index')->withError(__('Data pengguna gagal dihapus karena ada tabel lain yang terkait dengan data ini.'));
        }
    }
}
