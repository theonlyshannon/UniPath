<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
        /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->paragraph(),
            'thumbnail' => UploadedFile::fake()->image('thumbnail.jpg'),
            'trailer' => $this->faker->url(),
            'is_favourite' => $this->faker->boolean(),
            'is_active' => $this->faker->boolean(true),
            'price' => $this->faker->numberBetween(10000, 100000),
        ];
    }
}
