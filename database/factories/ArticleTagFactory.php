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
            'Universitas',
            'Beasiswa',
            'Jurusan',
            'Tips',
            'SBMPTN',
            'Luar Negeri',
            'Terbaik',
            'Persiapan',
            'Wawancara',
            'Menulis Esai',
            'Studi',
            'Double Degree',
            'Portofolio',
            'Karir',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($articleTags),
            'slug' => $this->faker->unique()->slug,
        ];
    }
}
