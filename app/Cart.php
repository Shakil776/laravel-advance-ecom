<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\ProductAttribute;
use Auth;
use Session;

class Cart extends Model
{
    use HasFactory;

    // get user cart products
    public static function cartItems(){
    	if (Auth::check()) {
    		$cartItems = Cart::with(['product'=>function($query){
    			$query->select('id', 'product_name', 'product_code', 'product_color', 'product_price', 'product_main_image', 'product_discount');
    		}])->where(['user_id'=>Auth::user()->id])->get()->toArray();
    	}else{
    		$cartItems = Cart::with(['product'=>function($query){
    			$query->select('id', 'product_name', 'product_code', 'product_color', 'product_price', 'product_main_image', 'product_discount');
    		}])->where(['session_id'=>Session::get('session_id')])->get()->toArray();
    	}
    	return $cartItems;
    }

    // cart product details
    public function product(){
    	return $this->belongsTo('App\Product', 'product_id');
    }

    // get product price depends on size
    /*public static function getProductAttrPrice($p_id, $size){
    	$productAttrPrice = ProductAttribute::where(['product_id'=>$p_id, 'size'=>$size])->select('price')->first()->toArray();
    	return $productAttrPrice['price'];
    }*/
}
