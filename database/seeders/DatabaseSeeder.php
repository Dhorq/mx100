<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::create([
        'name'     => 'PT Ridho 123',
        'email'    => 'employer@test.com',
        'password' => bcrypt('password'),
        'role'     => 'employer',
    ]);

    User::create([
        'name'     => 'Dhorq',
        'email'    => 'freelancer@test.com',
        'password' => bcrypt('password'),
        'role'     => 'freelancer',
    ]);
    }
}