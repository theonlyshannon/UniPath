<header class="main-header sticky-header sticky-header--normal">
    <div class="container-fluid">
        <div class="main-header__inner">
            <div class="main-header__logo logo-retina">
                <a href="index.html">
                    <img src="assets/images/logo-dark.png" alt="eduhive HTML" width="209">
                </a>
            </div>
            <div class="main-header__right">
                <nav class="main-header__nav main-menu">
                    <ul class="main-menu__list">
                        <li>
                            <a class="nav-link {{ request()->routeIs('app.dashboard') ? 'active' : '' }}" href="{{ route('app.dashboard') }}">Home</a>
                        </li>
                        <li class="scrollToLink"><a href="#about">About</a></li>
                        <li class="scrollToLink">
                            <a class="nav-link {{ request()->routeIs('app.course.index') ? 'active' : '' }}" href="{{ route('app.course.index') }}">Kelas</a>
                        </li>
                        <li class="scrollToLink"><a href="#testimonials">Testimonials</a></li>
                        <li class="scrollToLink"><a href="#instructors">Instructors</a></li>
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
                <a href="contact.html" class="main-header__btn eduhive-btn eduhive-btn--border">
                    <span>Apply now</span>
                    <span class="eduhive-btn__icon">
                        <span class="eduhive-btn__icon__inner"><i class="icon-right-arrow"></i></span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</header>
