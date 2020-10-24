<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;

class ProductsController extends Controller
{
    //listing page
    public function listing(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            $url = $data['url'];
            $categoryCount = Category::where(['category_url'=>$url, 'status'=>1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::catDetails($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catsId'])->where('status', 1);
                  
                  if (isset($data['sort']) && !empty($data['sort'])) {
                      if ($data['sort'] == 'latest_product') {
                          $categoryProducts->orderBy('id', 'DESC');
                      }elseif ($data['sort'] == 'product_name_a_z') {
                          $categoryProducts->orderBy('product_name', 'ASC');
                      }elseif ($data['sort'] == 'product_name_z_a') {
                          $categoryProducts->orderBy('product_name', 'DESC');
                      }elseif ($data['sort'] == 'price_lowest') {
                          $categoryProducts->orderBy('product_price', 'ASC');
                      }elseif ($data['sort'] == 'price_highest') {
                          $categoryProducts->orderBy('product_price', 'DESC');
                      }
                  }else{
                    $categoryProducts->inRandomOrder();
                  }

                  $categoryProducts = $categoryProducts->paginate(6);

                return view('layouts.front_layouts.products.ajax_products_listing_page')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            }else{
                abort(404);
            }

        } else {
            $url = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['category_url'=>$url, 'status'=>1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::catDetails($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catsId'])->where('status', 1);   
                $categoryProducts->inRandomOrder();
                $categoryProducts = $categoryProducts->paginate(6);
                return view('layouts.front_layouts.products.listing_page')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            }else{
                abort(404);
            }
        }	
    }
}
