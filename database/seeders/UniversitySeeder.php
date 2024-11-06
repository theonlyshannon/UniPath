<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $universities = [
            [
                'name' => 'Universitas Indonesia',
                'location' => 'Depok, Jawa Barat',
                'description' => 'Universitas terkemuka di Indonesia dengan berbagai fakultas unggulan.',
            ],
            [
                'name' => 'Institut Teknologi Bandung',
                'location' => 'Bandung, Jawa Barat',
                'description' => 'Institut teknologi terbaik dengan fokus pada inovasi dan penelitian.',
            ],
            [
                'name' => 'Universitas Gadjah Mada',
                'location' => 'Yogyakarta',
                'description' => 'Salah satu universitas tertua dan terbesar di Indonesia.',
            ],
            [
                'name' => 'Universitas Airlangga',
                'location' => 'Surabaya, Jawa Timur',
                'description' => 'Universitas dengan reputasi baik di bidang kesehatan dan ilmu sosial.',
            ],
            [
                'name' => 'Universitas Sebelas Maret',
                'location' => 'Surakarta, Jawa Tengah',
                'description' => 'Universitas dengan beragam fakultas dan program studi.',
            ],
        ];

        foreach ($universities as $uni) {
            University::create([
                'id' => (string) Str::uuid(),
                'name' => $uni['name'],
                'location' => $uni['location'],
                'description' => $uni['description'],
            ]);
        }
    }
}
