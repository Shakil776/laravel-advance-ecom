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
        <form @if(empty($brandData['id'])) action="{{ route('admin.add-edit-brand') }}" @else action="{{ route('admin.add-edit-brand', ['id' => $brandData['id']]) }}" @endif method="post" id="brandForm" name="brandForm">
          @csrf
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">{{ $title }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 offset-md-3">
                  <div class="form-group">
                    <label for="brand_name">Brand Name<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Enter Brand Name" @if(!empty($brandData['brand_name'])) value="{{ $brandData['brand_name'] }}" @else value="{{ old('brand_name') }}" @endif>
                  </div>
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>  
              </div>
            </div>
            
            <!-- /.card-body -->
          </div>
        </form>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection