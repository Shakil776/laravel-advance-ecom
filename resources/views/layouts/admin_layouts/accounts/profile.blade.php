@extends('layouts.admin_layouts.master')

@section('title', 'Profile')

@section('main-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
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
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  @if(!empty(Auth::guard('admin')->user()->image))
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image) }}" alt="User profile picture">
                  @else
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/admin_images/default_admin_photo.jpg') }}" alt="User profile picture">
                  @endif
                </div>

                <h3 class="profile-username text-center">{{ Auth::guard('admin')->user()->name }}</h3>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li style="display:none" class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Information</a></li>
                </ul>
                @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Weldone!</strong>  {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <div class="active tab-pane" id="profile">
                    <form class="form-horizontal" action="{{ route('admin.profile-update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                      
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" value="{{ $adminDetails->email }}" class="form-control" id="email" readonly="">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{ $adminDetails->type }}" id="type" readonly="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ $adminDetails->name }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile" value="{{ $adminDetails->mobile }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                          <input type="file" name="image" id="image" accept="image/*">
                          @if(!empty(Auth::guard('admin')->user()->image))
                          <br>
                            <a target="_blank" href="{{ asset('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image) }}" class="text-info">View Image</a>
                            <input type="hidden" name="current_image" id="current_image" accept="image/*" value="{{ Auth::guard('admin')->user()->image }}">
                          @endif
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  
</div>
@endsection