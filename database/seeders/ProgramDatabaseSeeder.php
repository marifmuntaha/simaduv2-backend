<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = collect([
            ['yearId' => 2, 'institutionId' => 3, 'name' => 'Sains', 'alias' => 'SNS'],
            ['yearId' => 2, 'institutionId' => 3, 'name' => 'Tahfidz', 'alias' => 'TFZ'],
            ['yearId' => 2, 'institutionId' => 3, 'name' => 'Kitab', 'alias' => 'KTB'],
            ['yearId' => 2, 'institutionId' => 3, 'name' => 'Reguler', 'alias' => 'RGL'],
        ]);

        $programs->map(function ($program) {
            DB::table('master_programs')->insert($program);
        });
    }
}
