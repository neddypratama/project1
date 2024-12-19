@extends('admin.layouts.app', ['page' => __('Revisi Apar'), 'pageSlug' => 'menu_approve'])

@section('content')
    <div class="row">
        <!-- Kolom Kiri (Hasil Apar) -->
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Hasil Apar {{ $apar->apar_id }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            {{-- <a href="#" class="btn btn-sm btn-primary">Add user</a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.alerts.success')
                    @include('admin.alerts.alert')
                    <div class="">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th rowspan="2" colspan="2" style="border: 1px solid #000;">Uraian</th>
                                        <th colspan="2" style="border: 1px solid #000;">{{ $bulan }}</th>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid #000;">{{ $tanggal }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        @foreach ($row['sub_uraian'] as $key => $sub)
                                            <tr>
                                                @if ($key === 0)
                                                    <td rowspan="{{ count($row['sub_uraian']) }}"
                                                        style="border: 1px solid #000;">
                                                        {{ $row['uraian'] }}
                                                    </td>
                                                @endif
                                                <td style="border: 1px solid #000;">{{ $sub }}</td>
                                                <td style="border: 1px solid #000;">
                                                    @if ($row['hasil'][$key] == 1)
                                                        <i style="color: rgb(8, 243, 8)" class="fa-solid fa-check"></i>
                                                    @else
                                                        @if ($row['hasil'][$key] == 0)
                                                            <i style="color: red" class="fa-solid fa-xmark"></i>
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
                                        <td><img class="img-fluid" src="{{ asset('storage/' . $apar->dokumentasi) }}"
                                                alt="Dokumentasi"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('apar.approve') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan (Revisi Apar) -->
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Revisi Apar {{ $apar->apar_id }}</h4>
                </div>
                <div class="card-body">
                    <form class="form-floating" method="POST" action="{{ route('apar.simpan', $apar->apar_id) }}">
                        @csrf
                        @method('PUT')
                        @foreach ($uraian as $item)
                            @foreach ($sub_uraian as $sub)
                                @if ($item->uraian_id == $sub->uraian_id)
                                    <div class="form-floating mb-2">
                                        <textarea class="form-control bg-light rounded" name="revisi[{{ $sub->sub_uraian_id }}]"
                                            id="revisi-{{ $sub->sub_uraian_id }}">{{ old('revisi.' . $sub->sub_uraian_id, $input->where('sub_uraian_id', $sub->sub_uraian_id)->first()->revisi ?? '') }}</textarea>
                                        <label for="revisi-{{ $sub->sub_uraian_id }}">{{ $item->uraian_nama }}</label>
                                    </div>
                                    <input type="hidden" name="sub_uraian_ids[]" value="{{ $sub->sub_uraian_id }}">
                                @endif
                            @endforeach
                        @endforeach

                        <button type="submit" class="btn btn-primary btn-block mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
