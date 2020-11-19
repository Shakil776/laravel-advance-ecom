<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductAttribute;
use App\Cart;
use Session;
use Auth;

class CartController extends Controller
{
    // add to cart
    public function addToCart(Request $request){
    	if ($request->isMethod('post')) {
    		$data = $request->all();
    		/*dd($data);*/
    		// check product stock is available or not
    		$getProductStock = ProductAttribute::where(['product_id'=>$data['product_id'], 'size'=>$data['size']])->first()->toArray();

    		if ($getProductStock['stock'] < $data['quantity']) {
    			$message = "Required quantity is not available.";
    			Session::flash('error_message', $message);
    			return redirect()->back();
    		}
    		// generate session id if not exists
    		$session_id = Session::get('session_id');
    		if (empty($session_id)) {
    			$session_id = Session::getId();
    			Session::put('session_id', $session_id);
    		}
    		// check product if already exists in user cart
    		if (Auth::check()) {
    			// user is logged in
    			$countProduct = Cart::where(['product_id'=>$data['product_id'], 'size'=>$data['size'], 'user_id'=>Auth::user()->id])->count();
    		}else{
    			// user is not logged in
    			$countProduct = Cart::where(['product_id'=>$data['product_id'], 'size'=>$data['size'], 'session_id'=>Session::get('session_id')])->count();
    		}

    		if ($countProduct > 0) {
    			$message = "Product already exists in cart.";
    			Session::flash('error_message', $message);
    			return redirect()->back();
    		}
    		// save product in cart table
    		$cart = new Cart;
    		$cart->session_id = $session_id;
    		/*$cart->user_id = $data['user_id'];*/
    		$cart->product_id = $data['product_id'];
    		$cart->size = $data['size'];
    		$cart->quantity = $data['quantity'];
    		$cart->save();
    		$message = "Product has been added in the cart.";
			Session::flash('success_message', $message);
			return redirect()->back();
    	}
    }

    // show cart product
    public function showCart(){
    	$cartItems = Cart::cartItems();
    	/*dd($cartItems); die;*/
    	return view('layouts.front_layouts.cart.show_cart')->with(compact('cartItems'));
    }

    
}
