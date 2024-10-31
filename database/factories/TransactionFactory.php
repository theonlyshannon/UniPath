<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'transaction_code' => Str::upper(Str::random(10)),
            'user_id' => User::inRandomOrder()->first()->id,
            'amount' => 0,
            'status' => 'paid',
            // 'transaction_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
