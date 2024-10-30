<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleVisitor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ArticleVisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = Article::all();  // Ambil semua artikel yang ada

        // Loop untuk generate visitor secara acak
        for ($i = 0; $i < 200; $i++) {
            $article = $articles->random();  // Pilih artikel secara acak

            // Generate IP visitor acak
            $randomIP = implode('.', [
                rand(100, 255),
                rand(0, 255),
                rand(0, 255),
                rand(1, 255)
            ]);

            // Generate tanggal created_at acak dalam 30 hari terakhir
            $randomDate = Carbon::now()
                ->subDays(rand(1, 30))
                ->setHour(rand(0, 23))
                ->setMinute(rand(0, 59))
                ->setSecond(rand(0, 59));

            // Insert data ke dalam ArticleVisitor
            ArticleVisitor::create([
                'visitor_ip' => $randomIP,
                'article_id' => $article->id,
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);
        }
    }
}
