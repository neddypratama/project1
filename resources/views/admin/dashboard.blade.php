@extends('admin.layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header">
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
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div class="chart-area">
                        <canvas id="aparChart" width="100%" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{ $chart->script() }}
    <script src="{{ $chart->cdn() }}"></script>
@endpush
