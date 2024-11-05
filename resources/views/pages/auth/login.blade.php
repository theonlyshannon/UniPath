<x-layouts.auth title="Login">
    <section class="login-page">
        <div class="container">
            <form action="{{ route('login') }}" method="POST" class="login-page__form">
                @csrf
                <div class="login-page__form__inner">
                    <div class="login-page__form__top">
                        <img src="{{ asset('admin/assets/images/Unipath.png') }}" alt="logo" width="100"
                            class="login-page__form__logo d-flex">
                        <h3 class="login-page__form__title text-center">Nice to see you again</h3>
                    </div>

                    <div class="login-page__form__wrapp">
                        <div class="login-page__form__input-box">
                            <label for="email" class="login-page__form__label">Login</label>
                            <input type="text" id="email" name="email" placeholder="Email" required autofocus>
                        </div>
                        <div class="login-page__form__input-box">
                            <label for="password" class="login-page__form__label">Password</label>
                            <div class="login-page__form__input-box__inner">
                                <input type="password" id="password" name="password" placeholder="Enter password"
                                    required>
                                <i class="toggle-password-icon fa fa-fw fa-eye-slash" onclick="togglePassword()"></i>
                            </div>
                        </div>
                        <div class="login-page__form__input-box login-page__form__input-box--3">
                            <label class="login-page__form__checked-box" for="remember">
                                <input type="checkbox" name="remember" id="remember">
                                <span></span>
                                Remember me
                            </label>
                            <a href="" class="login-page__form__forgot">Lupa Password?</a>
                        </div>
                        <div class="login-page__form__input-box login-page__form__input-box--4">
                            <button type="submit" class="login-page__form__btn eduhive-btn eduhive-btn--normal">Sign
                                in</button>
                        </div>
                    </div>

                    <div class="login-page__form__bottom">
                        <p class="login-page__form__register-text">Belum Punya Akun? <a
                                href="{{ route('register') }}">Sign up sekarang</a></p>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @push('script-app')
        <script>
            function togglePassword() {
                const passwordInput = document.getElementById('password');
                const toggleIcon = document.querySelector('.toggle-password-icon');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                }
            }
        </script>
    @endpush
</x-layouts.auth>
