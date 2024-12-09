@extends('admin.layouts.app', ['page' => __('Riwayat Apar'), 'pageSlug' => 'lihat_apar'])

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
    <h4 class="card-title mb-3 fw-light">Edit Apar</h4>
    <div class="row">
        <div class="col-lg-3">
            <div class="card sticky-top top-3">
                {{-- <div class="card-header">
                    <h5>Basic Info</h5>
                </div> --}}
                <ul class="nav flex-column  p-3">
                    <span class="fw-bolder">List Kriteria</span>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body" data-scroll href="#dokumentasi">
                            <span class="text-sm">{{ 'Dokumentasi' }}</span>
                        </a>
                    </li>
                    @foreach ($data as $uraian)
                        @if ($uraian['revisi'] == !null)
                            <li class="nav-item">
                                <a class="nav-link text-body" data-scroll
                                    href="#{{ $uraian['uraian'] }}">
                                    <span class="text-sm" style="color: red;">{{ $uraian['uraian'] }}</span>
                                </a>
                                <p style="font-size: 12px; color: red;" class="ms-3">Revisi: {{ $uraian['revisi'] }}</p>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-body" data-scroll
                                    href="#{{ $uraian['uraian'] }}">
                                    <span class="text-sm">{{ $uraian['uraian'] }}</span>
                                </a>
                            </li>
                        @endif
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
                                        <input type="text" value="{{ old('texthasil.' . $input['sub_id']) }}"
                                            name="texthasil[{{ $input['sub_id'] }}]" class="form-control">
                                        {{-- <input type="hidden" name="{{ $input['sub_id'] }}/{{ $input['tipe'] }}" value="{{ $input['tipe'] }}"> --}}
                                    </div>
                                    @error('texthasil.' . $input['sub_id'])
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                @endforeach
                            @elseif ($input['tipe'] == 'select')
                                <select class="form-select" value="{{ old('selecthasil.' . $input['sub_id']) }}"
                                    name="selecthasil[{{ $input['sub_id'] }}]" aria-label="Default select example">
                                    <option value=" " selected>--Pilih--</option>
                                    @foreach ($input['sub_uraian'] as $sub)
                                        <option value="{{ $sub['sub_uraian'] }}"
                                            {{ old('selecthasil.' . $input['sub_id']) == $sub['sub_uraian'] ? 'selected' : '' }}>
                                            {{ $sub['sub_uraian'] }}</option>
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
