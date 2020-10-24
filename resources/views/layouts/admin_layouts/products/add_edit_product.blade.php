@extends('layouts.admin_layouts.master')

@section('title', $title)

@section('main-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Catalogues</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
        @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Weldone!</strong>  {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
        <form @if(empty($productData['id'])) action="{{ url('admin/product') }}" @else action="{{ url('admin/product/'.$productData['id']) }}" @endif method="post" id="productForm" name="productForm" enctype="multipart/form-data">
          @csrf
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">{{ $title }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Select Category<sup class="text-danger">*</sup></label>
                    <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                      <option value="" selected="selected">Select</option>
                      @foreach($categories as $section)
                      <optgroup label="{{ $section['name'] }}"></optgroup>
                          @foreach($section['categories'] as $category)
                          <option value="{{ $category['id'] }}" @if(!empty(old('category_id')) && $category['id'] == old('category_id')) selected="" @elseif(!empty($productData['category_id']) && $productData['category_id'] == $category['id']) selected="" @endif>{{ $category['category_name'] }}</option>
                            @foreach($category['subcategories'] as $subcategory)
                            <option value="{{ $subcategory['id'] }}" @if(!empty(old('category_id')) && $subcategory['id'] == old('category_id')) selected="" @elseif(!empty($productData['category_id']) && $productData['category_id'] == $subcategory['id']) selected="" @endif>&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{ $subcategory['category_name'] }}</option>
                            @endforeach
                          @endforeach
                      @endforeach
                      
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="product_name">Product Name<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter Product Name" @if(!empty($productData['product_name'])) value="{{ $productData['product_name'] }}" @else value="{{ old('product_name') }}" @endif>
                  </div>

                  <div class="form-group">
                    <label for="product_color">Product Color<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="product_color" name="product_color" placeholder="Enter product color" @if(!empty($productData['product_color'])) value="{{ $productData['product_color'] }}" @else value="{{ old('product_color') }}" @endif>
                  </div>

                  <div class="form-group">
                      <label for="product_main_image">Product Main Image&nbsp;<span style="font-size: 14px" class="text-info">(Recommended Image Size Width:1040px Height:1200px)</span></label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="product_main_image" name="product_main_image" accept="image/*">
                          <label class="custom-file-label" for="product_main_image">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text" id="">Upload</span>
                        </div>
                      </div>
                      @if(!empty($productData['product_main_image']))
                          <img src="{{ asset('images/product_images/small/'.$productData['product_main_image']) }}" alt="Product Image" width="80px" style="margin-top:5px">&nbsp;<a href="javascript:void(0)" title="Delete" class="confirmDelete" record="product-image" recordid="{{ $productData['id'] }}">Delete Image</a>
                      @endif
                  </div>  

                  <div class="form-group">
                    <label>Select Fabric</label>
                    <select name="product_fabric" id="product_fabric" class="form-control select2" style="width: 100%;">
                      <option value="">Select</option>
                      @foreach($fabricArray as $fabric)
                      <option value="{{ $fabric }}" @if(!empty($productData['product_fabric']) && $productData['product_fabric'] == $fabric) selected="" @endif>{{ $fabric }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Select Pattern</label>
                    <select name="product_pattern" id="product_pattern" class="form-control select2" style="width: 100%;">
                      <option value="">Select</option>
                      @foreach($patternArray as $pattern)
                      <option value="{{ $pattern }}" @if(!empty($productData['product_pattern']) && $productData['product_pattern'] == $pattern) selected="" @endif>{{ $pattern }}</option>
                      @endforeach
                    </select>
                  </div>                
                  
                  <div class="form-group">
                    <label for="product_description">Product Description</label>
                    <textarea class="form-control" rows="3" placeholder="Enter Product Description" id="product_description" name="product_description">@if(!empty($productData['product_description'])) {{ $productData['product_description'] }} @else {{ old('product_description') }} @endif</textarea>
                  </div>

                  <div class="form-group">
                    <label for="product_meta_description">Meta Description</label>
                    <textarea class="form-control" rows="3" placeholder="Enter Meta Description" id="product_meta_description" name="product_meta_description">@if(!empty($productData['product_meta_description'])) {{ $productData['product_meta_description'] }} @else {{ old('product_meta_description') }} @endif</textarea>
                  </div>

                  <div class="form-group">
                    <label for="is_featured">Featured Item</label>
                    <input type="checkbox" id="is_featured" name="is_featured" value="Yes" @if(!empty($productData['is_featured']) && $productData['is_featured'] == 'Yes') checked="" @endif>
                  </div>
                </div>

                <div class="col-md-6">

                  <div class="form-group">
                    <label>Select Brand<sup class="text-danger">*</sup></label>
                    <select name="brand_id" id="brand_id" class="form-control select2" style="width: 100%;">
                      <option value="">Select</option>
                      @foreach($bands as $band)
                      <option value="{{ $band['id'] }}" @if(!empty($productData['brand_id']) && $productData['brand_id'] == $band['id']) selected="" @endif>{{ $band['brand_name'] }}</option>
                      @endforeach
                    </select>
                  </div> 

                  <div class="form-group">
                    <label for="product_price">Product Price<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter product price" @if(!empty($productData['product_price'])) value="{{ $productData['product_price'] }}" @else value="{{ old('product_price') }}" @endif>
                  </div>

                  <div class="form-group">
                    <label for="product_code">Product Code<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter product code" @if(!empty($productData['product_code'])) value="{{ $productData['product_code'] }}" @else value="{{ old('product_code') }}" @endif>
                  </div>

                  <div class="form-group">
                    <label for="product_discount">Product Discount</label>
                    <input type="text" class="form-control" id="product_discount" name="product_discount" placeholder="Enter product Discount" @if(!empty($productData['product_discount'])) value="{{ $productData['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif>
                  </div>

                  <div class="form-group">
                      <label for="product_video">Product Video</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="product_video" name="product_video" accept="video/*">
                          <label class="custom-file-label" for="product_video">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text" id="">Upload</span>
                        </div>
                      </div>
                      @if(!empty($productData['product_video']))
                        <div>
                          <a href="{{ url('videos/product_videos/'.$productData['product_video']) }}" download>Download</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0)" title="Delete" class="confirmDelete" record="product-video" recordid="{{ $productData['id'] }}">Delete Video</a>
                        </div>
                      @endif
                  </div>

                  <div class="form-group">
                    <label>Select Sleeve</label>
                    <select name="product_sleeve" id="product_sleeve" class="form-control select2" style="width: 100%;">
                      <option value="">Select</option>
                      @foreach($sleeveArray as $sleeve)
                      <option value="{{ $sleeve }}" @if(!empty($productData['product_sleeve']) && $productData['product_sleeve'] == $sleeve) selected="" @endif>{{ $sleeve }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Select Fit</label>
                    <select name="product_fit" id="product_fit" class="form-control select2" style="width: 100%;">
                      <option value="">Select</option>
                      @foreach($fitArray as $fit)
                      <option value="{{ $fit }}" @if(!empty($productData['product_fit']) && $productData['product_fit'] == $fit) selected="" @endif>{{ $fit }}</option>
                      @endforeach
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="product_meta_title">Meta Title</label>
                    <textarea class="form-control" rows="3" placeholder="Enter Meta Title" id="product_meta_title" name="product_meta_title">@if(!empty($productData['product_meta_title'])) {{ $productData['product_meta_title'] }} @else {{ old('product_meta_title') }} @endif</textarea>
                  </div>

                  <div class="form-group">
                    <label for="product_meta_keywords">Meta Keywords</label>
                    <textarea class="form-control" rows="3" placeholder="Enter Meta Keywords" name="product_meta_keywords">@if(!empty($productData['product_meta_keywords'])) {{ $productData['product_meta_keywords'] }} @else {{ old('product_meta_keywords') }} @endif</textarea>
                  </div>
              </div>
            </div>
            <button type="submit" class="btn btn-info">Submit</button>
            <!-- /.card-body -->
          </div>
        </form>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection