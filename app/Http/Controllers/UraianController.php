<?php

namespace App\Http\Controllers;

use App\Models\uraian;
use Illuminate\Http\Request;

class UraianController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);  // Default pagination limit
        $search = $request->search;

        // Sorting
        $sortBy = $request->get('sort_by', 'uraian_id');  // Default sorting column (ganti dengan kolom yang ada di tabel uraian)
        $order = $request->get('order', 'asc');   // Default sorting order ('asc' atau 'desc')

        // Query dasar
        $data = uraian::query();

        // Filter pencarian
        if ($search) {
            $data->where('uraian_nama', 'like', "%{$search}%");
        }

        // Terapkan sorting
        $data->orderBy($sortBy, $order);

        // Pagination atau semua data
        if ($limit == 'all') {
            $data = $data->get();  // Ambil semua data
        } else {
            $data = $data->paginate($limit)->appends($request->only('search', 'limit', 'sort_by', 'order')); // Tambahkan query params
        }

        // Kirim data ke view
        return view('admin.uraian.index', compact('data', 'sortBy', 'order'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'uraian_nama'    => 'required|string|max:255',
        ]);

        uraian::create([
            'uraian_nama'   => $request->uraian_nama,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        
        return redirect()->route('uraian.index')->withStatus('Uraian berhasil ditambahkan.');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'edit_uraian_nama'    => 'required|string|max:255',
        ]);

        $uraian = uraian::findOrFail($id);

        $uraian->update([
            'uraian_nama'   => $request->edit_uraian_nama,
            'updated_at'     => now(),
        ]);
        return redirect()->route('uraian.index')->withStatus(__('Uraian berhasil diperbaharui.'));        
    }
    
    public function destroy(String $id)
    {
        $check = uraian::findOrFail($id);
        if(!$check){
            return redirect()->route('uraian.index')->withError(__('Uraian tidak ditemukan.'));
        }
        try{
                uraian::destroy($id);
                return redirect()->route('uraian.index')->withStatus(__('Uraian berhasil dihapus.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('uraian.index')->withError(__('Data pengguna gagal dihapus karena ada tabel lain yang terkait dengan data ini.'));
        }
    }
}
