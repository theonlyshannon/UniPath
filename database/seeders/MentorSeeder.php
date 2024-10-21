<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Helpers\ImageHelper\ImageHelper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imageHelper = new ImageHelper();

        $mentor = User::create([
            'email' => 'mentor@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('mentor');

        $mentor->mentor()->create([
            'username' => 'mentor0',
            'name' => 'Mentor',
            'profile_picture' => $imageHelper->createDummyImageWithTextSizeAndPosition(100, 100, 'center', 'center', 'random', 'medium')->store('assets/mentor/profile_picture', 'public'),
            'gender' => 'male',
            'phone' => '08123456789',
            'city' => 'Jakarta',
            'degree' => 'S1 Universitas Genjot Makima',
            'bio' => 'I am an experienced web developer with a passion for teaching.',
        ]);
    }
}
