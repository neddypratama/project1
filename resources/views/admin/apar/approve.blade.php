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
                            <h4 class="card-title">Approve Apar</h4>
                        </div>
                        {{-- <div class="col-4 text-right">
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#addrole">
                                Add Role
                            </button>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.alerts.success')
                    @include('admin.alerts.alert')
                    <div class="container-fluid">
                        <form method="GET" action="{{ route('apar.riwayat') }}" class="d-flex w-100">
                            <div class="form-group flex-grow-1 me-2">
                                <input type="text" name="search" class="form-control form-control-sm mt-1"
                                    placeholder="Cari berdasarkan id dan user" value="{{ request()->get('search') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary mt-1"><i
                                        class="tim-icons icon-zoom-split"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="">
                        <table class="table table-responsive-xl " id="">
                            <thead class="text-primary">
                                <tr>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'apar_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            ID Apar
                                            @if ($sortBy === 'apar_id')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'tanggal', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Tanggal Dibuat
                                            @if ($sortBy === 'tanggal')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'user_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Nama Inspektor
                                            @if ($sortBy === 'user_id')
                                                {{ $order === 'asc' ? '🔼' : '🔽' }}
                                            @endif
                                        </span>
                                    </th>
                                    <th scope="col" class="text-center">
                                        <span style="cursor: pointer;"
                                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort_by' => 'status', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}'">
                                            Status
                                            @if ($sortBy === 'status')
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
                                        <td>{{ $d->apar_id }}</td>
                                        <td>{{ $d->tanggal }}</td>
                                        <td>
                                            @foreach ($user as $p)
                                                @if ($p->user_id === $d->user_id)
                                                    {{ $p->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @switch($d->status)
                                                @case('Revisi')
                                                    <div class="rounded bg-warning text-center p-1 fw-bolder" style="color: white">
                                                        {{ $d->status }}</div>
                                                @break

                                                @case('Belum Dicek')
                                                    <div class="rounded bg-danger text-center p-1 fw-bolder" style="color: white">
                                                        {{ $d->status }}</div>
                                                @break

                                                @default
                                                    <div class="rounded bg-success text-center p-1 fw-bolder" style="color: white">
                                                        {{ $d->status }}</div>
                                            @endswitch
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    @switch($d->status)
                                                        @case('Setuju')
                                                            <a class="dropdown-item"
                                                                href="{{ url('apar/acc/' . $d->apar_id) }}">Lihat Apar</a>
                                                        @break

                                                        @case('Belum Dicek')
                                                            <a class="dropdown-item"
                                                                href="{{ url('apar/acc/' . $d->apar_id) }}">Lihat Apar</a>
                                                            <a class="dropdown-item"
                                                                href="{{ url('apar/revisi/' . $d->apar_id) }}">Revisi Apar</a>
                                                            @if (auth()->user()->role_id == 1)
                                                                <a class="dropdown-item approve-button" data-bs-toggle="modal"
                                                                    data-bs-target="#approveModal" data-id="{{ $d->apar_id }}"
                                                                    data-url="{{ url('apar/status/' . $d->apar_id . '/admin') }}">
                                                                    Approve Admin
                                                                </a>
                                                            @endif
                                                        @break

                                                        @case('Setuju Admin')
                                                            <a class="dropdown-item"
                                                                href="{{ url('apar/acc/' . $d->apar_id) }}">Lihat Apar</a>
                                                            @if (auth()->user()->role_id == 2)
                                                                <a class="dropdown-item"
                                                                    href="{{ url('apar/revisi/' . $d->apar_id) }}">Revisi Apar</a>
                                                                <a class="dropdown-item approve-button" data-bs-toggle="modal"
                                                                    data-bs-target="#approveModal" data-id="{{ $d->apar_id }}"
                                                                    data-url="{{ url('apar/status/' . $d->apar_id . '/manager') }}">
                                                                    Approve Management
                                                                </a>
                                                            @endif
                                                        @break

                                                        @case('Revisi')
                                                            <a class="dropdown-item"
                                                                href="{{ url('apar/acc/' . $d->apar_id) }}">Lihat Apar</a>
                                                            <a class="dropdown-item"
                                                                href="{{ url('apar/revisi/' . $d->apar_id) }}">Revisi Apar</a>
                                                            @if (auth()->user()->role_id == 1)
                                                                <a class="dropdown-item approve-button" data-bs-toggle="modal"
                                                                    data-bs-target="#approveModal" data-id="{{ $d->apar_id }}"
                                                                    data-url="{{ url('apar/status/' . $d->apar_id . '/admin') }}">
                                                                    Approve Admin
                                                                </a>
                                                            @endif
                                                        @break

                                                        @default
                                                            <a class="dropdown-item"
                                                                href="{{ url('apar/acc/' . $d->apar_id) }}">Lihat Apar</a>
                                                        @break
                                                    @endswitch
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada apar yang ditemukan
                                            </td>
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

        <div class="modal fade" id="approveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="approveModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel">Approve Apar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin meng-approve Apar ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form id="approveAparForm" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary">Approve</button>
                        </form>
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
            // Ketika tombol approve diklik
            document.querySelectorAll('.approve-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    // Ambil data dari atribut data-*
                    var aparId = this.getAttribute('data-id');
                    var approveUrl = this.getAttribute('data-url');

                    // Atur action form untuk approve
                    document.getElementById('approveAparForm').setAttribute('action', approveUrl);
                });
            });
        });
    </script>
