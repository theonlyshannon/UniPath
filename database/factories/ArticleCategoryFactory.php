<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleCategory>
 */
class ArticleCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $articleCategories = [
            'Laravel',
            'Vue.js',
            'React',
            'Node.js',
            'Tailwind CSS',
            'Alpine.js',
            'Inertia.js',
            'Livewire',
            'Jetstream',
            'Fortify',
            'Sail',
            'Nova',
            'Horizon',
            'Echo',
            'Dusk',
            'Sanctum',
            'Passport',
            'Scout',
            'Socialite',
            'Telescope',
            'Vapor',
            'Forge',
            'Envoyer',
            'Envoy',
            'Mix',
            'Valet',
            'Homestead',
            'Lumen',
            'Spark',
            'Cashier',
            'Envoy',
            'Breeze',
            'Tinker',
            'Artisan',
            'Swoole',
            'Octane',
            'Voyager',
            'Vapor',
            'Voyager',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($articleCategories),
            'slug' => $this->faker->unique()->slug,
        ];
    }
}
