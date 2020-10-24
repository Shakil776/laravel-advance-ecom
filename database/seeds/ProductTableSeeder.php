<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            ['id'=>1, 'category_id'=>2, 'section_id'=>1, 'product_name'=>'Test Casual Product', 'product_code'=> 'G12250', 'product_color'=> 'Green', 'product_price'=>550, 'product_discount'=>10, 'product_main_image'=>'', 'product_video'=>'', 'product_description'=>'', 'product_fabric'=>'', 'product_pattern'=>'', 'product_sleeve'=>'', 'product_fit'=>'', 'product_meta_title'=>'', 'product_meta_description'=>'', 'product_meta_keywords'=>'', 'is_featured'=>'No', 'status'=>1],

            ['id'=>2, 'category_id'=>8, 'section_id'=>1, 'product_name'=>'Test Formal Product', 'product_code'=> 'R12858', 'product_color'=> 'Red', 'product_price'=>950, 'product_discount'=>10, 'product_main_image'=>'', 'product_video'=>'', 'product_description'=>'', 'product_fabric'=>'', 'product_pattern'=>'', 'product_sleeve'=>'', 'product_fit'=>'', 'product_meta_title'=>'', 'product_meta_description'=>'', 'product_meta_keywords'=>'', 'is_featured'=>'No', 'status'=>1],
        ];

        Product::insert($productRecords);
    }
}
