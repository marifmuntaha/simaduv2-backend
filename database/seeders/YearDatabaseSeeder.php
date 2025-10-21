<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = collect([
            ['name' => '2024/2025', 'description' => 'Tahun Pelajaran 2024/2025', 'active' => false],
            ['name' => '2025/2026', 'description' => 'Tahun Pelajaran 2025/2026', 'active' => true],
            ['name' => '2026/2027', 'description' => 'Tahun Pelajaran 2026/2027', 'active' => false],
        ]);

        $years->map(function ($year) {
            DB::table('master_years')->insert($year);
        });
    }
}
