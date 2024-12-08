@extends('admin.layouts.app', ['page' => __('Laporan Apar'), 'pageSlug' => 'lapor_apar'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Laporan Apar</h4>
                        </div>
                        <div class="col-4 text-right"></div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.alerts.success')
                    @include('admin.alerts.alert')
                    <div class="container">
                        <table class="table table-responsive-xl " id="">
                            <thead class="text-primary">
                                <tr>
                                    <th scope="col">
                                        Tahun Apar
                                    </th>
                                    <th scope="col">
                                        Jumlah Apar
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($result as $b)
                                    <tr>
                                        <td>{{ $b['tahun'] }}</td>
                                        <td>{{ $b['jumlah'] }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ url('download-pdf/'. $b['tahun']) }}">Download PDF</a>
                                                    <a class="dropdown-item" href="{{ url('download-excel/'. $b['tahun']) }}">Download Excel</a>
                                                    <a class="dropdown-item" href="{{ url('print/'. $b['tahun']) }}">Print</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada role yang ditemukan</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
