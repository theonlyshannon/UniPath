<?php

namespace Database\Factories;

use App\Models\TransactionDetail;
use App\Models\Transaction;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionDetail>
 */
class TransactionDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TransactionDetail::class;

    public function definition()
    {
        return [
            'transaction_id' => Transaction::factory(),
            'course_id' => Course::inRandomOrder()->first()->id,
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->randomFloat(2, 10, 200), 
        ];
    }
}
