<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Apar Tahun {{ $tahun }}</title>
    <style>
        @page {
            size: A4;
            margin: 10mm 10mm 10mm 10mm; /* Sesuaikan margin */
        }

        /* Umum */
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            text-align: center;
        }

        /* Bagian kop surat */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-align: left;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header img {
            max-width: 100px;
        }

        .header .info {
            flex-grow: 1;
            padding-left: 10px;
            font-size: 10px;
        }

        /* Tabel */
        .apar-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed;
        }

        .apar-table th,
        .apar-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            word-wrap: break-word;
        }

        .apar-table th {
            background-color: #f2f2f2;
            font-size: 10px;
            font-weight: bold;
        }

        .apar-table td.uraian {
            max-width: 150px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            font-size: 9px;
            padding: 3px;
        }

        img {
            max-width: 100px;
            height: auto;
            margin: 0 auto;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <!-- Kop Surat -->
        <div class="header">
            <img src="{{ public_path('img/logo.png') }}" alt="Logo Perusahaan">
            <div class="info">
                <div style="font-size: 12px; font-weight: bold;">Laporan Apar Tahun {{ $tahun }}</div>
                <div style="font-size: 10px;">Safe Guard</div>
                <div style="font-size: 10px;"><a href="safeguaridn@gmail.com">safeguaridn@gmail.com</a></div>
                <div style="font-size: 10px;"><a href="https://wa.me/6282131997615" target="_blank">082131997615</a></div>
            </div>
        </div>

        <!-- Tabel Laporan -->
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
                                <td rowspan="{{ count($row['sub_uraian']) }}" class="uraian">{{ $row['uraian'] }}</td>
                            @endif
                            <td class="uraian">{{ $sub }}</td>
                            @foreach ($row['hasil'] as $k => $item)
                                <td>
                                    @if ($item[$key] == 1)
                                        V
                                    @elseif ($item[$key] == 0)
                                        X
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
                        <td><img class="img-fluid" src="{{ public_path('storage/' . $item->dokumentasi) }}" alt="Dokumentasi"></td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
