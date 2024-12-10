<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ 'PT' }}</a>
            <a href="#" class="simple-text logo-normal">{{ 'PERUSAHAAN' }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="fas fa-tachometer-alt"></i> <!-- Ikon Dashboard -->
                    <p>{{ 'Dashboard' }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#example"
                    aria-expanded="{{ in_array($pageSlug, ['profile', 'users', 'roles']) ? 'true' : 'false' }}"
                    class="{{ in_array($pageSlug, ['profile', 'users', 'roles']) ? '' : 'collapsed' }}">
                    <i class="fas fa-users-cog"></i> <!-- Ikon User Configurasi -->
                    <span class="nav-link-text">{{ 'User Configurasi' }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ in_array($pageSlug, ['profile', 'users', 'roles']) ? 'show' : '' }}"
                    id="example">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit') }}">
                                <i class="fas fa-user"></i> <!-- Ikon User Profile -->
                                <p>{{ 'User Profile' }}</p>
                            </a>
                        </li>
                        @if (auth()->user()->role_id == 1)
                            <li @if ($pageSlug == 'users') class="active " @endif>
                                <a href="{{ route('user.index') }}">
                                    <i class="fas fa-users"></i> <!-- Ikon User Management -->
                                    <p>{{ 'User Management' }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'roles') class="active " @endif>
                                <a href="{{ route('role.index') }}">
                                    <i class="fas fa-user-tag"></i> <!-- Ikon Role Management -->
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
                    <i class="fas fa-fire-extinguisher"></i> <!-- Ikon Proses APAR -->
                    <span class="nav-link-text">{{ 'PROSES APAR' }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ in_array($pageSlug, ['lapor_apar', 'input_apar', 'lihat_apar', 'menu_approve']) ? 'show' : '' }}"
                    id="apar_sidebar">
                    <ul class="nav pl-4">
                        @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                            <li @if ($pageSlug == 'lapor_apar') class="active " @endif>
                                <a href="{{ route('apar.index') }}">
                                    <i class="fas fa-file-alt"></i> <!-- Ikon Laporan Apar -->
                                    <p>{{ 'Laporan Apar' }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'menu_approve') class="active " @endif>
                                <a href="{{ route('apar.approve') }}">
                                    <i class="fas fa-check-circle"></i> <!-- Ikon Approve Apar -->
                                    <p>{{ 'Approve Apar' }}</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                            <li @if ($pageSlug == 'input_apar') class="active " @endif>
                                <a href="{{ route('apar.create') }}">
                                    <i class="fas fa-plus-circle"></i> <!-- Ikon Input Apar -->
                                    <p>{{ 'Input Apar' }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'lihat_apar') class="active " @endif>
                                <a href="{{ route('apar.riwayat') }}">
                                    <i class="fas fa-history"></i> <!-- Ikon Riwayat Apar -->
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
                        <i class="fas fa-database"></i> <!-- Ikon Data APAR -->
                        <span class="nav-link-text">{{ 'DATA APAR' }}</span>
                        <b class="caret mt-1"></b>
                    </a>
                    <div class="collapse {{ in_array($pageSlug, ['manage_suburaian', 'manage_uraian']) ? 'show' : '' }}"
                        id="manage_sidebar">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'manage_uraian') class="active " @endif>
                                <a href="{{ route('uraian.index') }}">
                                    <i class="fas fa-tasks"></i> <!-- Ikon Manage Uraian -->
                                    <p>{{ 'Manage Uraian' }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'manage_suburaian') class="active " @endif>
                                <a href="{{ route('suburaian.index') }}">
                                    <i class="fas fa-list-ul"></i> <!-- Ikon Manage Sub Uraian -->
                                    <p>{{ 'Manage Sub Uraian' }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>
