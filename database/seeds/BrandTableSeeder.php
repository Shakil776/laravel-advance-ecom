<?php

use Illuminate\Database\Seeder;
use App\Brand;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecords = [
        	['id'=>1, 'brand_name'=>'Daraz', 'status'=>1],
        	['id'=>2, 'brand_name'=>'Priyo Shop', 'status'=>1],
        	['id'=>3, 'brand_name'=>'Zara Fashion', 'status'=>1],
        	['id'=>4, 'brand_name'=>'Ajker Deal', 'status'=>1],
        	['id'=>5, 'brand_name'=>'E-valy', 'status'=>1]
        ];

        Brand::insert($brandRecords);
    }
}
