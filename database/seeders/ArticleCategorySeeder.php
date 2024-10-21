<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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

        foreach ($articleCategories as $articleCategory) {
            ArticleCategory::factory()->create([
                'name' => $articleCategory
            ]);
        }
    }
}
