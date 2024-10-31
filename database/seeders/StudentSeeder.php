<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            $randomDate = Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59));

            $student = User::create([
                'email' => 'student' . $i . '@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ])->assignRole('student');

            $student->student()->create([
                'username' => 'student' . $i,
                'name' => 'Student ' . $i,
                'gender' => $i % 2 == 0 ? 'male' : 'female',
                'phone' => '628123456' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'city' => 'Jakarta',
                'created_at' => $randomDate, 
                'updated_at' => $randomDate,
            ]);
        }
    }
}
