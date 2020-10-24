<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use Session;
use Image;

class SliderController extends Controller
{
     // show sliders
    public function sliders(){
        $sliders = Slider::get()->toArray();
        /*dd($sliders); die;*/
        return view('layouts.admin_layouts.sliders.slider')->with(compact('sliders'));
    }

    // change slider status
    public function changeSliderStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Slider::where('id', $data['slider_id'])->update(['status'=>$status]);
            return response()->json([
                'status' => $status,
                'slider_id' => $data['slider_id']
            ]);
        }
    }

    // add-edit slider
    public function addEditSlider(Request $request, $id = null){
        
        if($id == ""){
            // add slider functionality
            $title = "Add Slider";
            $slider = new Slider;
            $sliderData = [];
            $message = "Slider Information Added Successfully.";
        }else{
            // edit slider functionality
            $title = "Edit Slider";
            $sliderData = Slider::where('id', $id)->first()->toArray();
            /*dd($sliderData); die;*/
            $slider = Slider::find($id);
            $message = "Slider Information Updated Successfully.";
        }

        if($request->isMethod('post')){
            $data = $request->all();

            // validaion
			$rules = [
				'slider_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000, slider_image,'.$id
			];

			$customMessages = [
				'slider_image.image' => 'Valid Image is required.',
				'slider_image.mimes' => 'Invalid Image Type.',
				'slider_image.max' => 'Image size must be less than 5MB.',
			];

            $this->validate($request, $rules, $customMessages);
            // save slider information

            // upload slider image
			if ($request->hasFile('slider_image')) {
                $image_tmp = $request->file('slider_image');
                if($image_tmp->isValid()){
                    $file_name = $image_tmp->getClientOriginalName();
                    $image_name = pathinfo($file_name, PATHINFO_FILENAME);
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName =  $image_name.'-'.rand(111, 99999).time().'.'.$extension;
                    $imagePath = 'images/slider_images/'.$imageName;
                    Image::make($image_tmp)->resize(1170, 480)->save($imagePath);
                    // save image into database
                    $slider->slider_image = $imageName;
                }
            }else{
            	$slider->slider_image = $slider['slider_image'];
            }

            if (!empty($data['title'])) {
            	$slider->title = $data['title'];
            } else {
            	$slider->title = '';
            }

            if (!empty($data['alt_text'])) {
            	$slider->alt_text = $data['alt_text'];
            } else {
            	$slider->alt_text = '';
            }

            if (!empty($data['link'])) {
            	$slider->link = $data['link'];
            } else {
            	$slider->link = '';
            }

            $slider->status = 1;
            $slider->save();
            Session::flash('success_message', $message);
            return redirect('/admin/sliders');
        }

        return view('layouts.admin_layouts.sliders.add_edit_slider')->with(compact('title', 'sliderData')); 
    }

    // delete Slider
    public function deleteSlider($id){
        $slider = Slider::find($id);
        // remove slide image from the folder
        if(file_exists('images/slider_images/'.$slider['slider_image'])){
            unlink('images/slider_images/'.$slider['slider_image']);
        }

        $slider->delete();
        Session::flash('success_message', 'Slider Deleted Successfully.');
        return redirect()->back();
    }
}
