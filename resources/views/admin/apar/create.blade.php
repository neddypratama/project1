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
        <div class="col-lg-3">
            <div class="card sticky-top top-3">
                <ul class="nav flex-column  p-3">
                    <li class="nav-item">
                        <a class="nav-link text-body" data-scroll href="#profile">
                            <span class="text-sm">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll href="#basic-info">
                            <span class="text-sm">Basic Info</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll href="#password">
                            <span class="text-sm">Change Password</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll href="#delete">
                            <span class="text-sm">Delete Account</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 mt-lg-0 mt-4">
            <div class="card" id="basic-info">
                <div class="card-header">
                    <h5>Basic Info</h5>
                </div>
                <form id="update-form" method="post" action="https://harsyadteknologi.com/profile/1"
                    autocomplete="off">
                    <div class="card-body pt-0">
                        <input type="hidden" name="_token" value="HAsJcUipNxKQke78aomsvhpAfTHo2kfbjqlHd2EX"
                            autocomplete="off"> <input type="hidden" name="_method" value="put">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                value="Admin">
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Address"
                                value="admin@white.com">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button id="save-button" type="submit" class="btn btn-fill btn-secondary">Save</button>
                    </div>
                </form>
            </div>

            <div class="card mt-4" id="password">
                <div class="card-header">
                    <h5>Change Password</h5>
                </div>
                <form method="post" action="https://harsyadteknologi.com/profile-password/1" autocomplete="off">
                    <div class="card-body">
                        <input type="hidden" name="_token" value="HAsJcUipNxKQke78aomsvhpAfTHo2kfbjqlHd2EX"
                            autocomplete="off"> <input type="hidden" name="_method" value="put">

                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" name="old_password" class="form-control"
                                placeholder="Current Password" value="" required>
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control" placeholder="New Password"
                                value="" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirm Password" value="" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-secondary">Change Password</button>
                    </div>
                </form>
            </div>

            <div class="card mt-4" id="delete">
                <div class="card-header">
                    <h5>Delete Account</h5>
                    <p class="text-sm mb-0">Once you delete your account, there is no going back. Please be certain.
                    </p>
                </div>
                <form action="https://harsyadteknologi.com/profile/1" method="POST" id="delete-form">
                    <input type="hidden" name="_token" value="HAsJcUipNxKQke78aomsvhpAfTHo2kfbjqlHd2EX"
                        autocomplete="off"> <input type="hidden" name="_method" value="DELETE">
                    <div class="card-body d-sm-flex pt-0">
                        <div class="d-flex align-items-center mb-sm-0 mb-4">
                            <div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" id="check_delete"
                                        name="check_delete" required>
                                </div>
                            </div>
                            <div class="ms-2">
                                <span class="text-dark font-weight-bold d-block text-sm">Confirm</span>
                                <span class="text-xs d-block">I want to delete my account.</span>
                            </div>
                        </div>
                        <button class="btn bg-gradient-danger mb-0 ms-auto" type="submit" name="button">Delete
                            Account</button>
                    </div>
                </form>
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
