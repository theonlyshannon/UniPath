<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseCategories = [
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'Matematika',
            'Biollogi',
            'Fisika',
        ];

        foreach ($courseCategories as $courseCategory) {
            CourseCategory::factory()->create([
                'name' => $courseCategory
            ]);
        }
    }
}
