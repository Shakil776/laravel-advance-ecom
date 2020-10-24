@extends('layouts.admin_layouts.master')

@section('title', 'Add Category')

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
        <form @if(empty($categoryData['id'])) action="{{ route('admin.add-edit-category') }}" @else action="{{ route('admin.add-edit-category', ['id' => $categoryData['id']]) }}" @endif method="post" id="categoryForm" name="categoryForm" enctype="multipart/form-data">
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
                    <label for="category_name">Category Name<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter Category Name" @if(!empty($categoryData['category_name'])) value="{{ $categoryData['category_name'] }}" @else value="{{ old('category_name') }}" @endif>
                  </div>
                  <div id="appendCategoriesLevel">
                    @include('layouts.admin_layouts.categories.append_categories_level')
                  </div>
                  <div class="form-group">
                    <label for="category_discount">Category Discount</label>
                    <input type="text" class="form-control" id="category_discount" name="category_discount" placeholder="Enter Category Discount" @if(!empty($categoryData['category_discount'])) value="{{ $categoryData['category_discount'] }}" @else value="{{ old('category_discount') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="category_description">Category Description</label>
                    <textarea class="form-control" rows="3" placeholder="Enter Category Description" id="category_description" name="category_description">@if(!empty($categoryData['category_description'])) {{ $categoryData['category_description'] }} @else {{ old('category_description') }} @endif</textarea>
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea class="form-control" rows="3" placeholder="Enter Meta Description" id="meta_description" name="meta_description">@if(!empty($categoryData['meta_description'])) {{ $categoryData['meta_description'] }} @else {{ old('meta_description') }} @endif</textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Select Section<sup class="text-danger">*</sup></label>
                    <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                      <option value="" selected="selected">Select</option>
                      @foreach($allSections as $section)
                      <option value="{{ $section->id }}" @if(!empty($categoryData['section_id']) && $categoryData['section_id'] == $section->id) selected @endif>{{ $section->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                      <label for="category_image">Category Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="category_image" name="category_image" accept="image/*">
                          <label class="custom-file-label" for="category_image">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text" id="">Upload</span>
                        </div>
                      </div>
                        @if(!empty($categoryData['category_image']))
                          <img src="{{ asset($categoryData['category_image']) }}" alt="Category Image" width="80px" style="margin-top:5px">&nbsp;<a href="javascript:void(0)" title="Remove" class="confirmDelete" record="category-image" recordid="{{ $categoryData['id'] }}">Remove Image</a>
                        @endif
                  </div>
                  <div class="form-group">
                    <label for="category_url">Category URL<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="category_url" name="category_url" placeholder="Enter Category URL" @if(!empty($categoryData['category_url'])) value="{{ $categoryData['category_url'] }}" @else value="{{ old('category_url') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <textarea class="form-control" rows="3" placeholder="Enter Meta Title" id="meta_title" name="meta_title">@if(!empty($categoryData['meta_title'])) {{ $categoryData['meta_title'] }} @else {{ old('meta_title') }} @endif</textarea>
                  </div>
                  <div class="form-group">
                    <label for="meta_keywords">Meta Keywords</label>
                    <textarea class="form-control" rows="3" placeholder="Enter Meta Keywords" name="meta_keywords">@if(!empty($categoryData['meta_keywords'])) {{ $categoryData['meta_keywords'] }} @else {{ old('meta_keywords') }} @endif</textarea>
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