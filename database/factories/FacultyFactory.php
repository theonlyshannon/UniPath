<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faculty>
 */
class FacultyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faculties = [
            'Fakultas Kedokteran',
            'Fakultas Hukum',
            'Fakultas Ekonomi dan Bisnis',
            'Fakultas Teknik',
            'Fakultas Ilmu Sosial dan Ilmu Politik',
            'Fakultas Ilmu Komputer',
            'Fakultas Matematika dan Ilmu Pengetahuan Alam (MIPA)',
            'Fakultas Farmasi',
            'Fakultas Psikologi',
            'Fakultas Kesehatan Masyarakat',
            'Fakultas Pertanian',
            'Fakultas Teknik Sipil',
            'Fakultas Teknik Elektro',
            'Fakultas Teknik Mesin',
            'Fakultas Ilmu Budaya',
            'Fakultas Peternakan',
            'Fakultas Kehutanan',
            'Fakultas Perikanan dan Ilmu Kelautan',
            'Fakultas Teknik Informatika',
            'Fakultas Ilmu Pendidikan',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($faculties),
        ];
    }
}
