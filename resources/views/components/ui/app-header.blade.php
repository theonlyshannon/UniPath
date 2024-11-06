<header class="main-header sticky-header sticky-header--normal">
    <div class="container-fluid">
        <div class="main-header__inner">
            <div class="main-header__logo logo-retina">
                <a href="index.html">
                    <img src="{{ asset('admin/assets/images/Unipath.png') }}" alt="eduhive HTML" width="135">
                </a>
            </div>
            <div class="main-header__right">
                <nav class="main-header__nav main-menu">
                    <ul class="main-menu__list">
                        <li class="{{ request()->routeIs('app.dashboard') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('app.dashboard') }}">Home</a>
                        </li>
                        <li class="{{ request()->routeIs('app.about') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('app.about') }}">About</a>
                        </li>
                        <li class="scrollToLink {{ request()->routeIs('app.course.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('app.course.index') }}">Kelas</a>
                        </li>
                        <li class="scrollToLink {{ request()->routeIs('app.article.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('app.article.index') }}">Artikel</a>
                        </li>
                        <li class="scrollToLink d-block d-md-none {{ request()->routeIs('login') ? 'active' : '' }}">
                            @if (Auth::check())
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log
                                    Out</a>
                            @else
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            @endif
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
                    $student = Auth::check() ? \App\Models\Student::where('user_id', Auth::id())->first() : null;
                @endphp

                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="main-header__btn eduhive-btn eduhive-btn--border">
                            <span>{{ $student->name ?? Auth::user()->email }}</span>
                            <span class="eduhive-btn__icon">
                                <span class="eduhive-btn__icon__inner"><i class="icon-right-arrow"></i></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            @if (Auth::user()->hasRole('admin'))
                                <li><a href="{{ route('admin.dashboard') }}" class="dropdown-item">Dashboard</a></li>
                            @elseif (Auth::user()->hasRole('student'))
                                <li><a href="{{ route('student.dashboard') }}" class="dropdown-item">Dashboard</a></li>
                            @endif
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
                    <li class="dropdown">
                        <a href="{{ route('login') }}" class="main-header__btn eduhive-btn eduhive-btn--border">
                            <span>Log In</span>
                            <span class="eduhive-btn__icon">
                                <span class="eduhive-btn__icon__inner"><i class="icon-right-arrow"></i></span>
                            </span>
                        </a>
                    </li>
                @endif

            </div>
        </div>
    </div>
</header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
