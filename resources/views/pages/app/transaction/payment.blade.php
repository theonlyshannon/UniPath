<!-- resources/views/pages/app/transaction/payment.blade.php -->

<x-layouts.app title="Pembayaran">
    <section class="payment-section">
        <div class="container">
            <h1 class="text-center">Pembayaran</h1>
            <p class="text-center">Mohon tunggu, Anda akan diarahkan ke halaman pembayaran...</p>

            <!-- Midtrans Snap Script -->
            <script type="text/javascript"
                src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ config('midtrans.client_key') }}"></script>

            <script type="text/javascript">
                document.addEventListener('DOMContentLoaded', function () {
                    snap.pay('{{ $snapToken }}', {
                        onSuccess: function(result){
                            window.location.href = '{{ route('app.transaction.success', ['transaction_code' => $transaction->transaction_code]) }}';
                        },
                        onPending: function(result){
                            window.location.href = '{{ route('app.transaction.success', ['transaction_code' => $transaction->transaction_code]) }}';
                        },
                        onError: function(result){
                            window.location.href = '{{ route('app.transaction.error') }}';
                        },
                        onClose: function(){
                            alert('Anda menutup popup tanpa menyelesaikan transaksi');
                            window.location.href = '{{ route('app.cart.index') }}';
                        }
                    });
                });
            </script>
        </div>
    </section>
</x-layouts.app>
