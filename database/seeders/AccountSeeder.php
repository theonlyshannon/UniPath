<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@unipath-academy.sch.id',
            'password' => bcrypt('UnipathAdmin12'),
        ])->assignRole('admin');

        // User::create([
        //     'email' => 'student@gmail.com',
        //     'password' => bcrypt('password'),
        // ])->assignRole('student');
    }
}
