<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class IndexController extends Controller
{
    public function index(){
    	// get all features products
    	$featureProductsCount = Product::where(['is_featured'=>'Yes', 'status'=>1])->count();
    	$featuredItems = Product::where(['is_featured'=>'Yes', 'status'=>1])->get()->toArray();
    	$featuredChunk = array_chunk($featuredItems, 4);
    	// get new products
    	$newProducts = Product::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get()->toArray();
    	/*dd($newProducts); die;*/
    	$page_name = "home";
    	return view('layouts.front_layouts.home.home_content')->with(compact('page_name', 'featureProductsCount', 'featuredChunk', 'newProducts'));
    }
}
