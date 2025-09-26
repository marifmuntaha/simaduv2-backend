<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $majors = collect([
            ['ladderId' => 1, 'name' => 'Non Jurusan', 'alias' => 'NON'],
            ['ladderId' => 2, 'name' => 'Non Jurusan', 'alias' => 'NON'],
            ['ladderId' => 3, 'name' => 'Non Jurusan', 'alias' => 'NON'],
            ['ladderId' => 4, 'name' => 'Ilmu Pengetahuan Alam', 'alias' => 'IPA'],
            ['ladderId' => 4, 'name' => 'Ilmu Pengetahuan Sosial', 'alias' => 'IPS'],
        ]);

        $majors->map(function ($major) {
            DB::table('master_majors')->insert($major);
        });
    }
}
