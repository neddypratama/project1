@extends('admin.layouts.app', ['page' => __('Approve Apar'), 'pageSlug' => 'menu_approve'])

{{-- @stack('style')
</style> --}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Apar {{$apar->apar_id}}</h4>
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
                                        <th colspan="2" style="border: 1px solid #000;">
                                            {{ $bulan }}</th>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <a href="{{ route('apar.approve') }}" class="btn btn-primary">Kembali</a>
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
