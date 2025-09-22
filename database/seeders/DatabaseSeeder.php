<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Muhammad Arif Muntaha',
            'email' => 'marifmuntaha@gmail.com',
            'username' => 'marifmuntaha',
            'password' => Hash::make('password'),
            'phone' => '6282229366506',
            'role' => '1',
        ]);
        $this->call(LadderDatabaseSeeder::class);
        $this->call(LevelDatabaseSeeder::class);
        $this->call(MajorDatabaseSeeder::class);
        $this->call(YearDatabaseSeeder::class);
        $this->call(InstitutionDatabaseSeeder::class);
    }
}
