<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'White Dashboard') }}</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('white') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('white') }}/img/favicon.png">

    <!-- CSS & Bootstrap -->
    <link href="{{ asset('white') }}/css/white-dashboard.css?v=1.0.0" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <style type="text/css">
        table tr td,
        table tr th
        {
            font-size: 9pt;
        }
    </style> --}}
</head>
<body class="white-content {{ $class ?? '' }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h5 style="text-align: center">Laporan Apar Tahun {{$tahun}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="mt-5">
                            <table id="laporanTable" class="table table-bordered" style="border: 3px !important;" >
                                <thead class="text-center">
                                    <tr>
                                        <th rowspan="2" colspan="2" style="border: 2px">Uraian</th>
                                        @foreach ($bulan as $b)
                                            <th colspan="{{ $b['jumlah'] }}">{{ $b['bulan'] }}</th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($tanggal as $header)
                                            <th>{{ $header }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        @foreach ($row['sub_uraian'] as $key => $sub)
                                            <tr>
                                                @if ($key === 0)
                                                    <td rowspan="{{ count($row['sub_uraian']) }}" >
                                                        {{ $row['uraian'] }}
                                                    </td>
                                                @endif
                                                <td>{{ $sub }}</td>
                                                <td>
                                                    @if ($row['hasil'][$key] == 1)
                                                        Iya
                                                    @else
                                                        @if ($row['hasil'][$key] == 0)
                                                            Tidak
                                                        @else
                                                            {{ $row['hasil'][$key] ?? '' }}
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    <tr>
                                        <td colspan="2">Dokumentasi</td>
                                        @foreach ($apar as $item)
                                            <td><img src="{{$item->dokumentasi}}" alt=""></td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    
    <script>
        // Cetak otomatis saat halaman dimuat
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
