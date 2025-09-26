<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LadderDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $majors = collect([
            ['name' => 'Raudhatul Atfal', 'alias' => 'RA'],
            ['name' => 'Madrasah Ibtidaiyah', 'alias' => 'MI'],
            ['name' => 'Madrasah Tsanawiyah', 'alias' => 'MTs'],
            ['name' => 'Madrasah Aliyah', 'alias' => 'MA'],
        ]);

        $majors->map(function ($major) {
            return DB::table('master_ladders')->insert($major);
        });
    }
}
