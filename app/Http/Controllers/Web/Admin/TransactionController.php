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

    /**
     * Display a listing of transactions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $transactions = Transaction::with('user')->orderBy('transaction_date', 'desc')->get();

        return view('pages.admin.transaction-management.index', compact('transactions'));
    }

    /**
     * Display the specified transaction details.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $transaction = Transaction::with('transactionDetails.course', 'user')->findOrFail($id);

        return view('pages.admin.transaction-management.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified transaction.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->middleware('permission:transaction-edit');

        $transaction = Transaction::findOrFail($id);

        return view('pages.admin.transaction-management.edit', compact('transaction'));
    }

    /**
     * Update the specified transaction in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->middleware('permission:transaction-edit');

        $transaction = Transaction::findOrFail($id);

        $validatedData = $request->validate([
            'status' => 'required|in:pending,paid,failed,expired,canceled',
        ]);

        $transaction->update($validatedData);

        return redirect()->route('admin.transaction.index')->with('message', 'Transaction successfully updated');
    }

    /**
     * Remove the specified transaction from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->middleware('permission:transaction-delete');

        $transaction = Transaction::findOrFail($id);

        $transaction->delete();

        return redirect()->route('admin.transaction.index')->with('message', 'Transaction successfully deleted');
    }

    /**
     * Update transaction status via AJAX.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
        $this->middleware('permission:transaction-edit');

        $transaction = Transaction::findOrFail($id);

        $status = $request->input('status');

        // Validate status
        if (!in_array($status, ['pending', 'paid', 'failed', 'expired', 'canceled'])) {
            return response()->json(['success' => false, 'message' => 'Invalid status'], 400);
        }

        $transaction->status = $status;
        $transaction->save();

        return response()->json(['success' => true]);
    }
}
