<?php

namespace App\Http\Controllers;

use App\Charts\AparPerBulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // Tampilkan halaman dashboard
    public function index( AparPerBulan $chart)
    {
        return view('admin.dashboard' , ['chart' => $chart->build()]);
    }

    // Ambil data jumlah apar per bulan
    public function getMonthlyAparData()
    {
        $data = DB::table('apars')
            ->select(DB::raw('MONTH(tanggal) as month, COUNT(*) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $labels = [];
        $values = [];

        foreach ($data as $month => $total) {
            $labels[] = $this->getMonthName((int)$month); // Ubah angka ke nama bulan
            $values[] = $total;
        }

        return response()->json([
            'labels' => $labels,
            'values' => $values,
        ]);
    }

    private function getMonthName($month)
    {
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
        return $months[$month] ?? '';
    }
}
