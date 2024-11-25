<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10); // Mengambil nilai limit dari URL
        $search = $request->search;

        // Sorting
        $sortBy = $request->get('sort_by', 'user_id');  // Kolom default untuk sorting
        $order = $request->get('order', 'asc');   // Urutan default ('asc' atau 'desc')

        // Query dasar
        $data = User::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $role = Role::where('role_name', 'like', "%{$search}%")->get();
            if ($role->isNotEmpty()) {
                $data->where(function ($q) use ($search, $role) {
                    $q->whereIn('role_id', $role->pluck('role_id'))
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
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

        $role = Role::all();

        return view('admin.users.index', compact('data', 'role', 'sortBy', 'order'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'edit_role_id'    => 'required|exists:roles,role_id',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'role_id'   => $request->edit_role_id,
            'updated_at'     => now(),
        ]);
        return redirect()->route('user.index')->withStatus(__('User berhasil diperbaharui.'));        
    }
    
    public function destroy(String $id)
    {
        $check = User::findOrFail($id);
        if(!$check){
            return redirect()->route('user.index')->withError(__('User tidak ditemukan.'));
        }
        try{
                User::destroy($id);
                return redirect()->route('user.index')->withStatus(__('User berhasil dihapus.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('user.index')->withError(__('Data pengguna gagal dihapus karena ada tabel lain yang terkait dengan data ini.'));
        }
    }
}
