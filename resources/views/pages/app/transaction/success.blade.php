<!-- resources/views/pages/app/transaction/success.blade.php -->

<x-layouts.app title="Transaksi Berhasil">
    <section class="transaction-success">
        <div class="container">
            <h1 class="text-center">Transaksi Berhasil</h1>
            <p class="text-center">Terima kasih, transaksi Anda telah berhasil diproses.</p>
            <p class="text-center">Anda sekarang dapat mengakses kelas yang telah Anda beli.</p>
            <div class="text-center">
                <a href="{{ route('app.dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>
            </div>
        </div>
    </section>
</x-layouts.app>
