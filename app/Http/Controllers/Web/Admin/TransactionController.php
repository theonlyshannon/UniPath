<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:transaction-management');
    }

    // Menampilkan daftar transaksi
    public function index()
    {
        $transactions = Transaction::with('user')->orderBy('transaction_date', 'desc')->get();

        return view('pages.admin.transaction-management.index', compact('transactions'));
    }

    // Menampilkan detail transaksi
    public function show($id)
    {
        $transaction = Transaction::with('transactionDetails.course', 'user')->findOrFail($id);

        return view('pages.admin.transaction-management.show', compact('transaction'));
    }

    // Menampilkan form edit transaksi
    public function edit($id)
    {
        $this->middleware('permission:transaction-edit');

        $transaction = Transaction::findOrFail($id);

        return view('pages.admin.transaction-management.edit', compact('transaction'));
    }

    // Memproses update transaksi
    public function update(Request $request, $id)
    {
        $this->middleware('permission:transaction-edit');

        $transaction = Transaction::findOrFail($id);

        $validatedData = $request->validate([
            'status' => 'required|in:pending,paid,failed,expired,canceled',
        ]);

        $transaction->update($validatedData);

        return redirect()->route('admin.transaction.index')->with('message', 'Transaksi berhasil diupdate');
    }

    // Menghapus transaksi
    public function destroy($id)
    {
        $this->middleware('permission:transaction-delete');

        $transaction = Transaction::findOrFail($id);

        $transaction->delete();

        return redirect()->route('admin.transaction.index')->with('message', 'Transaksi berhasil dihapus');
    }

    // Update status transaksi via AJAX
    public function updateStatus(Request $request, $id)
{
    $this->middleware('permission:transaction-edit');

    $transaction = Transaction::findOrFail($id);

    $status = $request->input('status');

    // Validasi status
    if (!in_array($status, ['pending', 'paid', 'failed', 'expired', 'canceled'])) {
        return response()->json(['success' => false, 'message' => 'Status tidak valid'], 400);
    }

    $transaction->status = $status;
    $transaction->save();

    return response()->json(['success' => true]);
}
}
