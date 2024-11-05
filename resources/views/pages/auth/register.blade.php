<x-layouts.auth title="Daftar Akun">
    <section class="register-page">
        <div class="container-register d-flex align-items-center justify-content-center" style="height: 100vh;">
            <form action="{{ route('register') }}" method="POST" class="login-page__form">
                @csrf
                <div class="login-page__form__inner">
                    <div class="login-page__form__wrapp">
                        <div class="login-page__form__input-box">
                            <label for="name" class="login-page__form__label">Nama</label>
                            <input type="text" id="name" name="name" placeholder="Nama"
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="login-page__form__input-box">
                            <label for="phone" class="login-page__form__label">Nomor Telepon</label>
                            <input type="text" id="phone" name="phone" placeholder="Nomor Telepon"
                                value="{{ old('phone') }}" required>
                        </div>
                        <div class="login-page__form__input-box">
                            <label for="email" class="login-page__form__label">Email</label>
                            <input type="text" id="email" name="email" placeholder="E-mail address"
                                value="{{ old('email') }}" required>
                        </div>
                        <div class="login-page__form__input-box">
                            <label for="password" class="login-page__form__label">Password</label>
                            <div class="login-page__form__input-box__inner">
                                <input type="password" id="password" name="password" placeholder="Enter password"
                                    class="toggle-password-input" required>
                                <i class="toggle-password-icon fa fa-fw fa-eye-slash" onclick="togglePassword()"></i>
                            </div>
                        </div>
                        <div class="login-page__form__input-box login-page__form__input-box--4">
                            <button type="submit"
                                class="login-page__form__btn eduhive-btn eduhive-btn--normal">Register</button>
                        </div>
                    </div>
                    <div class="login-page__form__bottom">
                        <p class="login-page__form__register-text">Sudah punya akun? <a
                                href="{{ route('login') }}">Masuk</a></p>
                    </div>
                </div>
            </form>
        </div>

        <img src="{{ asset('app/images/shapes/page-header-shape-1.png') }}" alt="shape"
            class="page-header__shape-one">
        <img src="{{ asset('app/images/shapes/page-header-shape-2.png') }}" alt="shape"
            class="page-header__shape-two">

        <div class="page-header__shape-three"></div>
        <div class="page-header__shape-four"></div>
        <img src="{{ asset('app/images/shapes/main-slider-shape-3-2.png') }}" alt="shape"
            class="main-slider-three__shape-one slider-image">
        <div class="main-slider-three__box-one"></div>
        <div class="main-slider-three__box-two"></div>
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
