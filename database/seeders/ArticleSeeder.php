<?php

namespace Database\Seeders;

use App\Models\Writer;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use App\Helpers\ImageHelper\ImageHelper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{   
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imageHelper = new ImageHelper();

        for ($i = 0; $i < 10; $i++) {
            $writer = Writer::inRandomOrder()->first();

            $articles = Article::factory()
                ->for($writer)
                ->create([
                    'thumbnail' => $imageHelper->createDummyImageWithTextSizeAndPosition(1920, 1080, 'center', 'center', 'random', 'medium')->store('assets/article/thumbnail', 'public'),
                ]);

            $articles->categories()->attach(ArticleCategory::inRandomOrder()->limit(rand(1, 3))->get());
            $articles->tags()->attach(ArticleTag::inRandomOrder()->limit(rand(1, 3))->get());
        }
    }
}
