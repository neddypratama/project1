<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Get Dashboard Data for Apar Counts by Month.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDashboardData()
    {
        $currentYear = Carbon::now()->year;

        // Query untuk mendapatkan jumlah APAR per bulan
        $data = DB::table('apars')
            ->select(DB::raw('MONTH(created_at) as month, COUNT(*) as total'))
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Pastikan setiap bulan (1-12) memiliki nilai, meskipun 0
        $monthlyData = array_fill(1, 12, 0);
        foreach ($data as $month => $total) {
            $monthlyData[$month] = $total;
        }

        return response()->json([
            'labels' => array_keys($monthlyData),
            'values' => array_values($monthlyData),
        ]);
    }
}
