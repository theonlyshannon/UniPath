<!-- resources/views/admin/transaction/edit.blade.php -->

<x-layouts.admin title="Edit Transaksi">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item " aria-current="page">Manajemen Transaksi</li>
        <li class="breadcrumb-item active" aria-current="page">Edit Transaksi</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <form action="{{ route('admin.transaction.update', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="status">Status Transaksi</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $transaction->status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $transaction->status == 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="expired" {{ $transaction->status == 'expired' ? 'selected' : '' }}>Expired</option>
                            <option value="canceled" {{ $transaction->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </div>

                    <x-ui.base-button color="primary" type="submit">
                        Update Transaksi
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>

</x-layouts.admin>
