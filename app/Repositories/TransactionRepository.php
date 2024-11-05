<?php

namespace App\Repositories;

use App\Models\Transaction;
use Carbon\Carbon;
use App\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getAllTransaction(?int $perPage = null, ?string $search = null)
    {
        $transactions = Transaction::query();

        if (auth()->user()->hasRole('student')) {
            $student = auth()->user()->student;
            if ($student) {
                $transactions->where('user_id', $student->id);
            }
        }

        if ($search) {
            $transactions->where('transaction_code', 'like', '%' . $search . '%');
        }

        if ($perPage) {
            return $transactions->latest()->paginate($perPage);
        }

        return $transactions->latest()->get();
    }
    /**
     * Retrieve monthly transactions that are paid, grouped by course name.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getMonthlyTransaction()
    {
        return Transaction::where('status', 'paid')
            ->whereYear('transactions.created_at', Carbon::now()->year)
            ->whereMonth('transactions.created_at', Carbon::now()->month)
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('courses', 'transaction_details.course_id', '=', 'courses.id')
            ->selectRaw('courses.title as course_name, SUM(transaction_details.quantity) as total_quantity')
            ->groupBy('course_name')
            ->orderBy('total_quantity', 'desc')
            ->get();
    }
}
