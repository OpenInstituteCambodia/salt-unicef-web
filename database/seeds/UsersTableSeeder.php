<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@a.com',
            'password' => bcrypt('123'),
            'role' => '1',

        ]);
        DB::table('users')->insert([
            'name' => 'producer',
            'email' => 'producer@a.com',
            'password' => bcrypt('123'),
            'role' => '2',
            'facility_id' => '1',
        ]);
        DB::table('users')->insert([
            'name' => 'monitor',
            'email' => 'monitor@a.com',
            'password' => bcrypt('123'),
            'role' => '3',
        ]);
    }
}
