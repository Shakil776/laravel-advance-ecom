@php
use App\Product;
@endphp
@extends('layouts.front_layouts.master')

@section('title', 'Cart Items')

@section('main-content')

<div class="span9">
  @if(Session::has('success_message'))
    <div class="alert alert-success">
    <strong>Weldone!</strong>  {{ Session::get('success_message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
  @endif
  @if(Session::has('error_message'))
      <div class="alert alert-danger">
      <strong>Oppps!</strong>  {{ Session::get('error_message') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
  @endif
  <ul class="breadcrumb">
    <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
    <li class="active"> SHOPPING CART</li>
  </ul>
  <h3>SHOPPING CART [ <small>3 Item(s) </small>]<a href="{{ url('/') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>  
  <hr class="soft"/>
  <table class="table table-bordered">
    <tr><th> I AM ALREADY REGISTERED  </th></tr>
     <tr> 
     <td>
      <form class="form-horizontal">
        <div class="control-group">
          <label class="control-label" for="inputUsername">Username</label>
          <div class="controls">
          <input type="text" id="inputUsername" placeholder="Username">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputPassword1">Password</label>
          <div class="controls">
          <input type="password" id="inputPassword1" placeholder="Password">
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
          <button type="submit" class="btn">Sign in</button> OR <a href="register.html" class="btn">Register Now!</a>
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <a href="forgetpass.html" style="text-decoration:underline">Forgot password ?</a>
          </div>
        </div>
      </form>
      </td>
      </tr>
  </table>    
      
  <div id="appendCartItems">
    @include('layouts.front_layouts.cart.show_cart_items')
  </div>
      
  <a href="products.html" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
  <a href="login.html" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
</div>
@endsection