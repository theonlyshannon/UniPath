<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container text-center mt-5">
        <h1>Pembayaran</h1>
        <p>Mohon tunggu, Anda akan diarahkan ke halaman pembayaran...</p>
    </div>

    <!-- Midtrans Snap JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location.href = '{{ route('app.transaction.success', ['transaction_code' => $transaction->transaction_code]) }}';
                },
                onPending: function(result) {
                    window.location.href = '{{ route('app.transaction.pending', ['transaction_code' => $transaction->transaction_code]) }}';
                },
                onError: function(result) {
                    window.location.href = '{{ route('app.transaction.error') }}';
                },
                onClose: function() {
                    alert('Transaksi belum selesai. Anda menutup jendela pembayaran.');
                    window.location.href = '{{ route('app.cart.index') }}';
                }
            });
        });
    </script>
</body>
</html>
