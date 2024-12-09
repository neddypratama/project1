<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Apar Tahun {{ $tahun }}</title>
    <style>
        @page {
            size: A4;
            margin: 15mm 10mm 15mm 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.3;
            color: #333;
        }

        .title {
            text-align: center;
            margin-bottom: 15px;
        }

        .title h2 {
            margin: 0;
            color: #444;
            font-size: 18px;
        }

        .apar-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .apar-table th,
        .apar-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        .apar-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        img {
            max-width: 100px;
            height: auto;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="title">
        <h2>Laporan Apar Tahun {{ $tahun }}</h2>
    </div>

    <table class="apar-table">
        <thead>
            <tr>
                <th rowspan="2" colspan="2">Uraian</th>
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
                            <td rowspan="{{ count($row['sub_uraian']) }}">{{ $row['uraian'] }}</td>
                        @endif
                        <td>{{ $sub }}</td>
                        @foreach ($row['hasil'] as $k => $item)
                            <td>
                                @if ($item[$key] == 1)
                                    ✅
                                @elseif ($item[$key] == 0)
                                    ❌
                                @else
                                    {{ $item[$key] ?? '' }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            @endforeach
            <tr>
                <td colspan="2">Dokumentasi</td>
                @foreach ($apar as $item)
                    <td><img src="{{ asset('storage/' . $item->dokumentasi) }}" alt="Dokumentasi"></td>
                @endforeach
            </tr>
        </tbody>
    </table>
</body>

</html>
