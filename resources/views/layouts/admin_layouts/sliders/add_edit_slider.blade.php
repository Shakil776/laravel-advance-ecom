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
        <form @if(empty($sliderData['id'])) action="{{ route('admin.add-edit-slider') }}" @else action="{{ route('admin.add-edit-slider', ['id' => $sliderData['id']]) }}" @endif method="post" id="sliderForm" name="sliderForm" enctype="multipart/form-data">
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
                      <label for="slider_image">Slider Image<sup class="text-danger">*</sup>&nbsp;<span style="font-size: 14px" class="text-info">(Recommended Image Size Width:1170px Height:480px)</span></label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="slider_image" name="slider_image" accept="image/*">
                          <label class="custom-file-label" for="slider_image">Choose file</label>
                        </div>
                      </div>
                        @if(!empty($sliderData['slider_image']))
                          <img src="{{ asset('images/slider_images/'.$sliderData['slider_image']) }}" alt="Slider Image" width="100px" style="margin-top:5px">
                        @endif
                  </div>
                </div>
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Slider Title" @if(!empty($sliderData['title'])) value="{{ $sliderData['title'] }}" @else value="{{ old('title') }}" @endif>
                  </div>
                </div>
                <!-- /.col-md-6 -->
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-md-6">

                  <div class="form-group">
                    <label for="alt_text">Alter Text</label>
                    <input type="text" class="form-control" name="alt_text" id="alt_text" placeholder="Enter Slider Alter Text" @if(!empty($sliderData['alt_text'])) value="{{ $sliderData['alt_text'] }}" @else value="{{ old('alt_text') }}" @endif>
                  </div>
                </div>
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" class="form-control" name="link" id="link" placeholder="Enter Link" @if(!empty($sliderData['link'])) value="{{ $sliderData['link'] }}" @else value="{{ old('link') }}" @endif>
                  </div>
                </div>
                <!-- /.col-md-6 -->
              </div>
              <!-- /.row -->
              <button type="submit" class="btn btn-info">Submit</button>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </form>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection