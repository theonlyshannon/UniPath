<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseCategory>
 */
class CourseCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $courseCategories = [
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'Matematika',
            'Biollogi',
            'Fisika',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($courseCategories),
        ];
    }
}
