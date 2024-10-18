<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleTag>
 */
class ArticleTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $articleTags = [
            'Technology',
            'Programming',
            'Web Development',
            'Mobile Development',
            'Desktop Development',
            'Game Development',
            'Software Development',
            'Database',
            'Cloud Computing',
            'DevOps',
            'Cybersecurity',
            'Machine Learning',
            'Artificial Intelligence',
            'Internet of Things',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($articleTags),
            'slug' => $this->faker->unique()->slug,
        ];
    }
}
