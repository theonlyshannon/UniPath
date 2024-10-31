<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use App\Models\TransactionDetail;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Transaction::factory(15)->create()->each(function ($transaction) {
            $transaction->created_at = Carbon::now()->subDays(rand(1, 30));
            $transaction->save();

            $details = TransactionDetail::factory(rand(1, 3))->create([
                'transaction_id' => $transaction->id,
            ]);

            $totalAmount = $details->sum(function ($detail) {
                return $detail->price * $detail->quantity;
            });

            $transaction->update(['amount' => $totalAmount]);
        });

        Transaction::factory(5)->create([
            'created_at' => now(),
        ])->each(function ($transaction) {
            $details = TransactionDetail::factory(rand(1, 3))->create([
                'transaction_id' => $transaction->id,
            ]);

            $totalAmount = $details->sum(function ($detail) {
                return $detail->price * $detail->quantity;
            });

            $transaction->update(['amount' => $totalAmount]);
        });
    }
}
