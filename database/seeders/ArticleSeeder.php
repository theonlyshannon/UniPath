<?php

namespace Database\Seeders;

use App\Models\Writer;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use App\Helpers\ImageHelper\ImageHelper;
use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imageHelper = new ImageHelper();

        for ($i = 0; $i < 50; $i++) {  // Tambahkan lebih banyak artikel untuk variasi
            $writer = Writer::inRandomOrder()->first();

            // Generate tanggal acak dalam rentang 90 hari terakhir
            $randomDate = Carbon::now()
                ->subDays(rand(1, 90))  // Rentang 1 hingga 90 hari terakhir
                ->setHour(rand(0, 23))  // Jam acak
                ->setMinute(rand(0, 59))  // Menit acak
                ->setSecond(rand(0, 59));  // Detik acak

            $articles = Article::factory()
                ->for($writer)
                ->create([
                    'thumbnail' => $imageHelper
                        ->createDummyImageWithTextSizeAndPosition(
                            1920, 1080, 'center', 'center', 'random', 'medium'
                        )->store('assets/article/thumbnail', 'public'),

                    // Set created_at dan updated_at dengan tanggal dan waktu acak
                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ]);

            // Attach categories dan tags secara acak
            $articles->categories()->attach(
                ArticleCategory::inRandomOrder()->limit(rand(1, 3))->get()
            );

            $articles->tags()->attach(
                ArticleTag::inRandomOrder()->limit(rand(1, 3))->get()
            );
        }
    }
}
