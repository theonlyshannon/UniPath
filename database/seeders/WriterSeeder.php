<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class WriterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $writer = User::create([
            'email' => 'writer@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('writer');

        $writer->writer()->create([
            'username' => 'writer',
            'name' => 'Writer',
        ]);
    }
}
