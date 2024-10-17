<nav class="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('') }}" class="sidebar-brand" width="40">
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ request()->is('admin/dashboard') ? ' active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('admin/example') ? ' active' : '' }}">
                <a href="{{ route('admin.example.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Example</span>
                </a>
            </li>

            @can('account-management')
            <li class="nav-item {{ request()->is('admin/mentor*', 'admin/writer*', 'admin/student*', 'admin/role*') ? ' active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#account-management" role="button"
                    aria-expanded="{{ request()->is('admin/mentor*', 'admin/writer*', 'admin/student*', 'admin/role*') ? 'true' : 'false' }}">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Manajemen Akun</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('admin/mentor*', 'admin/writer*', 'admin/student*', 'admin/role*') ? 'show' : '' }}"
                    id="account-management">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.student.index') }}" class="nav-link {{ request()->is('admin/student*') ? ' active' : '' }}">
                                Student
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->is('admin/role*') ? ' active' : '' }}">
                                Role
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan
        </ul>
    </div>
</nav>



<li class="nav-item {{ request()->is('admin/mentor') ? ' active' : '' }}">
    <a href="{{ route('admin.mentor.index') }}" class="nav-link">
        <i class="link-icon" data-feather="list"></i>
        <span class="link-title">mentor</span>
    </a>
</li>

<li class="nav-item {{ request()->is('admin/roles') ? ' active' : '' }}">
    <a href="{{ route('admin.roles.index') }}" class="nav-link">
        <i class="link-icon" data-feather="list"></i>
        <span class="link-title">roles</span>
    </a>
</li>
