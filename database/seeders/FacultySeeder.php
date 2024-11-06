<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use App\Models\University;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $universities = University::all();

        $faculties = [
            'Teknik Komputer',
            'Ilmu Komputer',
            'SNBT',
            'Ekonomi',
        ];

        foreach ($universities as $university) {
            foreach ($faculties as $facultyName) {
                Faculty::create([
                    'id' => (string) Str::uuid(),
                    'university_id' => $university->id,
                    'name' => $facultyName,
                    'description' => "Deskripsi untuk {$facultyName} di {$university->name}.",
                ]);
            }
        }
    }
}
