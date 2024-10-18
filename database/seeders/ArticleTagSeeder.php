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
        ArticleTag::factory()->count(10)->create();
    }
}
