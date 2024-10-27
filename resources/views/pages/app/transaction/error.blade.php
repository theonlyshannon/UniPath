<!-- resources/views/pages/app/transaction/error.blade.php -->

<x-layouts.app title="Transaksi Gagal">
    <section class="transaction-error">
        <div class="container">
            <h1 class="text-center">Transaksi Gagal</h1>
            <p class="text-center">Maaf, terjadi kesalahan dalam memproses transaksi Anda.</p>
            @if(session('error'))
                <p class="text-center text-danger">{{ session('error') }}</p>
            @endif
            <div class="text-center">
                <a href="{{ route('app.course.index') }}" class="btn btn-primary">Kembali ke Daftar Kelas</a>
            </div>
        </div>
    </section>
</x-layouts.app>
