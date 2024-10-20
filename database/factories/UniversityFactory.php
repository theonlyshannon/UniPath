<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\University>
 */
class UniversityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $universities = [
            'Universitas Indonesia',
            'Universitas Gadjah Mada',
            'Institut Teknologi Bandung',
            'Universitas Airlangga',
            'Universitas Padjadjaran',
            'Universitas Diponegoro',
            'Universitas Brawijaya',
            'Universitas Sebelas Maret',
            'Institut Pertanian Bogor',
            'Universitas Hasanuddin',
            'Universitas Sumatera Utara',
            'Universitas Pendidikan Indonesia',
            'Universitas Negeri Yogyakarta',
            'Institut Teknologi Sepuluh Nopember',
            'Universitas Udayana',
            'Universitas Andalas',
            'Universitas Jember',
            'Universitas Syiah Kuala',
            'Universitas Islam Indonesia',
            'Universitas Riau'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($universities),
            'slug' => $this->faker->unique()->slug,
        ];
    }
}
