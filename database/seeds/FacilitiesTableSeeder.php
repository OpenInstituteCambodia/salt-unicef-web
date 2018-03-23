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
    }
}
