<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductAttribute;
use App\Cart;
use Session;
use Auth;
use View;

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
            
            if(Auth::check()){
                $user_id = Auth::user()->id;
            }else{
                $user_id = 0;
            }
    		// save product in cart table
    		$cart = new Cart;
    		$cart->session_id = $session_id;
    		$cart->user_id = $user_id;
    		$cart->product_id = $data['product_id'];
    		$cart->size = $data['size'];
    		$cart->quantity = $data['quantity'];
    		$cart->save();
    		$message = "Product has been added in the cart.";
			Session::flash('success_message', $message);
			return redirect('/cart');
    	}
    }

    // show cart product
    public function showCart(){
    	$cartItems = Cart::cartItems();
    	/*dd($cartItems); die;*/
    	return view('layouts.front_layouts.cart.show_cart')->with(compact('cartItems'));
    }

    // update cart quantity
    public function updateCartItem(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            // get cart details
            $cartDetails = Cart::find($data['cartid']);
            // get available product stock
            $availableStock = ProductAttribute::select('stock')->where(['product_id'=>$cartDetails['product_id'], 'size'=>$cartDetails['size']])->first()->toArray();
            // check stock is available or not
            if ($data['qty'] > $availableStock['stock']) {
                $cartItems = Cart::cartItems();
                return response()->json([
                    'status'=>false,
                    'message'=>'Product Stock is not available.',
                    'view'=>(String)View::make('layouts.front_layouts.cart.show_cart_items')->with(compact('cartItems'))
                ]);
            }
            // get available size
            /*$availableSize = ProductAttribute::where(['product_id'=>$cartDetails['product_id'], 'size'=>$cartDetails['size'], 'staus'=>1])->count();
            if($availableSize == 0){
                return response()->json([
                    'status'=>false,
                    'message'=>'Product Size is not available.',
                    'view'=>(String)View::make('layouts.front_layouts.cart.show_cart_items')->with(compact('cartItems'))
                ]);
            }*/

            // update quantity
            Cart::where('id', $data['cartid'])->update(['quantity'=>$data['qty']]);
            $cartItems = Cart::cartItems();
            return response()->json([
                'status'=>true,
                'view'=>(String)View::make('layouts.front_layouts.cart.show_cart_items')->with(compact('cartItems'))
            ]);
        }
    }

    // remove from cart
    public function removeCartItem(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            Cart::where('id', $data['cartid'])->delete();
            $cartItems = Cart::cartItems();
            return response()->json([
                'message'=>'Item Removed Successfully.',
                'view'=>(String)View::make('layouts.front_layouts.cart.show_cart_items')->with(compact('cartItems'))
            ]);
        }
    }
}
