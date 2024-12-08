@extends('admin.layouts.app', ['page' => __('INPUT INSPEKSI'), 'pageSlug' => 'input_apar'])

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
    <h4 class="card-title mb-3 fw-light">Input Inspeksi</h4>
    <div class="row">
        <div class="col-lg-3">
            <div class="card sticky-top top-3">
                {{-- <div class="card-header">
                    <h5>Basic Info</h5>
                </div> --}}
                <ul class="nav flex-column  p-3">
                    <span class="fw-bolder">List Krteria</span>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll href="#dokumentasi">
                            <span class="text-sm">{{ 'Dokumentasi' }}</span>
                        </a>
                    </li>
                    @foreach ($data as $uraian)
                        <li class="nav-item pt-2">
                            <a class="nav-link text-body" data-scroll href="#{{ $uraian['uraian'] }}">
                                <span class="text-sm">{{ $uraian['uraian'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-lg-9 mt-lg-0 mt-4">
            <form action="{{ route('apar.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5>Dokumentasi</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="">
                            <label for="formFile" class="form-label">Upload dokumentasi</label>
                            <input class="form-control" type="file" id="formFile" name="dokumentasi"
                                onchange="previewImage()">
                        </div>
                        <div class="mt-3">
                            <img id="previewImagee" style="width: 300px" />
                        </div>
                        @error('dokumentasi') 
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                @foreach ($data as $index => $input)
                    <div class="card" id="{{ $input['uraian'] }}">
                        <div class="card-header">
                            <h5>{{ $input['uraian'] }}</h5>
                        </div>
                        <div class="card-body pt-0">

                            {{-- @foreach ($input['sub_uraian'] as $sub) --}}
                            @if ($input['tipe'] == 'text')
                                @foreach ($input['sub_uraian'] as $sub)
                                    {{-- <option value="1">{{ $sub['sub_uraian'] }}</option> --}}
                                    <div class="form-group">
                                        <label>{{ $sub['sub_uraian'] }}</label>
                                        <input type="text" value="{{old('texthasil.' . $input['sub_id'])}}" name="texthasil[{{ $input['sub_id'] }}]" class="form-control">
                                        {{-- <input type="hidden" name="{{ $input['sub_id'] }}/{{ $input['tipe'] }}" value="{{ $input['tipe'] }}"> --}}
                                    </div>
                                    @error('texthasil.' . $input['sub_id'])
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                @endforeach
                            @elseif ($input['tipe'] == 'select')
                                <select class="form-select" value="{{old('selecthasil.' . $input['sub_id'])}}" name="selecthasil[{{ $input['sub_id'] }}]"
                                    aria-label="Default select example">
                                    <option value=" " selected>--Pilih--</option>
                                    @foreach ($input['sub_uraian'] as $sub)
                                        <option value="{{ $sub['sub_uraian'] }}" {{old('selecthasil.' . $input['sub_id']) == $sub['sub_uraian'] ? 'selected' : ''}}>{{ $sub['sub_uraian'] }}</option>
                                    @endforeach
                                </select>
                                @error('selecthasil.' . $input['sub_id'])
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                {{-- <input type="hidden" name="{{ $input['sub_id'] }}/{{ $input['tipe'] }}" value="{{ $input['tipe'] }}"> --}}
                            @endif

                            {{-- <div class="form-group">
                                    <label>{{ $sub }}</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name"
                                        value="Admin">
                                </div> --}}
                            {{-- @endforeach --}}
                        </div>
                    </div>
                @endforeach

                <div class="card-footer">
                    <button type="submit" class="ms-auto btn btn-fill btn-secondary">Simpan</button>
                </div>
            </form>
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
    // document.getElementById("formFile").addEventListener("change", function(event) {
    //     const file = event.target.files[0];
    //     const previewImage = document.getElementById("previewImage");


    // });
    function previewImage() {
        const file = document.querySelector("#formFile");
        const preview = document.querySelector("#previewImagee");
        preview.style.display = "block"; // Tampilkan gambar setelah dipilih

        const reader = new FileReader();

        reader.readAsDataURL(file.files[0]);
        reader.onload = function(eFREvent) {
            preview.src = eFREvent.target.result;
            // preview.src = "#";
            // preview.style.display = "none"; // Sembunyikan gambar jika tidak ada file

        }
    }

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
