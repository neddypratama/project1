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
                    </ul>
                </div>
            </li>

            {{-- <li @if ($pageSlug == 'icons') class="active " @endif>
                <a href="{{ route('pages.icons') }}">
                    <i class="tim-icons icon-atom"></i>
                    <p>{{ 'Icons' }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'tables') class="active " @endif>
                <a href="{{ route('pages.tables') }}">
                    <i class="tim-icons icon-puzzle-10"></i>
                    <p>{{ 'Table List' }}</p>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
