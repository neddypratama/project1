@extends('admin.layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Grafik Jumlah Apar per Bulan</h5>
                            <h2 class="card-title">Apar Aktivitas</h2>
                            <div class="p-6 m-20 bg-white rounded shadow">
                                {!! $chart->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="aparChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $chart->script() }}
@endsection
@stack('js')
<script src="{{ $chart->cdn() }}"></script>
<script>

    // Fungsi untuk mendapatkan data dari server
    async function fetchAparData() {
        const response = await fetch('/get-apar-data');
        const data = await response.json();
        return data;
    }

    // Render Chart.js
    async function renderChart() {
        const aparData = await fetchAparData();
        const ctx = document.getElementById('aparChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: aparData.labels, // Nama bulan
                datasets: [{
                    label: 'Jumlah APAR',
                    data: aparData.values, // Data jumlah APAR
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Jumlah APAR Per Bulan'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Jalankan fungsi renderChart saat halaman dimuat
    renderChart();
</script>
