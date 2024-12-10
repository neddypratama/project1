@extends('admin.layouts.app', ['page' => __('Sub Uraian Management'), 'pageSlug' => 'manage_suburaian'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Sub Uraian</h4>
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#addsuburaian">
                                Add Sub Uraian
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.alerts.success')
                    @include('admin.alerts.alert')
                    <div class="container-fluid">
                        <form method="GET" action="{{ route('suburaian.index') }}" class="d-flex w-100">
                            <div class="form-group flex-grow-1 me-2">
                                <input type="text" nama="search" class="form-control form-control-sm mt-1"
                                    placeholder="Search by nama, tipe or uraian" value="{{ request()->get('search') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary mt-1"><i
                                        class="tim-icons icon-zoom-split"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="">
                        <table class="table table-responsive-xl" style="width: 100%" id="">
                            <thead class="text-primary ">
                                <tr>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'sub_uraian_nama', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Nama Sub Uraian
                                            @if ($sortBy === 'sub_uraian_nama')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'sub_uraian_tipe', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Tipe Sub Uraian
                                            @if ($sortBy === 'sub_uraian_tipe')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'uraian_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Nama Uraian
                                            @if ($sortBy === 'uraian_id')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'created_at', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Tanggal Dibuat
                                            @if ($sortBy === 'created_at')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $d)
                                    <tr>
                                        <td>{{ $d->sub_uraian_nama }}</td>
                                        <td>{{ $d->sub_uraian_tipe }}</a></td>
                                        <td>
                                            @foreach ($uraian as $p)
                                                @if ($p->uraian_id === $d->uraian_id)
                                                    {{ $p->uraian_nama }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $d->created_at }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item edit-button" data-bs-toggle="modal"
                                                        data-bs-target="#editsuburaian" data-id="{{ $d->sub_uraian_id }}"
                                                        data-nama="{{ $d->sub_uraian_nama }}"
                                                        data-tipe="{{ $d->sub_uraian_tipe }}"
                                                        data-uraian="{{ $d->uraian_id }}"
                                                        data-url="{{ url('suburaian/' . $d->sub_uraian_id) }}">Edit</a>
                                                    <a class="dropdown-item delete-button" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal" data-id="{{ $d->sub_uraian_id }}"
                                                        data-url="{{ url('suburaian/' . $d->sub_uraian_id) }}">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada sub uraian yang ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer ">
                    <nav class="d-flex justify-content-between align-items-center" aria-label="...">
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
                        @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $data->links('vendor.pagination.bootstrap-5') }}
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add role-->
    <div class="modal fade" id="addsuburaian" tabindex="-1" aria-labelledby="addsuburaianTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Uraian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('suburaian.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Nama Uraian -->
                        <div class="form-group{{ $errors->has('uraian_id') ? ' has-danger' : '' }}">
                            <label for="uraian_id" class="col-form-label">Nama Uraian: </label>
                            <select name="uraian_id"
                                class="form-control {{ $errors->has('uraian_id') ? ' is-invalid' : '' }}" id="uraian_id"
                                style="height: 60px">
                                <option value="">- Uraian -</option>
                                @foreach ($uraian as $p)
                                    <option value="{{ $p->uraian_id }}"
                                        {{ old('uraian_id') == $p->uraian_id ? 'selected' : '' }}>
                                        {{ $p->uraian_nama }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('uraian_id'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('uraian_id') }}
                                </span>
                            @endif
                        </div>

                        <!-- Tipe Sub Uraian -->
                        <div class="form-group{{ $errors->has('sub_uraian_tipe') ? ' has-danger' : '' }}">
                            <label for="sub_uraian_tipe" class="col-form-label">Tipe Sub Uraian: </label>
                            <select name="sub_uraian_tipe" id="sub_uraian_tipe"
                                class="form-control{{ $errors->has('sub_uraian_tipe') ? ' is-invalid' : '' }}"
                                style="height: 60px">
                                <option value="">- Pilih Tipe -</option>
                                <option value="text" {{ old('sub_uraian_tipe') == 'text' ? 'selected' : '' }}>Text
                                </option>
                                <option value="select" {{ old('sub_uraian_tipe') == 'select' ? 'selected' : '' }}>
                                    Select
                                </option>
                            </select>
                            @if ($errors->has('sub_uraian_tipe'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('sub_uraian_tipe') }}
                                </span>
                            @endif
                        </div>

                        <!-- Dynamic Input Sub Uraian -->
                        <div id="sub_uraian_container">
                            @foreach (old('sub_uraian_nama', ['']) as $index => $value)
                                <div class="form-group{{ $errors->has("sub_uraian_nama.$index") ? ' has-danger' : '' }}">
                                    <label for="sub_uraian_nama_{{ $index }}" class="col-form-label">Name Sub
                                        Uraian: </label>
                                    <input type="text" name="sub_uraian_nama[]"
                                        id="sub_uraian_nama_{{ $index }}"
                                        class="form-control{{ $errors->has("sub_uraian_nama.$index") ? ' is-invalid' : '' }}"
                                        placeholder="Name Sub Uraian" value="{{ $value }}">
                                    @if ($errors->has("sub_uraian_nama.$index"))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first("sub_uraian_nama.$index") }}
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Tombol untuk menambahkan dan menghapus input -->
                        <div class="mb-2">
                            <button type="button" class="btn btn-success" onclick="addSubUraian()">Add Sub
                                Uraian</button>
                            <button type="button" class="btn btn-danger" onclick="removeSubUraian()">Remove Sub
                                Uraian</button>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Uraian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Edit suburaian -->
    <div class="modal fade" id="editsuburaian" tabindex="-1" aria-labelledby="editsuburaianTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editsuburaianTitle">Edit Sub Uraian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="" id="editsuburaianForm"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama Sub Uraian -->
                        <div class="form-group{{ $errors->has('edit_sub_uraian_nama') ? ' has-danger' : '' }}">
                            <label for="edit-sub-uraian-nama" class="col-form-label">Nama Sub Uraian: </label>
                            <input type="text" name="edit_sub_uraian_nama" id="edit-sub-uraian-nama"
                                class="form-control{{ $errors->has('edit_sub_uraian_nama') ? ' is-invalid' : '' }}"
                                placeholder="Nama Sub Uraian" value="{{ old('edit_sub_uraian_nama') }}">
                            @if ($errors->has('edit_sub_uraian_nama'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_sub_uraian_nama') }}
                                </span>
                            @endif
                        </div>

                        <!-- Tipe Sub Uraian -->
                        <div class="form-group{{ $errors->has('edit_sub_uraian_tipe') ? ' has-danger' : '' }}">
                            <label for="edit-sub-uraian-tipe" class="col-form-label">Tipe Sub Uraian: </label>
                            <select name="edit_sub_uraian_tipe" id="edit-sub-uraian-tipe"
                                class="form-control{{ $errors->has('edit_sub_uraian_tipe') ? ' is-invalid' : '' }}"
                                style="height: 60px">
                                <option value="">- Pilih Tipe -</option>
                                <option value="text" {{ old('edit_sub_uraian_tipe') == 'text' ? 'selected' : '' }}>
                                    Text
                                </option>
                                <option value="select" {{ old('edit_sub_uraian_tipe') == 'select' ? 'selected' : '' }}>
                                    Select
                                </option>
                            </select>
                            @if ($errors->has('edit_sub_uraian_tipe'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_sub_uraian_tipe') }}
                                </span>
                            @endif
                        </div>

                        <!-- Nama Uraian -->
                        <div class="form-group{{ $errors->has('edit_uraian_id') ? ' has-danger' : '' }}">
                            <label for="edit-uraian-id" class="col-form-label">Nama Uraian: </label>
                            <select name="edit_uraian_id"
                                class="form-control {{ $errors->has('edit_uraian_id') ? ' is-invalid' : '' }}"
                                id="edit-uraian-id" style="height: 60px">
                                <option value="">- Uraian -</option>
                                @foreach ($uraian as $p)
                                    <option value="{{ $p->uraian_id }}"
                                        {{ old('edit_uraian_id') == $p->uraian_id ? 'selected' : '' }}>
                                        {{ $p->uraian_nama }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('edit_uraian_id'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_uraian_id') }}
                                </span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="text-white btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="text-white btn btn-primary">Update Uraian</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete suburaian -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Sub Uraian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete data sub uraian?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deletesuburaianForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@stack('js')
<script>
    let subUraianCount =
        {{ count(old('sub_uraian_nama', [''])) }}; // Hitung jumlah input berdasarkan data lama jika ada

    function addSubUraian() {
        const container = document.getElementById('sub_uraian_container');
        const newInputGroup = document.createElement('div');
        newInputGroup.classList.add('form-group');
        newInputGroup.innerHTML = `
        <label for="sub_uraian_nama_${subUraianCount}" class="col-form-label">Name Sub Uraian: </label>
        <input type="text" name="sub_uraian_nama[]" id="sub_uraian_nama_${subUraianCount}" class="form-control" placeholder="Name Sub Uraian">
    `;
        container.appendChild(newInputGroup);
        subUraianCount++;
    }

    function removeSubUraian() {
        const container = document.getElementById('sub_uraian_container');
        if (subUraianCount > 1) {
            container.removeChild(container.lastElementChild);
            subUraianCount--;
        } else {
            alert("Minimal satu input harus ada.");
        }
    }


    function updatePaginationLimit(limit) {
        const url = new URL(window.location.href);
        url.searchParams.set('limit', limit); // Tambahkan atau update parameter 'limit'
        window.location.href = url.toString(); // Redirect ke URL baru
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (
            {{ $errors->has('sub_uraian_nama.') || $errors->has('sub_uraian_tipe') ? 'true' : 'false' }}
        ) {
            var addsuburaianModal = new bootstrap.Modal(document.getElementById('addsuburaian'));
            addsuburaianModal.show();
        }
        // Check and show the editlayanan modal if there are errors for edit layanan
        if (
            {{ $errors->has('edit_sub_uraian_nama') || $errors->has('edit_sub_uraian_tipe') | $errors->has('edit_uraian_id') ? 'true' : 'false' }}
        ) {
            var editsuburaianModal = new bootstrap.Modal(document.getElementById('editsuburaian'));
            var url = localStorage.getItem('Url');
            editsuburaianModal.show();
            $('#editsuburaianForm').attr('action', url);

            console.log(@json($errors->all()));
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var suburaianId = this.getAttribute('data-id');
                var suburaiannama = this.getAttribute('data-nama');
                var suburaiantipe = this.getAttribute('data-tipe');
                var uraian = this.getAttribute('data-uraian');
                var actionUrl = this.getAttribute('data-url');
                localStorage.setItem('Url', actionUrl);

                if (suburaiannama) {
                    var namaParts = suburaiannama.split('/'); // Pecah berdasarkan "/"

                    console.log('Bagian-bagian dalam data-nama:');
                    for (var i = 0; i < namaParts.length; i++) {
                        console.log('Bagian ' + (i + 1) + ':', namaParts[i]);
                    }
                }
                console.log(suburaiannama);

                $('#edit-id').val(suburaianId);
                $('#edit-sub-uraian-nama').val(suburaiannama);
                $('#edit-sub-uraian-tipe').val(suburaiantipe);
                $('#edit-uraian-id').val(uraian);

                // Atur action form untuk update
                $('#editsuburaianForm').attr('action', actionUrl);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Ketika tombol delete diklik
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                var suburaianId = this.getAttribute('data-id');
                var suburaianDeleteUrl = this.getAttribute('data-url');

                // Atur action form untuk delete
                document.getElementById('deletesuburaianForm').setAttribute('action',
                    suburaianDeleteUrl);
            });
        });
    });
</script>
