<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Section;
use App\Category;
use App\ProductAttribute;
use App\ProductImage;
use App\Brand;
use Session;
use Image;

class ProductController extends Controller
{
    // show products
    public function products(){
        $products = Product::with(['category', 'section', 'brand'])->get();
        $products = json_decode(json_encode($products), true);
        /*echo "<pre>"; print_r($products); die;*/
        return view('layouts.admin_layouts.products.product')->with(compact('products'));
    }

    // change product status
    public function changeProductStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status'=>$status]);
            return response()->json([
                'status' => $status,
                'product_id' => $data['product_id']
            ]);
        }
    }

    // add-edit product
    public function addEditProduct(Request $request, $id = null){
        
        if($id == ""){
            // add product functionality
            $title = "Add Product";
            $product = new Product;
            $productData = [];
            $getAllProducts = [];
            $message = "Product Added Successfully.";
        }else{
            // edit product functionality
            $title = "Edit Product";
            $productData = Product::find($id);
            $productData = json_decode(json_encode($productData), true);
            /*echo "<pre>"; print_r($productData); die;*/
            $product = Product::find($id);
            $message = "Product Updated Successfully."; 
        }

        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/

            // validaion
			$rules = [
                'category_id' => 'required',
                'brand_id' => 'required',
				'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
				'product_price' => 'required|numeric',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
				'product_main_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
			];

			$customMessages = [
				'category_id.required' => 'Category is required.',
                'brand_id.required' => 'Brand is required.',
				'product_name.required' => 'Product name is required.',
                'product_name.regex' => 'Valid Product name is required.',
                'product_price.required' => 'Product price is required.',
                'product_price.numeric' => 'Product price must be a numeric number.',
                'product_code.required' => 'Product code is required.',
                'product_code.regex' => 'Valid Product code is required.',
                'product_color.required' => 'Product color is required.',
                'product_color.regex' => 'Valid Product color is required.',
				'product_main_image.image' => 'Valid Image is required.',
				'product_main_image.mimes' => 'Invalid Image Type.',
				'product_main_image.max' => 'Image size must be less than 5MB.',
			];

            $this->validate($request, $rules, $customMessages);

            // save category information
            // get category details for section id
            $categoryDetails = Category::find($data['category_id']);

            // upload product image
            if ($request->hasFile('product_main_image')) {
                $image_tmp = $request->file('product_main_image');
                if($image_tmp->isValid()){
                    $file_name = $image_tmp->getClientOriginalName();
                    $image_name = pathinfo($file_name, PATHINFO_FILENAME);
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName =  $image_name.'-'.rand(111, 99999).time().'.'.$extension;
                    $largeImagePath = 'images/product_images/large/'.$imageName;
                    $mediumImagePath = 'images/product_images/medium/'.$imageName;
                    $smallImagePath = 'images/product_images/small/'.$imageName;
                    Image::make($image_tmp)->resize(1040, 1200)->save($largeImagePath);
                    Image::make($image_tmp)->resize(520, 600)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(260, 300)->save($smallImagePath);
                    // save image into database
                    $product->product_main_image = $imageName;
                }
            }

            // upload product video
            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()){
                    $file_name = $video_tmp->getClientOriginalName();
                    $video_name = pathinfo($file_name, PATHINFO_FILENAME);
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName =  $video_name.'-'.rand(111, 99999).time().'.'.$extension;
                    $videoPath = 'videos/product_videos/';
                    $video_tmp->move($videoPath, $videoName);
                    // save video into database
                    $product->product_video = $videoName;
                }
            }

            $product->category_id              = $data['category_id'];
            $product->section_id               = $categoryDetails->section_id;
            $product->brand_id                 = $data['brand_id'];
            $product->product_price            = $data['product_price'];
            $product->product_color            = $data['product_color'];
            $product->product_fabric           = $data['product_fabric'];
            $product->product_pattern          = $data['product_pattern'];
            $product->product_description      = $data['product_description'];
            $product->product_meta_description = $data['product_meta_description'];
            $product->product_name             = $data['product_name'];
            $product->product_code             = $data['product_code'];
            $product->product_discount         = $data['product_discount'];
            $product->product_sleeve           = $data['product_sleeve'];
            $product->product_fit              = $data['product_fit'];
            $product->product_meta_title       = $data['product_meta_title'];
            $product->product_meta_keywords    = $data['product_meta_keywords'];

            if (!empty($data['is_featured'])) {
                $product->is_featured          = $data['is_featured'];
            }else{
                $product->is_featured          = "No";
            }

            $product->status                   = 1;
            $product->save();
            Session::flash('success_message', $message);
            return redirect('/admin/products');
        }


        // product filters
        $productFilters = Product::productFilters();
        $fabricArray = $productFilters['fabricArray'];
        $patternArray = $productFilters['patternArray'];
        $sleeveArray = $productFilters['sleeveArray'];
        $fitArray = $productFilters['fitArray'];
        
        // get all categories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);
        /*echo "<pre>"; print_r($categories); die;*/
        // get all categories
        $bands = Brand::where('status', 1)->get();
        $bands = json_decode(json_encode($bands), true);
        /*echo "<pre>"; print_r($bands); die;*/
        return view('layouts.admin_layouts.products.add_edit_product')->with(compact('title', 'categories', 'fabricArray', 'patternArray', 'sleeveArray', 'fitArray', 'productData', 'bands'));
    }

    // remove product image
    public function removeProductImage($id){
        $productImage = Product::select('product_main_image')->where('id', $id)->first();
        // remove image from the folder
        // small image
        if(file_exists('images/product_images/small/'.$productImage->product_main_image)){
            unlink('images/product_images/small/'.$productImage->product_main_image);
        }
        // medium image
        if(file_exists('images/product_images/medium/'.$productImage->product_main_image)){
            unlink('images/product_images/medium/'.$productImage->product_main_image);
        }
        // large image
        if(file_exists('images/product_images/large/'.$productImage->product_main_image)){
            unlink('images/product_images/large/'.$productImage->product_main_image);
        }
        // remove image
        Product::where('id', $id)->update(['product_main_image'=>'']);
        Session::flash('success_message', 'Product Image Delete Successfully.');
        return redirect()->back();
    }

    // remove product video
    public function deleteProductVideo($id){
        $productVideo = Product::select('product_video')->where('id', $id)->first();
        // remove video from the folder
        if(file_exists('videos/product_videos/'.$productVideo->product_video)){
            unlink('videos/product_videos/'.$productVideo->product_video);
        }
        // remove video
        Product::where('id', $id)->update(['product_video'=>'']);
        Session::flash('success_message', 'Product Video Delete Successfully.');
        return redirect()->back();
    }

    // delete product
    public function deleteProduct($id){
        Product::where('id', $id)->delete();
        Session::flash('success_message', 'Product Delete Successfully.');
        return redirect()->back();
    }

    // add attribute
    public function addProductAttribute(Request $request, $id){

        if ($request->isMethod('post')) {
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            foreach ($data['sku'] as $key => $val) {
                if (!empty($val)) {
                    // check duplicate SKU
                    $attrCountSKU = ProductAttribute::where('sku', $val)->count();
                    if ($attrCountSKU>0) {
                        return redirect()->back()->with('error_message', 'SKU already exists! Please provide another SKU.');
                    }

                    // check duplicate size
                    $attrCountSize = ProductAttribute::where(['product_id'=>$id, 'size'=>$data['size'][$key]])->count();
                    if ($attrCountSize>0) {
                        return redirect()->back()->with('error_message', '"'.$data['size'][$key].'" Size already exists! Please provide another Size.');
                    }


                    $attribute = new ProductAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku   = $val;
                    $attribute->size  = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }
            return redirect()->back()->with('success_message', 'Product Attribute has been added Successfully.');
        }

        $productData = Product::select('id', 'product_name', 'product_code', 'product_color', 'product_main_image')->with('attributes')->find($id);
        $productData = json_decode(json_encode($productData), true);
        /*echo "<pre>"; print_r($productData); die;*/
        $title = 'Add Attribute';
        
        return view('layouts.admin_layouts.products.add_attributes')->with(compact('productData', 'title'));
    }

    // update attribute
    public function updateProductAttribute(Request $request, $id){
        if ($request->isMethod('post')) {
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            foreach ($data['attrId'] as $key => $attr) {
                if (!empty($attr)) {
                    ProductAttribute::where(['id'=>$data['attrId'][$key]])->update(['price'=>$data['price'][$key], 'stock'=>$data['stock'][$key]]);
                }
            }
            return redirect()->back()->with('success_message', 'Attribute has been updated Successfully.');
        }
    }

    // change product attribute status
    public function changeAttributeStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductAttribute::where('id', $data['attribute_id'])->update(['status'=>$status]);
            return response()->json([
                'status' => $status,
                'attribute_id' => $data['attribute_id']
            ]);
        }
    }

    // delete product attribute
    public function deleteAttribute($id){
        ProductAttribute::where('id', $id)->delete();
        Session::flash('success_message', 'Attribute Deleted Successfully.');
        return redirect()->back();
    }

    // product alternate image add
    public function addAlternateImage(Request $request, $id){

        if($request->isMethod('post')){

            if ($request->hasFile('images')) {
                $images = $request->file('images');

                foreach ($images as $key => $image) {
                    $productImage = new ProductImage;
                    $image_tmp = Image::make($image);
                    $file_name = $image->getClientOriginalName();
                    $image_name = pathinfo($file_name, PATHINFO_FILENAME);
                    $extension = $image->getClientOriginalExtension();
                    $imageName =  $image_name.'-'.rand(111, 99999).time().'.'.$extension;
                    $largeImagePath = 'images/product_images/large/'.$imageName;
                    $mediumImagePath = 'images/product_images/medium/'.$imageName;
                    $smallImagePath = 'images/product_images/small/'.$imageName;
                    Image::make($image_tmp)->resize(1040, 1200)->save($largeImagePath);
                    Image::make($image_tmp)->resize(520, 600)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(260, 300)->save($smallImagePath);
                    
                    $productImage->product_id = $id;
                    $productImage->image = $imageName;
                    $productImage->status = 1;
                    $productImage->save();
                }
                return redirect()->back()->with('success_message', 'Product alternate image uploaded successfully.');
                
            }
        }

        $productData = Product::select('id', 'product_name', 'product_code', 'product_color', 'product_main_image')->with('images')->find($id);
        $productData = json_decode(json_encode($productData), true);
        /*echo "<pre>"; print_r($productData); die;*/
        $title = 'Add Product Image';
        return view('layouts.admin_layouts.products.add_images')->with(compact('productData', 'title'));
    }

    // change product image status
    public function updateAlternateImageStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductImage::where('id', $data['image_id'])->update(['status'=>$status]);
            return response()->json([
                'status' => $status,
                'image_id' => $data['image_id']
            ]);
        }
    }

    // delete product attribute
    public function deleteAlternateImage($id){

        $image = ProductImage::select('image')->where('id', $id)->first();
        // remove image from the folder
        // small image
        if(file_exists('images/product_images/small/'.$image->image)){
            unlink('images/product_images/small/'.$image->image);
        }
        // medium image
        if(file_exists('images/product_images/medium/'.$image->image)){
            unlink('images/product_images/medium/'.$image->image);
        }
        // large image
        if(file_exists('images/product_images/large/'.$image->image)){
            unlink('images/product_images/large/'.$image->image);
        }
        // remove image
        ProductImage::where('id', $id)->delete();
        Session::flash('success_message', 'Image Delete Successfully.');
        return redirect()->back();
    }
}
