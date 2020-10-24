@extends('layouts.admin_layouts.master')

@section('title', 'Slider')

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
            <li class="breadcrumb-item active">Sliders</li>
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
                <h3 class="card-title">Sliders</h3>
                <div>
                    <a href="{{ route('admin.add-edit-slider') }}" class="btn btn-small btn-info float-right"><i class="fas fa-plus"></i>&nbsp;Add Slider</a>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL. No</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Alter Text</th>
                    <th>Links</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(!empty($sliders))
                        @php($i = 1)
                        @foreach($sliders as $slider)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                              <?php $slider_image_path = "images/slider_images/".$slider['slider_image']; ?>
                              @if(!empty($slider['slider_image']) && file_exists($slider_image_path))
                                <img src="{{ asset($slider_image_path) }}" alt="Slider Image" width="300">
                              @endif
                            </td>
                            <td>{{ $slider['title'] }}</td>
                            <td>{{ $slider['alt_text'] }}</td>
                            <td>{{ $slider['link'] }}</td>
                            <td>
                                @if($slider['status'] == 1) 
                                    <a class="changeSliderStatus" id="slider-{{ $slider['id'] }}" slider_id="{{ $slider['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>  
                                @else 
                                    <a class="changeSliderStatus" id="slider-{{ $slider['id'] }}" slider_id="{{ $slider['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive"></i></a> 
                                @endif
                            </td>
                            <td>
                              <a href="{{ route('admin.add-edit-slider', ['id' => $slider['id']]) }}" title="Edit"><i class="fas fa-edit text-info"></i></a>&nbsp;&nbsp;
                              <a href="javascript:void(0)" title="Delete" class="confirmDelete" record="slider" recordid="{{ $slider['id'] }}"><i class="fas fa-trash-alt text-danger"></i></a>
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