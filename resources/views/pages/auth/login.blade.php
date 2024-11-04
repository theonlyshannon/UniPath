<x-layouts.auth title="Login">
    <section class="login-page section-space">
        <div class="container">
            <div class="row gutter-y-50 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                    <div class="login-page__image">
                        <div class="login-page__image__inner">
                            <img src="{{ asset('app/images/resources/login-1-1.jpg') }}" alt="login">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                    <form action="{{ route('login') }}" method="POST" class="login-page__form">
                        @csrf
                        <div class="login-page__form__inner">
                            <div class="login-page__form__top">
                            <img src="{{ asset('app/images/resources/login-logo-1-1.png') }}" alt="logo" width="167" class="login-page__form__logo">
                                <h3 class="login-page__form__title">Nice to see you again</h3>
                            </div>

                            <div class="login-page__form__wrapp">
                                <div class="login-page__form__input-box">
                                    <label for="email" class="login-page__form__label">Login</label>
                                    <input type="text" id="email" name="email" placeholder="Email" required autofocus>
                                </div>
                                <div class="login-page__form__input-box">
                                    <label for="password" class="login-page__form__label">Password</label>
                                    <div class="login-page__form__input-box__inner">
                                        <input type="password" id="password" name="password" placeholder="Enter password" required>
                                        <i class="toggle-password-icon fa fa-fw fa-eye-slash"></i>
                                    </div>
                                </div>
                                <div class="login-page__form__input-box login-page__form__input-box--3">
                                    <label class="login-page__form__checked-box" for="remember">
                                        <input type="checkbox" name="remember" id="remember">
                                        <span></span>
                                        Remember me
                                    </label>
                                    <a href="" class="login-page__form__forgot">Forgot password?</a>
                                </div>
                                <div class="login-page__form__input-box login-page__form__input-box--4">
                                    <button type="submit" class="login-page__form__btn eduhive-btn eduhive-btn--normal">Sign in</button>
                                </div>
                            </div>

                            <div class="login-page__form__bottom">
                                <p class="login-page__form__register-text">Don’t have an account? <a href="{{ route('register') }}">Sign up now</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.auth>
