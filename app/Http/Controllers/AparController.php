<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Models\InputApar;
use App\Models\SubUraian;
use App\Models\uraian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Stringable;

class AparController extends Controller
{
    public function index(Request $request)
    {
        $apar = Apar::all();
        $tanggal =[];
        foreach ($apar as $a) {
            $tanggal[] = 
                 $a->tanggal;
        }
        $result = [];
        foreach ($tanggal as $date) {
            // Konversi tanggal menjadi objek Carbon
            $carbonDate = Carbon::parse($date);
        
            // Ambil tahun dari tanggal
            $tahun = $carbonDate->year;
        
            // Cari indeks tahun yang sama di hasil
            $foundIndex = array_search($tahun, array_column($result, 'tahun'));
        
            // Jika tahun sudah ada di hasil, tambahkan jumlahnya
            if ($foundIndex !== false) {
                $result[$foundIndex]['jumlah']++;
            } else {
                // Jika tahun belum ada di hasil, tambahkan data baru
                $result[] = [
                    'tahun'  => $tahun,
                    'jumlah' => 1,
                ];

                
            }
        }

        return view('admin.apar.index', compact('apar', 'result'));
    }

    public function cetak(Request $request)
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
                'hasil' => '',
            ];
        }
        
        // Edit data tertentu
        foreach ($sub_uraian as $sub) {
            foreach ($data as $row) {
                if ($row['sub_id'] == $sub->sub_uraian_id) {
                    $row['hasil'] = explode('/', InputApar::where('sub_uraian_id', $sub->sub_uraian_id)->first()->hasil_apar);
                }
            }
        }
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

    public function store(Request $request)
    {

        // dd($request['selecthasil']);

        // $suburaian = SubUraian::all()->select('sub_uraian_id' , 'sub_uraian_tipe')->toArray();

        $validated = [];

        if (!$request['texthasil']) {
            // dd("dsadasd");
            $validated = $request->validate([
                'dokumentasi' => 'required|image|file|max:2048',
                // 'texthasil.*' => 'required|min:3',
                'selecthasil.*' => 'required',
            ],[
                'dokumentasi.required' => 'File dokumentasi wajib diunggah.',
                'dokumentasi.image' => 'File dokumentasi harus berupa gambar.',
                'dokumentasi.max' => 'Ukuran file dokumentasi tidak boleh lebih dari 2MB.',
                // 'texthasil.*.required' => 'Field teks wajib diisi.',
                'selecthasil.*.required' => 'Field pilihan wajib diisi.',
            ]);
        };

        if (!$request['selecthasil']) {
            // dd("dsadasd");
            $validated = $request->validate([
                'dokumentasi' => 'required|image|file|max:2048',
                'texthasil.*' => 'required|min:3',
                // 'selecthasil.*' => 'required',
            ],[
                'dokumentasi.required' => 'File dokumentasi wajib diunggah.',
                'dokumentasi.image' => 'File dokumentasi harus berupa gambar.',
                'dokumentasi.max' => 'Ukuran file dokumentasi tidak boleh lebih dari 2MB.',
                'texthasil.*.required' => 'Field teks wajib diisi.',
                // 'selecthasil.*.required' => 'Field pilihan wajib diisi.',
            ]);
        };

        $validated = $request->validate([
            'dokumentasi' => 'required|image|max:2048',
            'texthasil.*' => 'required|min:3',
            'selecthasil.*' => 'required',
        ],[
            'dokumentasi.required' => 'File dokumentasi wajib diunggah.',
            'dokumentasi.image' => 'File dokumentasi harus berupa gambar.',
            'dokumentasi.max' => 'Ukuran file dokumentasi tidak boleh lebih dari 2MB.',
            'texthasil.*.required' => 'Field teks wajib diisi.',
            'selecthasil.*.required' => 'Field pilihan wajib diisi.',
        ]);
        
        if ($request->file('dokumentasi')) {
            Storage::disk('public')->putFile('apar', $request->file('dokumentasi'));
            // dd("asdasd ");
            $validated['dokumentasi'] = $request->file('dokumentasi')->store('apar');
        }
        
        
        
        // dd($validated);
        
        // dump($data);

        $id = Apar::create([
           'tanggal' => now(),
           'status' => 'Revisi',
           'user_id' => auth()->user()->user_id,
           'dokumentasi' => $validated['dokumentasi'],
        ]);

        foreach ($validated['texthasil'] as $key => $value) {
            InputApar::create([
                'apar_id' => $id->apar_id,
                'sub_uraian_id' => $key,
                'hasil_apar' => $value,
            ]);
        }

        foreach ($validated['selecthasil'] as $key1 => $valuee) {
            $i = [];
            $s = explode('/', SubUraian::where('uraian_id', $key1)->first()->sub_uraian_nama);
            foreach ($s as $index => $isi) {
                if ($isi == $valuee) {
                    $i[] = 1;
                } else {
                    $i[] = 0;
                }
            }
            $tes = implode("/", $i);
            // dump($tes);
            InputApar::create([
                'apar_id' => $id->apar_id,
                'sub_uraian_id' => $key1,
                'hasil_apar' => $tes,
            ]);
        }
        // dd($validated);

        return redirect()->route('apar.index')->withStatus('Apar berhasil ditambahkan.');
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
