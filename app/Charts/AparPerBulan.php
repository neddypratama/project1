<?php

namespace App\Charts;

use App\Models\Apar;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class AparPerBulan
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // Ambil semua data APAR
        $apar = Apar::all();

        // Array untuk menyimpan jumlah kejadian per bulan untuk setiap tahun
        $groupedByYearAndMonth = [];

        // Proses pengelompokan data
        foreach ($apar as $a) {
            $carbonDate = Carbon::parse($a->tanggal);
            $year = $carbonDate->year; // Ambil tahun
            $month = $carbonDate->format('n'); // Ambil bulan (1-12)

            // Tambahkan jumlah kejadian pada bulan tertentu
            if (!isset($groupedByYearAndMonth[$year][$month])) {
                $groupedByYearAndMonth[$year][$month] = 0;
            }
            $groupedByYearAndMonth[$year][$month]++;
        }

        // Persiapan data untuk chart
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $dataSets = [];

        // Susun data untuk setiap tahun
        foreach ($groupedByYearAndMonth as $year => $monthsData) {
            $data = [];
            foreach (range(1, 12) as $month) {
                $data[] = $monthsData[$month] ?? 0; // Isi 0 jika tidak ada data di bulan tersebut
            }
            $dataSets[$year] = $data;
        }

        // Inisialisasi chart
        $chart = $this->chart->barChart()
            ->setTitle('Laporan APAR per Bulan')
            ->setSubtitle('Jumlah kejadian APAR berdasarkan bulan dan tahun')
            ->setXAxis($months);

        // Tambahkan data ke chart untuk setiap tahun
        foreach ($dataSets as $year => $data) {
            $chart->addData($year, $data); // Nama tahun sebagai label
        }

        return $chart;
    }
}
