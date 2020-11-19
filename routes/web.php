<?php

use Illuminate\Support\Facades\Route;
use App\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// front end route start here
Route::namespace('Front')->group(function(){
    // home page 
    Route::get('/', 'IndexController@index');
    // listing/category page
    $catUrls = Category::select('category_url')->where('status', 1)->get()->pluck('category_url')->toArray();
    foreach ($catUrls as $url) {
        Route::get('/'.$url, 'ProductsController@listing');
    }    
    // product details
    Route::get('/product/{id}', 'ProductsController@productDetails');
    // get product price
    Route::post('/get-product-price', 'ProductsController@getPrice');
    // add to cart
    Route::post('/add-to-cart', 'CartController@addToCart');
    // show cart product
    Route::get('/cart', 'CartController@showCart');
});

// admin panel route start here
Route::prefix('/admin')->namespace('Admin')->group(function () {
    // all admin route will define here
    Route::group(['middleware' => 'admin'], function() {
    	// admin dashboard
        Route::get('/dashboard', 'AdminController@dashboard');
        // admin logout
        Route::post('/logout', 'AdminController@logout');
        // admin settings
        Route::get('/settings', 'AdminController@settings')->name('admin.settings');
        // update password
        Route::match(['get', 'post'], '/password-update', 'AdminController@updatePassword')->name('admin.password-update');
        // check current password
        Route::post('/current-pwd-check', 'AdminController@checkCurrentPass');
        // admin profile
        Route::match(['get', 'post'], '/profile', 'AdminController@adminProfile')->name('admin.profile');
        // profile update
        Route::match(['get', 'post'], '/profile-update', 'AdminController@adminProfileUpdate')->name('admin.profile-update');

        // sections
        Route::get('/sections', 'SectionController@sections')->name('admin.sections');
        Route::post('/section-status', 'SectionController@changeSectionStatus');

        // categories
        Route::get('/categories', 'CategoryController@categories')->name('admin.categories');
        Route::post('/category-status', 'CategoryController@changeCategoryStatus');
        Route::match(['get', 'post'], '/category/{id?}', 'CategoryController@addEditCategory')->name('admin.add-edit-category');
        Route::post('/append-categories-level', 'CategoryController@appendCategoriesLevel');
        Route::get('/delete-category-image/{id}', 'CategoryController@removeCategoryImage')->name('admin.remove-category-image');
        Route::get('/delete-category/{id}', 'CategoryController@deleteCategory');

        // products
        Route::get('/products', 'ProductController@products');
        Route::post('/product-status', 'ProductController@changeProductStatus');
        Route::match(['get', 'post'], '/product/{id?}', 'ProductController@addEditProduct');
        Route::get('/delete-product/{id}', 'ProductController@deleteProduct');
        Route::get('/delete-product-image/{id}', 'ProductController@removeProductImage');
        Route::get('/delete-product-video/{id}', 'ProductController@deleteProductVideo');

        // product attributes
        Route::match(['get', 'post'], '/add-attribute/{id}', 'ProductController@addProductAttribute');
        Route::post('/update-attribute/{id}', 'ProductController@updateProductAttribute');
        Route::post('/attribute-status', 'ProductController@changeAttributeStatus');
        Route::get('/delete-attribute/{id}', 'ProductController@deleteAttribute');

        // product alternate images
        Route::match(['get', 'post'], '/add-image/{id}', 'ProductController@addAlternateImage'); 
        Route::post('/image-status', 'ProductController@updateAlternateImageStatus');
        Route::get('/delete-image/{id}', 'ProductController@deleteAlternateImage');

        // brands
        Route::get('brands', 'BrandController@brands')->name('admin.brands');
        Route::post('/brand-status', 'BrandController@changeBrandStatus');
        Route::match(['get', 'post'], '/brand/{id?}', 'BrandController@addEditBrand')->name('admin.add-edit-brand');
        Route::get('/delete-brand/{id}', 'BrandController@deleteBrand');

        // sliders
        Route::get('sliders', 'SliderController@sliders');
        Route::post('/slider-status', 'SliderController@changeSliderStatus');
        Route::match(['get', 'post'], '/slider/{id?}', 'SliderController@addEditSlider')->name('admin.add-edit-slider');
        Route::get('/delete-slider/{id}', 'SliderController@deleteSlider');
    });
    // admin login
    Route::match(['get', 'post'], '/', 'AdminController@login');
});
