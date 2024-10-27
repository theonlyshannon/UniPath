<!-- resources/views/admin/transaction/index.blade.php -->

<x-layouts.admin title="Transaction Management">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item " aria-current="page">Manajemen Transaksi</li>
        <li class="breadcrumb-item active" aria-current="page">Transactions</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <!-- Jika tidak diperlukan, Anda bisa menghapus slot header -->
                <x-slot name="header">
                    <!-- Contoh: Tidak ada tombol tambah transaksi -->
                </x-slot>
                <x-ui.datatables>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Transaction Code</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Transaction Date</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->transaction_code }}</td>
                                <td>{{ $transaction->user->student->name ?? 'Unknown' }}</td>
                                <td>Rp{{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                <td>
                                    <select class="form-select" onchange="updateTransactionStatus('{{ $transaction->id }}', this)">
                                        <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ $transaction->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="failed" {{ $transaction->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                        <option value="expired" {{ $transaction->status == 'expired' ? 'selected' : '' }}>Expired</option>
                                        <option value="canceled" {{ $transaction->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    </select>
                                </td>
                                <td>{{ $transaction->transaction_date }}</td>
                                <td>
                                    <x-ui.base-button color="primary" type="button"
                                        href="{{ route('admin.transaction.show', $transaction->id) }}">
                                        Detail
                                    </x-ui.base-button>
                                    @can('transaction-edit')
                                        <x-ui.base-button color="warning" type="button"
                                            href="{{ route('admin.transaction.edit', $transaction->id) }}">
                                            Edit
                                        </x-ui.base-button>
                                    @endcan
                                    @can('transaction-delete')
                                        <form action="{{ route('admin.transaction.destroy', $transaction->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-ui.base-button color="danger" type="submit"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                Hapus
                                            </x-ui.base-button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-ui.datatables>
            </x-ui.base-card>
        </div>
    </div>

    @push('plugin-scripts')
    <script>
        function updateTransactionStatus(transactionId, selectElement) {
            const status = selectElement.value;
            fetch(`/admin/transaction/${transactionId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Berhasil mengubah status transaksi');
                    } else {
                        alert('Gagal mengupdate status transaksi');
                        // Mengembalikan nilai dropdown ke status sebelumnya jika gagal
                        selectElement.value = selectElement.getAttribute('data-prev');
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan');
                    // Mengembalikan nilai dropdown ke status sebelumnya jika terjadi error
                    selectElement.value = selectElement.getAttribute('data-prev');
                })
                .finally(() => {
                    // Memperbarui atribut data-prev dengan nilai terbaru
                    selectElement.setAttribute('data-prev', status);
                });
        }

        // Menambahkan atribut data-prev pada semua select saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('.form-select');
            selects.forEach(function(select) {
                const currentStatus = select.value;
                select.setAttribute('data-prev', currentStatus);
            });
        });
    </script>
@endpush

</x-layouts.admin>