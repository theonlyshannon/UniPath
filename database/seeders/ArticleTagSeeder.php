<?php

namespace Database\Seeders;

use App\Models\ArticleTag;
use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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

        foreach ($articleTags as $articleTag) {
            ArticleTag::factory()->create([
                'name' => $articleTag
            ]);
        }
    }
}
