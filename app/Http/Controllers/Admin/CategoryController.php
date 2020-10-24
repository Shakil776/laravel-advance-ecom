<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Section;
use Image;
use Session;

class CategoryController extends Controller
{
    // show categories
    public function categories(){
        $categories = Category::with(['section', 'parentcategory'])->get();
        // $categories = json_decode(json_encode($categories));
        // echo "<pre>"; print_r($categories); die;
        return view('layouts.admin_layouts.categories.category')->with(compact('categories'));
    }

    // change category status
    public function changeCategoryStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status'=>$status]);
            return response()->json([
                'status' => $status,
                'category_id' => $data['category_id']
            ]);
        }
    }

    // add-edit category
    public function addEditCategory(Request $request, $id = null){
        
        if($id == ""){
            // add category functionality
            $title = "Add Category";
            $category = new Category;
            $categoryData = [];
            $getAllCategories = [];
            $message = "Category Added Successfully.";
        }else{
            // edit category functionality
            $title = "Edit Category";
            $categoryData = Category::where('id', $id)->first();
            $categoryData = json_decode(json_encode($categoryData), true);
            // echo "<pre>"; print_r($categoryData); die;
            $getAllCategories = Category::with('subcategories')->where(['parent_id'=>0, 'section_id'=>$categoryData['section_id']])->get();
            $getAllCategories = json_decode(json_encode($getAllCategories), true);
            // echo "<pre>"; print_r($getCategories); die;
            $category = Category::find($id);
            $message = "Category Updated Successfully.";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // validaion
			$rules = [
				'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
				'section_id' => 'required',
				'category_url' => 'required',
				'category_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
			];

			$customMessages = [
				'category_name.required' => 'Category name is required.',
				'category_name.regex' => 'Valid Category name is required.',
				'section_id.required' => 'Section is required.',
				'category_url.required' => 'Category URL is required.',
				'category_image.image' => 'Valid Image is required.',
				'category_image.mimes' => 'Invalid Image Type.',
				'category_image.max' => 'Image size must be less than 5MB.',
			];

            $this->validate($request, $rules, $customMessages);
            // save category information
            // upload image
			if ($request->hasFile('category_image')) {
				$image_tmp   = $request->file('category_image');
				if($image_tmp->isValid()){
					$extension = $image_tmp->getClientOriginalExtension();
					$imageName = rand(111, 99999).time().'.'.$extension;
					$imagePath = 'images/categories_images/'.$imageName;
					$image = Image::make($image_tmp);
                    $image->resize(300, 300)->save($imagePath);
                    // save image
                    $category->category_image = $imagePath;
				}
            }
            

            $category->parent_id            = $data['parent_id'];
            $category->section_id           = $data['section_id'];
            $category->category_name        = $data['category_name'];
            $category->category_discount    = $data['category_discount'];
            $category->category_description = $data['category_description'];
            $category->category_url         = $data['category_url'];
            $category->meta_title           = $data['meta_title'];
            $category->meta_description     = $data['meta_description'];
            $category->meta_keywords        = $data['meta_keywords'];
            $category->status               = 1;
            $category->save();
            Session::flash('success_message', $message);
            return redirect('/admin/categories');
        }
        // get all sections
        $allSections = Section::get();
        return view('layouts.admin_layouts.categories.add_edit_category')->with(compact('title', 'allSections', 'categoryData', 'getAllCategories'));
    }

    // append categories level
    public function appendCategoriesLevel(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // get all categories
            $getAllCategories = Category::with('subcategories')->where(['section_id'=>$data['section_id'], 'parent_id'=>0, 'status'=>1])->get();
            // $getAllCategories = json_decode(json_encode($getAllCategories));
            // echo "<pre>"; print_r($getAllCategories); die;
            return view('layouts.admin_layouts.categories.append_categories_level')->with(compact('getAllCategories'));
        }
    }

    // remove category image
    public function removeCategoryImage($id){
        $categoryImage = Category::select('category_image')->where('id', $id)->first();
        // remove image from the folder
        if(file_exists($categoryImage->category_image)){
            unlink($categoryImage->category_image);
        }
        // remove image
        Category::where('id', $id)->update(['category_image'=>'']);
        Session::flash('success_message', 'Category Image Remove Successfully.');
        return redirect()->back();
    }
    
    // remove category
    public function deleteCategory($id){
        // remove category
        Category::where('id', $id)->delete();
        Session::flash('success_message', 'Category Delete Successfully.');
        return redirect()->back();
    }
}
