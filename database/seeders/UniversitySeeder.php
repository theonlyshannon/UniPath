<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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

        foreach ($universities as $university) {
            University::factory()->create([
                'name' => $university
            ]);
        }
    }
}
