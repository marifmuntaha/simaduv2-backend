<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutions = collect([
            [
                'ladderId' => 1,
                'name' => 'Darul Hikmah Menganti',
                'alias' => 'RADH',
                'nsm' => '1234567890',
                'npsn' => '1234567',
                'address' => 'Jl. Raya Jepara - Bugel KM 07 Ds. Menganti',
                'phone' => '082229366506',
                'email' => 'ra@darul-hikmah.sch.id',
                'website' => 'https://ra.darul-hikmah.sch.id',
                'logo' => ''
            ],
            [
                'ladderId' => 2,
                'name' => 'PTQ Darul Hikmah Menganti',
                'alias' => 'MIDHA',
                'nsm' => '1234567890',
                'npsn' => '1234567',
                'address' => 'Jl. Raya Jepara - Bugel KM 07 Ds. Menganti',
                'phone' => '082229366506',
                'email' => 'mi@darul-hikmah.sch.id',
                'website' => 'https://mi.darul-hikmah.sch.id',
                'logo' => ''
            ],
            [
                'ladderId' => 3,
                'name' => 'Darul Hikmah Menganti',
                'alias' => 'MTSDH',
                'nsm' => '1234567890',
                'npsn' => '1234567',
                'address' => 'Jl. Raya Jepara - Bugel KM 07 Ds. Menganti',
                'phone' => '082229366506',
                'email' => 'mts@darul-hikmah.sch.id',
                'website' => 'https://mts.darul-hikmah.sch.id',
                'logo' => ''
            ],
            [
                'ladderId' => 4,
                'name' => 'Darul Hikmah Menganti',
                'alias' => 'MADH',
                'nsm' => '1234567890',
                'npsn' => '1234567',
                'address' => 'Jl. Raya Jepara - Bugel KM 07 Ds. Menganti',
                'phone' => '082229366506',
                'email' => 'ma@darul-hikmah.sch.id',
                'website' => 'https://ma.darul-hikmah.sch.id',
                'logo' => ''
            ]
        ]);

        $institutions->map(function ($institution) {
            DB::table('institutions')->insert($institution);
        });
    }
}
