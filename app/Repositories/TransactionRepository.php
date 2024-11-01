<?php

namespace App\Repositories;

use App\Models\Transaction;
use Carbon\Carbon;
use App\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
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
