<x-layouts.auth title="Masuk">
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-12 col-xl-4 mx-auto">
                <div class="card">
                    <div class="row flex-column-reverse flex-md-row">
                        <div class="col-md-12 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#"
                                    class="noble-ui-logo d-block mb-2">
                                    {{ config('app.name') }}
                                </a>
                                <h5 class="text-muted fw-normal mb-4">Silahkan Login Dengan Akun Anda</h5>
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <x-forms.input type="email" name="email" label="Email" placeholder="Masukkan email"
                                        required autofocus />

                                    <x-forms.input type="password" name="password" label="Password"
                                        placeholder="Masukkan password" required />


                                    <x-ui.base-button type="submit" class="w-100" color="primary">
                                        Masuk
                                    </x-ui.base-button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
