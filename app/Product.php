<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo('App\Category', 'category_id')->select('id', 'category_name', 'category_url');
    }

    public function section(){
        return $this->belongsTo('App\Section', 'section_id')->select('id', 'name');
    }

    public function brand(){
        return $this->belongsTo('App\Brand', 'brand_id')->select('id', 'brand_name');
    }

    public function attributes() {
    	return $this->hasMany('App\ProductAttribute', 'product_id');
    }

    public function images() {
    	return $this->hasMany('App\ProductImage', 'product_id');
    }

    // product filters
    public static function productFilters(){
        $productFilters['fabricArray'] = ['Cotton', 'Polycotton', 'Linen', 'Jersey', 'Silk', 'Satin', 'Pure Wool'];
        $productFilters['patternArray'] = ['Checked', 'Plain', 'Printed', 'Self', 'Solid'];
        $productFilters['sleeveArray'] = ['Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless'];
        $productFilters['fitArray'] = ['Regular', 'Slim'];
        return $productFilters;
    }

    // get product discount and category discount
    public static function getDiscountedPrice($product_id){
        $proDetails = Product::where('id', $product_id)->select('category_id', 'product_price', 'product_discount')->first()->toArray();
        $catDetails = Category::where('id', $proDetails['category_id'])->select('category_discount')->first()->toArray();

        if ($proDetails['product_discount'] > 0) {
            // if product discount is added
            $discountedPrice = $proDetails['product_price'] - ($proDetails['product_price'] * $proDetails['product_discount'] / 100);
        }else if($catDetails['category_discount'] > 0){
            // if product discount is not added and category discount is added
            $discountedPrice = $proDetails['product_price'] - ($proDetails['product_price'] * $catDetails['category_discount'] / 100);
        }else{
            $discountedPrice = 0;
        }
        return $discountedPrice;
    } 

    // get discounted attribute price for details page size wise discount price
    public static function getDiscountedAttrPrice($product_id, $size){
        $proAttrPrice = ProductAttribute::where(['product_id'=> $product_id, 'size'=> $size])->first()->toArray();
        $proDetails = Product::where('id', $product_id)->select('category_id', 'product_discount')->first()->toArray();
        $catDetails = Category::where('id', $proDetails['category_id'])->select('category_discount')->first()->toArray();

        if ($proDetails['product_discount'] > 0) {
            // if product discount is added
            $final_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $proDetails['product_discount'] / 100);
            $discount = $proAttrPrice['price'] - $final_price;
        }else if($catDetails['category_discount'] > 0){
            // if product discount is not added and category discount is added
            $final_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $catDetails['category_discount'] / 100);
            $discount = $proAttrPrice['price'] - $final_price;
        }else{
            $final_price = $proAttrPrice['price'];
            $discount = 0;
        }
        return ['product_price'=>$proAttrPrice['price'], 'final_price'=>$final_price, 'discount'=> $discount];
    }
}
