<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleCategory>
 */
class ArticleCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $articleCategories = [
            'Panduan Universitas',
            'Beasiswa',
            'Jurusan Kuliah',
            'Universitas Terbaik',
            'Tips Ujian',
            'Kuliah Luar',
            'Wawancara Beasiswa',
            'Studi Favorit',
            'Simulasi SBMPTN',
            'Esai Beasiswa',
            'Karir Pendidikan',
            'Portofolio Beasiswa',
            'Kehidupan Kampus',
            'Universitas Negeri',
            'Pendaftaran Internasional',
            'Kuliah Kerja',
            'Persiapan Psikotes',
            'Double Degree',
            'Beasiswa Penuh',
            'Rekomendasi Beasiswa',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($articleCategories),
            'slug' => $this->faker->unique()->slug,
        ];
    }
}
