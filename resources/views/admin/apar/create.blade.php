@extends('admin.layouts.app', ['page' => __('User Management'), 'pageSlug' => 'users'])

{{-- @stack('style')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
    }

    th {
        background-color: #f4f4f4;
    }
</style> --}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Users</h4>
                        </div>
                        <div class="col-4 text-right">
                            {{-- <a href="#" class="btn btn-sm btn-primary">Add user</a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.alerts.success')
                    @include('admin.alerts.alert')
                    <div class="container-fluid">
                        <form method="GET" action="{{ route('user.index') }}" class="d-flex w-100">
                            <div class="form-group flex-grow-1 me-2">
                                <input type="text" name="search" class="form-control form-control-sm mt-1"
                                    placeholder="Search by name, email, or role" value="{{ request()->get('search') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary mt-1"><i
                                        class="tim-icons icon-zoom-split"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="">
                        <div class="table-responsive">
                            {{-- <table class="table table-bordered text-center">
                                <thead class="bg-danger text-white">
                                    <tr>
                                        <th rowspan="2" style="vertical-align: middle;">Uraian</th>
                                        <th colspan="4">{{ $bulan }}</th>
                                    </tr>
                                    <tr>
                                        @foreach ($apar as $a)
                                            <th>{{ $a->tanggal }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($uraian as $u)
                                        <tr>
                                            <td rowspan="2">{{ $u->uraian_nama}}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach


                                    <!-- Tambahkan data lainnya sesuai kebutuhan -->
                                </tbody>
                            </table> --}}

                            <table class="table table-bordered text-center">
                                {{-- <thead class="table-light">
                                    <tr>
                                        <th rowspan="2" colspan="2">Uraian</th>
                                        <th colspan="2">Januari</th>
                                    </tr>
                                    <tr>
                                        <th>10/10/2024</th>
                                        <th>17/10/2024</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1. Posisi</td>
                                        <td>No Tabung</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="4">2. Kondisi Tabung</td>
                                        {{-- <td>aaaa</td>
                                        <td>aaaa</td>
                                        <td>aaaa</td> 
                                    </tr>
                                    <tr>
                                        <td>Tabung Terpakai</td>
                                    </tr>
                                    <tr>
                                        <td>Tabung Terpakai</td>
                                    </tr>
                                    <tr>
                                        <td>Tabung Terpakai</td>
                                    </tr>
                                </tbody> --}}
                                <thead>
                                    <tr>
                                        <th rowspan="2" colspan="2">Uraian</th>
                                        @foreach ($bulan as $b)
                                            <th colspan="{{$b['jumlah']}}">{{ $b['bulan'] }}</th>
                                        @endforeach
                                        {{-- <th colspan="2">bfaaff</th>
                                        <th colspan="1">bfaaff</th> --}}
                                    </tr>
                                    <tr>
                                        {{-- <th>asfgaygfui</th> --}}
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
                                                    <td rowspan="{{ count($row['sub_uraian']) }}">
                                                        {{ $row['uraian'] }}
                                                    </td>
                                                @endif
                                                <td>{{ $sub }}</td>
                                                <td>asdasdasdasdas</td>
                                                <td>saaffdgsgs</td>
                                                <td>ggkgkg</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    {{-- <nav class="d-flex justify-content-between align-items-center" aria-label="...">
                        <div class="form-group">
                            <select id="paginationLimit" class="form-control" onchange="updatePaginationLimit(this.value)"
                                style="font-size: 12px">
                                <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                                <option value="all" {{ request('limit') == 'all' ? 'selected' : '' }}>All</option>
                            </select>
                        </div>

                        {{-- Tampilkan pagination hanya jika tidak memilih 'all' --}}
                    {{-- @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $data->links('vendor.pagination.bootstrap-5') }}
                        @endif
                    </nav> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Modal Edit User -->
    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserTitle">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="" id="editUserForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name User -->
                        <div class="form-group{{ $errors->has('edit_name') ? ' has-danger' : '' }}">
                            <label for="edit-name" class="col-form-label">Name User: </label>
                            <input type="text" name="edit_name" id="edit-name"
                                class="form-control{{ $errors->has('edit_name') ? ' is-invalid' : '' }}" placeholder="Name"
                                value="{{ old('edit_name') }}" readonly>
                            @if ($errors->has('edit_name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_name') }}
                                </span>
                            @endif
                        </div>

                        <!-- Role User -->
                        <div class="form-group{{ $errors->has('edit_role_id') ? ' has-danger' : '' }}">
                            <label for="edit-role-id" class="col-form-label">Name Role: </label>
                            <select name="edit_role_id"
                                class="form-control {{ $errors->has('edit_role_id') ? ' is-invalid' : '' }}"
                                id="edit-role-id" style="height: 50px">
                                <option value="">- Role -</option>
                                @foreach ($role as $p)
                                    <option value="{{ $p->role_id }}"
                                        {{ old('edit_role_id') == $p->role_id ? 'selected' : '' }}>
                                        {{ $p->role_name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('edit_role_id'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_role_id') }}
                                </span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="text-white btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="text-white btn btn-primary">Update Role</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete User -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete data User?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deleteUserForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
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
