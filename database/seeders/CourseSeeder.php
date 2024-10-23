<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Helpers\ImageHelper\ImageHelper;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Mentor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imageHelper = new ImageHelper();

        for ($i = 0; $i < 10; $i++) {
            $mentor = Mentor::inRandomOrder()->first();
            $courseCategory = CourseCategory::inRandomOrder()->first();

            Course::factory()
                ->for($mentor)
                ->for($courseCategory)
                ->create([
                    'thumbnail' => $imageHelper->createDummyImageWithTextSizeAndPosition(1920, 1080, 'center', 'center', 'random', 'medium')->store('assets/course/thumbnail', 'public'),
                ]);
        }
    }
}
