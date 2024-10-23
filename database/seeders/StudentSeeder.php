<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student = User::create([
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('student');

        $student->student()->create([
            'username' => 'student0',
            'name' => 'Student',
            'gender' => 'male',
            'occupation_type' => 'student',
            'occupation' => 'Computer Science Student',
            'phone' => '628123456789',
            'city' => 'Jakarta',
        ]);
    }
}
