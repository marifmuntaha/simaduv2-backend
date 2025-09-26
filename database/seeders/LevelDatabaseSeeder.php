<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = collect([
            ['ladderId' => 1, 'name' => '0', 'alias' => '0'],
            ['ladderId' => 2, 'name' => '1', 'alias' => 'I'],
            ['ladderId' => 2, 'name' => '2', 'alias' => 'II'],
            ['ladderId' => 2, 'name' => '3', 'alias' => 'III'],
            ['ladderId' => 2, 'name' => '4', 'alias' => 'IV'],
            ['ladderId' => 2, 'name' => '5', 'alias' => 'V'],
            ['ladderId' => 2, 'name' => '6', 'alias' => 'VI'],
            ['ladderId' => 3, 'name' => '7', 'alias' => 'VII'],
            ['ladderId' => 3, 'name' => '8', 'alias' => 'VIII'],
            ['ladderId' => 3, 'name' => '9', 'alias' => 'XI'],
            ['ladderId' => 4, 'name' => '10', 'alias' => 'X'],
            ['ladderId' => 4, 'name' => '11', 'alias' => 'XI'],
            ['ladderId' => 4, 'name' => '12', 'alias' => 'XII'],
        ]);

        $levels->map(function ($level) {
            DB::table('master_levels')->insert($level);
        });
    }
}
