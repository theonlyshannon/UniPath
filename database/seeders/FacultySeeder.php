<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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

        foreach ($faculties as $faculty) {
            Faculty::factory()->create([
                'name' => $faculty
            ]);
        }
    }
}
