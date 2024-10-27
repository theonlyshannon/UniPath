<!-- resources/views/admin/transaction/show.blade.php -->

<x-layouts.admin title="Detail Transaksi">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item " aria-current="page">Manajemen Transaksi</li>
        <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <h4>Informasi Transaksi</h4>
                <p>Kode Transaksi: {{ $transaction->transaction_code }}</p>
                <p>Pengguna: {{ $transaction->user->student->name ?? 'Unknown' }}</p>
                <p>Total Amount: Rp{{ number_format($transaction->amount, 0, ',', '.') }}</p>
                <p>Status: {{ ucfirst($transaction->status) }}</p>
                <p>Tanggal Transaksi: {{ $transaction->transaction_date }}</p>

                <h4>Detail Kursus</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Course Title</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->transactionDetails as $detail)
                            <tr>
                                <td>{{ $detail->course->title }}</td>
                                <td>Rp{{ number_format($detail->price, 0, ',', '.') }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>Rp{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-ui.base-card>
        </div>
    </div>

</x-layouts.admin>
