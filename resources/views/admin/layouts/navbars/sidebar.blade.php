<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ 'PT' }}</a>
            <a href="#" class="simple-text logo-normal">{{ 'PERUSAHAAN' }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ 'Dashboard' }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#example"
                    aria-expanded="{{ in_array($pageSlug, ['profile', 'users', 'roles']) ? 'true' : 'false' }}"
                    class="{{ in_array($pageSlug, ['profile', 'users', 'roles']) ? '' : 'collapsed' }}">
                    <i class="tim-icons icon-badge"></i>
                    <span class="nav-link-text">{{ 'User Configurasi' }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse {{ in_array($pageSlug, ['profile', 'users', 'roles']) ? 'show' : '' }}"
                    id="example">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ 'User Profile' }}</p>
                            </a>
                        </li>
                        @if (auth()->user()->role_id == 1)
                            <li @if ($pageSlug == 'users') class="active " @endif>
                                <a href="{{ route('user.index') }}">
                                    <i class="tim-icons icon-bullet-list-67"></i>
                                    <p>{{ 'User Management' }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'roles') class="active " @endif>
                                <a href="{{ route('role.index') }}">
                                    <i class="tim-icons icon-bullet-list-67"></i>
                                    <p>{{ 'Role Management' }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#apar_sidebar"
                    aria-expanded="{{ in_array($pageSlug, ['lapor_apar', 'input_apar', 'lihat_apar', 'menu_approve']) ? 'true' : 'false' }}"
                    class="{{ in_array($pageSlug, ['lapor_apar', 'input_apar', 'lihat_apar', 'menu_approve']) ? '' : 'collapsed' }}">
                    <i class="tim-icons icon-badge"></i>
                    <span class="nav-link-text">{{ 'PROSES APAR' }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ in_array($pageSlug, ['lapor_apar', 'input_apar', 'lihat_apar', 'menu_approve']) ? 'show' : '' }}"
                    id="apar_sidebar">
                    <ul class="nav pl-4">
                        @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                            <li @if ($pageSlug == 'lapor_apar') class="active " @endif>
                                <a href="{{ route('apar.index') }}">
                                    <i class="tim-icons icon-atom"></i>
                                    <p>{{ 'Laporan Apar' }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'menu_approve') class="active " @endif>
                                <a href="{{ route('apar.approve') }}">
                                    <i class="tim-icons icon-bullet-list-67"></i>
                                    <p>{{ 'Approve Apar' }}</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                            <li @if ($pageSlug == 'input_apar') class="active " @endif>
                                <a href="{{ route('apar.create') }}">
                                    <i class="tim-icons icon-atom"></i>
                                    <p>{{ 'Input Apar' }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'lihat_apar') class="active " @endif>
                                <a href="{{ route('apar.riwayat') }}">
                                    <i class="tim-icons icon-bullet-list-67"></i>
                                    <p>{{ 'Riwayat Apar' }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
            @if (auth()->user()->role_id == 1)
                <li>
                    <a data-toggle="collapse" href="#manage_sidebar"
                        aria-expanded="{{ in_array($pageSlug, ['manage_suburaian', 'manage_uraian']) ? 'true' : 'false' }}"
                        class="{{ in_array($pageSlug, ['manage_suburaian', 'manage_uraian']) ? '' : 'collapsed' }}">
                        <i class="tim-icons icon-badge"></i>
                        <span class="nav-link-text">{{ 'DATA APAR' }}</span>
                        <b class="caret mt-1"></b>
                    </a>
                    <div class="collapse {{ in_array($pageSlug, ['manage_suburaian', 'manage_uraian']) ? 'show' : '' }}"
                        id="manage_sidebar">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'manage_uraian') class="active " @endif>
                                <a href="{{ route('uraian.index') }}">
                                    <i class="tim-icons icon-bullet-list-67"></i>
                                    <p>{{ 'Manage Uraian' }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'manage_suburaian') class="active " @endif>
                                <a href="{{ route('suburaian.index') }}">
                                    <i class="tim-icons icon-bullet-list-67"></i>
                                    <p>{{ 'Manage SUb Uraian' }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif


            {{-- <li @if ($pageSlug == 'tables') class="active " @endif>
                <a href="{{ route('pages.tables') }}">
                    <i class="tim-icons icon-puzzle-10"></i>
                    <p>{{ 'Table List' }}</p>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
