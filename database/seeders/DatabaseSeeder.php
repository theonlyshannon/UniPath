<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $env = config('app.env');

        $this->call([
            RoleSeeder::class,
            AccountSeeder::class,
        ]);

        if ($env === 'local') {
            $this->call([
                WriterSeeder::class,
                ArticleTagSeeder::class,
                ArticleCategorySeeder::class,
                ArticleSeeder::class,

                UniversitySeeder::class,
                FacultySeeder::class,
                CourseCategorySeeder::class
            ]);
        }

    }
}
