@extends('layouts.admin_layouts.master')

@section('title', 'Setting')

@section('main-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Setting</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Setting</li>
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
          <!-- left column -->
          <div class="col-md-6 offset-md-3">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              @if(Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top:10px">
                  <strong>Ooops!</strong>  {{ Session::get('error_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif

              @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px">
                  <strong>Well done!</strong>  {{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              <!-- form start -->
              <form class="form-horizontal" method="post" action="{{ route('admin.password-update') }}" name="updatePasswordForm" id="updatePasswordForm"> 
              @csrf
                <div class="card-body">
                  <?php 
                  /*<div class="form-group row">
                    <label class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" value="{{ $adminDetails->name }}" placeholder="Name" name="name">
                    </div>
                  </div>*/
                  ?>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Admin Type</label>
                    <div class="col-sm-8">
                      <input class="form-control" value="{{ $adminDetails->type }}" readonly="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                      <input class="form-control" value="{{ $adminDetails->email }}" readonly="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="current_password" class="col-sm-4 col-form-label">Current Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current Password">
                      <span id="checkCurrentPassword"></span>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label for="new_password" class="col-sm-4 col-form-label">New Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label for="confirm_password" class="col-sm-4 col-form-label">Confirm Password</label>
                    <div class="col-sm-8">
                      <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Submit</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  
</div>
@endsection