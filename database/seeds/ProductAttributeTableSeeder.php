<?php

use Illuminate\Database\Seeder;
use App\ProductAttribute;

class ProductAttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributeRecords = [
        	['id'=>1, 'product_id'=>1, 'size'=>'Small', 'price'=>1500, 'stock'=>10, 'sku'=>'G12250-S', 'status'=>1],
        	['id'=>2, 'product_id'=>1, 'size'=>'Medium', 'price'=>1600, 'stock'=>20, 'sku'=>'G12250-M', 'status'=>1],
        	['id'=>3, 'product_id'=>1, 'size'=>'Large', 'price'=>1700, 'stock'=>10, 'sku'=>'G12250-L', 'status'=>1],
        ];

        ProductAttribute::insert($productAttributeRecords);
    }
}
