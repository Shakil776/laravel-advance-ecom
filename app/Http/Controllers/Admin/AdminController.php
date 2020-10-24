<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Auth;
use Session;
use Hash;
use Image;

class AdminController extends Controller
{
    // dashboard
    public function dashboard(){
    	return view('layouts.admin_layouts.dashboard.dashboard_content');
    }
    // admin login
    public function login(Request $request){
    	if ($request->isMethod('post')) {
    		$data = $request->all();

			// validaion
			$rules = [
				'email' => 'required|email',
				'password' => 'required',
			];

			$customMessages = [
				'email.required' => 'Email Address must not be empty!',
				'email.email' => 'Invalid Email Address.',
				'password.required' => 'Password must not be empty!',
			];

			$this->validate($request, $rules, $customMessages);
			
			// login check
    		if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
    			return redirect('admin/dashboard');
    		} else {
				Session::flash('error_message', 'Invalid Email or Password.');
    			return redirect()->back();
    		}
    	}

    	return view('layouts.admin_layouts.accounts.login_content');
    }

    // admin logout
    public function logout(){
    	Auth::guard('admin')->logout();
    	return redirect('/admin');
	}
	
	// admin settings
	public function settings(Request $request){
		$adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
		return view('layouts.admin_layouts.accounts.settings')->with(compact('adminDetails'));
	}

	// password update
	public function updatePassword(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
				if($data['new_password'] == $data['confirm_password']){
					Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
					Session::flash('success_message', 'Password updated Successfully.');
				}else {
					Session::flash('error_message', 'New Password and Confirm Password does not match.');
				}
			}else {
				Session::flash('error_message', 'Current Password is incorrect');
			}
			return redirect()->back();
		}
	}

	// check current pasword
	public function checkCurrentPass(Request $request){
		$data = $request->all();
		// echo "<pre>"; print_r($data); die;
		if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
			echo 'true';
		}else {
			echo 'false';
		}
	}

	// profile
	public function adminProfile(Request $request){
		$adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
		return view('layouts.admin_layouts.accounts.profile')->with(compact('adminDetails'));
	}

	// profile update
	public function adminProfileUpdate(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			
			// validaion
			$rules = [
				'name' => 'required|regex:/^[\pL\s\-]+$/u',
				'mobile' => 'required|numeric',
				'image' => 'image',
			];

			$customMessages = [
				'name.required' => 'Name is required.',
				'name.regex' => 'Valid name is required.',
				'mobile.required' => 'Mobile is required.',
				'mobile.numeric' => 'Valid Mobile is required.',
				'mobile.image' => 'Invalid Image.',
			];

			$this->validate($request, $rules, $customMessages);

			// upload image
			if ($request->hasFile('image')) {
				$image_tmp   = $request->file('image');
				if($image_tmp->isValid()){
					$extension = $image_tmp->getClientOriginalExtension();
					$imageName = rand(111, 99999).time().'.'.$extension;
					$imagePath = 'images/admin_images/admin_photos/'.$imageName;
					$image = Image::make($image_tmp);
					$image->resize(400, 400)->save($imagePath);
				}else if(!empty($data['current_image'])){
					$imageName = $data['current_image'];
				}else{
					$imageName = "";
				}
			}

			// update info
			Admin::where('email', Auth::guard('admin')->user()->email)->update(['name' => $data['name'], 'mobile' => $data['mobile'], 'image'=> $imageName]);
			Session::flash('success_message', 'Profile Info updated Successfully.');
			return redirect()->back();

		}
	}
}
