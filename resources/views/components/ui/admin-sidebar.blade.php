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

            @can('account-management')
                <li
                    class="nav-item {{ request()->is('admin/mentor*', 'admin/writer*', 'admin/student*', 'admin/role*') ? ' active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#account-management" role="button"
                        aria-expanded="{{ request()->is('admin/mentor*', 'admin/writer*', 'admin/student*', 'admin/role*') ? 'true' : 'false' }}">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">Manajemen Akun</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ request()->is('admin/mentor*', 'admin/writer*', 'admin/student*', 'admin/role*') ? 'show' : '' }}"
                        id="account-management">
                        <ul class="nav sub-menu">
                            @can('student-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.student.index') }}"
                                        class="nav-link {{ request()->is('admin/student*') ? ' active' : '' }}">
                                        Student
                                    </a>
                                </li>
                            @endcan

                            @can('role-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.role.index') }}"
                                        class="nav-link {{ request()->is('admin/role*') ? ' active' : '' }}">
                                        Role
                                    </a>
                                </li>
                            @endcan

                            @can('permission-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.permission.index') }}"
                                        class="nav-link {{ request()->is('admin/permission*') ? ' active' : '' }}">
                                        Permission
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
            @endcan

            @can('article-management')
                <li class="nav-item {{ request()->is('admin/category*', 'admin/tag*') ? ' active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#article-management" role="button"
                        aria-expanded="{{ request()->is('admin/category*', 'admin/tag*') ? 'true' : 'false' }}">
                        <i class="link-icon" data-feather="file-text"></i>
                        <span class="link-title">Manajemen Artikel</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ request()->is('admin/category*', 'admin/tag*') ? 'show' : '' }}"
                        id="article-management">
                        <ul class="nav sub-menu">

                            @can('article-category-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.article-category.index') }}"
                                        class="nav-link {{ request()->is('admin/category*') ? ' active' : '' }}">
                                        Kategori Artikel
                                    </a>
                                </li>
                            @endcan

                            @can('article-tag-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.article-tag.index') }}"
                                        class="nav-link {{ request()->is('admin/tag*') ? ' active' : '' }}">
                                        Tag Artikel
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan


        </ul>
    </div>
</nav>
