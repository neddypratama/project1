@extends('admin.layouts.app', ['page' => __('Tampil Apar'), 'pageSlug' => 'tampil_apar'])

{{-- @stack('style')
</style> --}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Apar {{ $apar->apar_id }}</h4>
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
                        <table id="laporanTable" class="table table-bordered" style="border: 3px !important;">
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
                                @foreach ($uraian as $row)
                                    <tr>
                                        <td rowspan="{{ $sub_uraian->where('uraian_id', $row->uraian_id)->count() }}">
                                            {{ $row->uraian_nama }}
                                        </td>
                                        @php $firstSub = true; @endphp
                                        @foreach ($sub_uraian->where('uraian_id', $row->uraian_id) as $sub)
                                            @if (!$firstSub)
                                    <tr>
                                @endif
                                <td>{{ $sub->sub_uraian_nama }}</td>
                                @foreach ($input as $i)
                                    @if ($sub->sub_uraian_id == $i->sub_uraian_id)
                                        @if ($i->hasil_apar == 1)
                                            <td>Iyaa</td>
                                        @else
                                            @if ($i->hasil_apar == 0)
                                                <td>Tidak</td>
                                            @else
                                                <td>{{ $i->hasil_apar }}</td>
                                            @endif
                                        @endif
                                    @break
                                @endif
                            @endforeach
                            </tr>
                            @php $firstSub = false; @endphp
                            @endforeach
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">Dokumentasi</td>
                                @foreach ($apar as $item)
                                    <td>
                                        <img src="{{ asset($item->dokumentasi) }}" alt="Dokumentasi"
                                            style="width: 100px; height: auto; border: 1px solid #ccc;">
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer ">
                <a href="{{ route('apar.riwayat') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>

@endsection

@stack('js')
<script>
    function updatePaginationLimit(limit) {
        const url = new URL(window.location.href);
        url.searchParams.set('limit', limit); // Tambahkan atau update parameter 'limit'
        window.location.href = url.toString(); // Redirect ke URL baru
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Check and show the editlayanan modal if there are errors for edit layanan
        if (
            {{ $errors->has('edit_user_name') || $errors->has('edit_role_id') ? 'true' : 'false' }}
        ) {
            var edituserModal = new bootstrap.Modal(document.getElementById('editUser'));
            var url = localStorage.getItem('Url');
            edituserModal.show();
            $('#editUserForm').attr('action', url);

            console.log(@json($errors->all()));
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var userId = this.getAttribute('data-id');
                var userName = this.getAttribute('data-name');
                var userRole = this.getAttribute('data-role');
                var actionUrl = this.getAttribute('data-url');
                localStorage.setItem('Url', actionUrl);

                console.log(actionUrl);

                $('#edit-id').val(userId);
                $('#edit-name').val(userName);
                $('#edit-role-id').val(userRole);

                // Atur action form untuk update
                $('#editUserForm').attr('action', actionUrl);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Ketika tombol delete diklik
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                var userId = this.getAttribute('data-id');
                var userDeleteUrl = this.getAttribute('data-url');

                // Atur action form untuk delete
                document.getElementById('deleteUserForm').setAttribute('action',
                    userDeleteUrl);
            });
        });
    });
</script>
