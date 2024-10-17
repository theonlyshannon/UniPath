<x-layouts.auth title="Daftar Akun"
    description="Jika anda sudah memiliki akun, silahkan <a href='/login'>masuk</a> disini.">
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="sign__input-wrapper mb-25">
            <h5>Nama</h5>
            <div class="sign__input @error('name') is-invalid @enderror">
                <input type="text" placeholder="Nama" name="name" value="{{ old('name') }}">
                <i class="fal fa-user"></i>
            </div>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="sign__input-wrapper mb-25">
            <h5>Email</h5>
            <div class="sign__input @error('email') is-invalid @enderror">
                <input type="email" placeholder="e-mail address" name="email" value="{{ old('email') }}">
                <i class="fal fa-envelope"></i>
            </div>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="sign__input-wrapper mb-10">
            <h5>Password</h5>
            <div class="sign__input @error('password') is-invalid @enderror">
                <input type="password" placeholder="Password" name="password">
                <i class="fal fa-lock"></i>
            </div>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button class="e-btn w-100 mt-30">
            <span>
                Daftar
            </span>
        </button>
        <div class="sign__new text-center mt-20">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk</a> disini</p>
        </div>
    </form>

    @push('scripts')
        <script>
            $('.e-btn').on('click', function(e) {
                $(this).addClass('e-btn--loading');
                $(this).find('span').text('Loading...');
                setTimeout(() => {
                    $(this).removeClass('e-btn--loading');
                    $(this).find('span').text('Daftar');
                }, 3000);
            });
        </script>
    @endpush
</x-layouts.auth>
