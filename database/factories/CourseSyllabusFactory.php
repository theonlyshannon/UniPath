<?php

namespace Database\Factories;

use App\Models\CourseSyllabus;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseSyllabus>
 */
class CourseSyllabusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CourseSyllabus::class;

    public function definition()
    {
        return [
            'course_id' => Course::factory(),
            'sort' => $this->faker->numberBetween(1, 10),
            'title' => $this->faker->sentence,
            'file' => $this->faker->fileExtension(['pdf', 'docx']),
            'video' => 'https://www.youtube.com/watch?v=' . Str::random(10),
        ];
    }
}
