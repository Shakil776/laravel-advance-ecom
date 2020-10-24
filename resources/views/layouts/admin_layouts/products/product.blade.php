@extends('layouts.admin_layouts.master')

@section('title', 'Product')

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
            <li class="breadcrumb-item active">Products</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Weldone!</strong>  {{ Session::get('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
          @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Products</h3>
                <div>
                    <a href="{{ url('/admin/product') }}" class="btn btn-small btn-info float-right"><i class="fas fa-plus"></i>&nbsp;Add Product</a>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL. No</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Section</th>
                    <th>Price</th>
                    <th>Code</th>
                    <th>Color</th>
                    <th>Status</th>
                    <th width="12%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(!empty($products))
                        @php($i = 1)
                        @foreach($products as $product)
                        
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $product['product_name'] }}</td>
                            <td>
                              <?php $product_image_path = "images/product_images/small/".$product['product_main_image']; ?>
                              @if(!empty($product['product_main_image']) && file_exists($product_image_path))
                              <img src="{{ asset('images/product_images/small/'.$product['product_main_image']) }}" alt="Product Image" width="80">
                              @else
                              <img src="{{ asset('images/product_images/small/no-image.png') }}" alt="Product Image" width="80">
                              @endif
                            </td>
                            <td>{{ $product['brand']['brand_name'] }}</td>
                            <td>{{ $product['category']['category_name'] }}</td>
                            <td>{{ $product['section']['name'] }}</td>
                            <td>TK.&nbsp;{{ $product['product_price'] }}</td>
                            <td>{{ $product['product_code'] }}</td>
                            <td>{{ $product['product_color'] }}</td>
                            <td>
                                @if($product['status'] == 1) 
                                    <a class="changeProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>  
                                @else 
                                    <a class="changeProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive"></i></a> 
                                @endif
                            </td>
                            <td>
                              <a href="{{ url('/admin/add-attribute/'.$product['id']) }}" title="Add Attribute"><i class="fas fa-plus text-primary"></i></a>&nbsp;&nbsp;
                              <a href="{{ url('/admin/product/'.$product['id']) }}" title="Edit"><i class="fas fa-edit text-info"></i></a>&nbsp;&nbsp;
                              <a href="{{ url('/admin/add-image/'.$product['id']) }}" title="Add Image"><i class="fas fa-plus-circle text-success"></i></a>&nbsp;&nbsp;
                              <a href="javascript:void(0)" title="Delete" class="confirmDelete" record="product" recordid="{{ $product['id'] }}"><i class="fas fa-trash-alt text-danger"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
  </section>
    <!-- /.content -->


  
</div>
@endsection