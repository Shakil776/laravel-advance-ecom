<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use Session;

class BrandController extends Controller
{
    // show brands
    public function brands(){
        $brands = Brand::get();
        $brands = json_decode(json_encode($brands), true);
        /*echo "<pre>"; print_r($brands); die;*/
        return view('layouts.admin_layouts.brands.brand')->with(compact('brands'));
    }

    // change brand status
    public function changeBrandStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status'=>$status]);
            return response()->json([
                'status' => $status,
                'brand_id' => $data['brand_id']
            ]);
        }
    }

    // add-edit brand
    public function addEditBrand(Request $request, $id = null){
        
        if($id == ""){
            // add brand functionality
            $title = "Add Brand";
            $brand = new Brand;
            $brandData = [];
            $message = "Brand Added Successfully.";
        }else{
            // edit brand functionality
            $title = "Edit Brand";
            $brandData = Brand::where('id', $id)->first();
            $brandData = json_decode(json_encode($brandData), true);

            $brand = Brand::find($id);
            $message = "Brand Updated Successfully.";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // validaion
			$rules = [
				'brand_name' => 'required|regex:/^[\pL\s\-]+$/u'
			];

			$customMessages = [
				'brand_name.required' => 'Brand name is required.',
				'brand_name.regex' => 'Valid Brand name is required.'
			];

            $this->validate($request, $rules, $customMessages);
            // save brand information
            $brand->brand_name = $data['brand_name'];
            $brand->status     = 1;
            $brand->save();
            Session::flash('success_message', $message);
            return redirect('/admin/brands');
        }

        return view('layouts.admin_layouts.brands.add_edit_brand')->with(compact('title', 'brandData')); 
    }

    // delete brand
    public function deleteBrand($id){
        // delete brand
        Brand::where('id', $id)->delete();
        Session::flash('success_message', 'Brand Deleted Successfully.');
        return redirect()->back();
    }
}
