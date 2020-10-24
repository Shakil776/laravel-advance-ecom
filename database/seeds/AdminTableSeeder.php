<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
        	[
        		'id' => 2, 
        		'name' => 'Shakil Hossain',
        		'type' => 'sub admin',
        		'mobile' => '01815752377',
        		'email' => 'admin@gmail.com',
        		'password' => Hash::make('123456789'),
        		'image' => '',
        		'status' => 0
        	]
        ];

        DB::table('admins')->insert($adminRecords);
    }
}
