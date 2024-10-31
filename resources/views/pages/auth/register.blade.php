<x-layouts.app title="Daftar Akun">
    <section class="page-header">
        <div class="container">
            <div class="page-header__content">
                <ul class="eduhive-breadcrumb list-unstyled">
                    <li><span class="eduhive-breadcrumb__icon"><i class="icon-home"></i></span><a href="index.html">Home</a></li>
                    <li><span>Register</span></li>
                </ul><!-- /.eduhive-breadcrumb list-unstyled -->
                <h2 class="page-header__title">Register</h2>
            </div><!-- /.page-header__content -->
        </div><!-- /.container -->
        <img src="assets/images/shapes/page-header-shape-1.png" alt="shape" class="page-header__shape-one">
        <img src="assets/images/shapes/page-header-shape-2.png" alt="shape" class="page-header__shape-two">
        <div class="page-header__shape-three"></div><!-- /.page-header__shape-three -->
        <div class="page-header__shape-four"></div><!-- /.page-header__shape-four -->
    </section><!-- /.page-header -->
    
    <section class="login-page section-space">
        <div class="container">
            <div class="row gutter-y-50 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                    <div class="login-page__image">
                        <div class="login-page__image__inner">
                            <img src="assets/images/resources/login-1-1.jpg" alt="login">
                        </div><!-- /.login-page__image__inner -->
                    </div><!-- /.login-page__image -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                    <form action="{{ route('register') }}" method="POST" class="login-page__form">
                        @csrf <!-- Tambahkan ini untuk mencegah masalah CSRF -->
                        <div class="login-page__form__inner">
                            <div class="login-page__form__top">
                                <img src="assets/images/resources/login-logo-1-1.png" alt="logo" width="167" class="login-page__form__logo">
                                <h3 class="login-page__form__title">Welcome! Register for your account</h3>
                            </div><!-- /.login-page__form__top -->
                            <div class="login-page__form__wrapp">
                                <div class="login-page__form__input-box">
                                    <label for="name" class="login-page__form__label">Nama</label>
                                    <input type="text" id="name" name="name" placeholder="Nama" value="{{ old('name') }}" required>
                                </div>
                                <div class="login-page__form__input-box">
                                    <label for="email" class="login-page__form__label">Email</label>
                                    <input type="text" id="email" name="email" placeholder="E-mail address" value="{{ old('email') }}" required>
                                </div>
                                <div class="login-page__form__input-box">
                                    <label for="password" class="login-page__form__label">Password</label>
                                    <div class="login-page__form__input-box__inner">
                                        <input type="password" id="password" name="password" placeholder="Enter password" class="toggle-password-input" required>
                                        <i class="toggle-password-icon fa fa-fw fa-eye-slash"></i>
                                    </div>
                                </div>
                                <div class="login-page__form__input-box login-page__form__input-box--3">
                                    <label class="login-page__form__checked-box" for="remember-policy">
                                        <input type="checkbox" name="terms" id="remember-policy" required>
                                        <span></span>
                                        I accept company privacy policy.
                                    </label>
                                </div>
                                <div class="login-page__form__input-box login-page__form__input-box--4">
                                    <button type="submit" class="login-page__form__btn eduhive-btn eduhive-btn--normal">Register</button>
                                </div>
                            </div><!-- /.login-page__form__wrapp -->
                            <div class="login-page__form__bottom">
                                <p class="login-page__form__register-text">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                            </div><!-- /.login-page__form__bottom -->
                        </div><!-- /.login-page__form__inner -->
                    </form><!-- /.login-page__form -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row gutter-y-50 -->
        </div><!-- /.container -->
    </section><!-- /.login-page section-space -->
    </x-layouts.app>
    