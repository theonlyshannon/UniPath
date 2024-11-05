
<header class="main-header sticky-header sticky-header--normal">
    <div class="container-fluid">
        <div class="main-header__inner">
            <div class="main-header__logo logo-retina">
                <a href="index.html">
                    <img src="{{ asset('admin/assets/images/Unipath.png') }}" alt="eduhive HTML" width="135">
                </a>
            </div><!-- /.main-header__logo -->
            <div class="main-header__right">
                <nav class="main-header__nav main-menu">
                    <ul class="main-menu__list">
                        <li>
                            <a class="nav-link {{ request()->routeIs('app.dashboard') ? 'active' : '' }}" href="{{ route('app.dashboard') }}">Home</a>
                        </li>
                        <li>
                            <a class="nav-link {{ request()->routeIs('app.about') ? 'active' : '' }}" href="{{ route('app.about') }}">About</a>
                        </li>
                        <li class="scrollToLink">
                            <a class="nav-link {{ request()->routeIs('app.course.index') ? 'active' : '' }}" href="{{ route('app.course.index') }}">Kelas</a>
                        </li>
                        <li class="scrollToLink">
                            <a class="nav-link {{ request()->routeIs('app.article.index') ? 'active' : '' }}" href="{{ route('app.article.index') }}">Artikel</a>
                        </li>
                    </ul>
                </nav>
                <div class="mobile-nav__btn mobile-nav__toggler">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <a href="{{ route('app.cart.index') }}" class="main-header__cart">
                    <i class="icon-cart" aria-hidden="true"></i>
                    <span class="sr-only">Shopping Cart</span>
                </a>

                @php
                // Cek apakah pengguna sudah login dan merupakan student
                $student = Auth::check() ? \App\Models\Student::where('user_id', Auth::id())->first() : null;
            @endphp

            @if ($student)
                <!-- Tampilkan nama student dengan dropdown saat hover -->
                <li class="dropdown">
                    <a href="#" class="main-header__btn eduhive-btn eduhive-btn--border">
                        <span>{{ $student->name ?? Auth::user()->email }}</span>
                        <span class="eduhive-btn__icon">
                            <span class="eduhive-btn__icon__inner"><i class="icon-right-arrow"></i></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admin.dashboard') }}" class="dropdown-item">Dashboard</a></li>
                        <li>
                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log Out
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @else
                <!-- Tampilkan tombol Log In untuk guest atau admin -->
                <a href="{{ route('login') }}" class="main-header__btn eduhive-btn eduhive-btn--border">
                    <span>Log In</span>
                    <span class="eduhive-btn__icon">
                        <span class="eduhive-btn__icon__inner"><i class="icon-right-arrow"></i></span>
                    </span>
                </a>
            @endif
            </div>
        </div><!-- /.main-header__inner -->
    </div><!-- /.container-fluid -->
</header><!-- /.main-header -->

<!-- Tambahkan script Bootstrap jika belum ada -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
