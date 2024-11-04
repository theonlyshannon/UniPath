<?php

namespace Database\Factories;


use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
        /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Course::class;

    public function definition()
    {
        return [
            'mentor_id' => Str::uuid(),
            'course_category_id' => Str::uuid(),
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'price' => $this->faker->randomFloat(2, 10, 200),
            'description' => $this->faker->paragraph,
            'thumbnail' => $this->faker->imageUrl(640, 480, 'education', true, 'Faker'),
            'trailer' => 'https://www.youtube.com/watch?v=' . Str::random(10),
            'is_favourite' => $this->faker->boolean,
            'is_free' => $this->faker->boolean,
            'is_active' => $this->faker->boolean,
        ];
    }
}
