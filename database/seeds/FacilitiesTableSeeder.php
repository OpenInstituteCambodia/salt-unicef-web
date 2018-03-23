<?php

use Illuminate\Database\Seeder;

class FacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facilities')->insert([
            'facility_ref_id' => 'F_001',
            'facility_name' => 'Daun Keo Salt Facility',
            'Latitude' => '11.582855',
            'Longitude' => '104.833521',
        ]);
        DB::table('facilities')->insert([
            'facility_ref_id' => 'F_002',
            'facility_name' => 'Village Salt Facility',
            'Latitude' => '11.582855',
            'Longitude' => '104.833521',
        ]);
        DB::table('facilities')->insert([
            'facility_ref_id' => 'F_003',
            'facility_name' => 'Kompot Salt Facility',
            'Latitude' => '11.582855',
            'Longitude' => '104.833521',
        ]);
    }
}
