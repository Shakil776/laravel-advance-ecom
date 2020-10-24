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
        @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oppps!</strong>  {{ Session::get('error_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif

        <form action="{{ url('admin/add-image/'.$productData['id']) }}"  method="post" id="productAlternatteImageForm" name="productAlternatteImageForm" enctype="multipart/form-data">
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
                    <label>Product Name:&nbsp;</label>{{ $productData['product_name'] }}
                  </div>
                  <div class="form-group">
                    <label>Product Code:&nbsp;</label>{{ $productData['product_code'] }}
                  </div>
                  <div class="form-group">
                    <label>Product Color:&nbsp;</label>{{ $productData['product_color'] }}
                  </div>
                </div>
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                  <div class="form-group">
                      @if(!empty($productData['product_main_image']))
                          <img src="{{ asset('images/product_images/small/'.$productData['product_main_image']) }}" alt="Product Image" width="150px">
                      @endif
                  </div>  
                </div>
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="product_main_image">Product Alternate Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="images" name="images[]" accept="image/*" multiple="" required="">
                          <label class="custom-file-label" for="images">Choose file</label>
                        </div>
                      </div>
                  </div>  
                  <button type="submit" class="btn btn-info">Add Images</button>
                </div>
                <!-- /.col-md-6 -->
              </div>
              <!-- /.row -->
            </div>
            
            <!-- /.card-body -->
          </div>
        </form>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <form action="{{ url('admin/update-alternate-image/'.$productData['id']) }}" method="post" id="alternateImageForm" name="alternateImageForm" enctype="multipart/form-data">
              @csrf
              <div class="card">
                <div class="card-header text-center">
                  <h3>Product Images</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                  <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>SL. No</th>
                      <th>Image</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @if(!empty($productData['images']))
                          @php($i = 1)
                          @foreach($productData['images'] as $image)
                            <input style="display: none;" type="text" id="imageId" name="imageId[]" value="{{ $image['id'] }}">
                          <tr>
                              <td>{{ $i++ }}</td>
                              <td><img src="{{ asset('images/product_images/small/'.$image['image']) }}" alt="Product Image" width="100"></td>
                              <td>
                                @if($image['status'] == 1) 
                                    <a class="changeImageStatus" id="image-{{ $image['id'] }}" image_id="{{ $image['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>  
                                @else 
                                    <a class="changeImageStatus" id="image-{{ $image['id'] }}" image_id="{{ $image['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive"></i></a> 
                                @endif
                              </td>
                              <td>
                                <a href="javascript:void(0)" title="Delete" class="confirmDelete" record="image" recordid="{{ $image['id'] }}"><i class="fas fa-trash-alt text-danger"></i></a>
                              </td>
                          </tr>
                          @endforeach
                      @endif

                  </table>
                  <button type="submit" class="btn btn-info">Update Attribute</button>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </form>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
</div>
@endsection