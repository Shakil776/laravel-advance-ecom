@php
use App\Cart;
@endphp
@extends('layouts.front_layouts.master')

@section('title', 'Cart Items')

@section('main-content')
<div class="span9">
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
      
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Product</th>
        <th>Description</th>
        <th>Code</th>
        <th>Quantity/Update</th>
        <th>Unit Price</th>
        <th>Discount</th>
        <th>Sub Total</th>
      </tr>
    </thead>
    <tbody>
      @php $sum = 0; @endphp
      @foreach($cartItems as $item)
        @php $productPrice = Cart::getProductAttrPrice($item['product_id'], $item['size']); @endphp
      <tr>
        <td>
          @if(isset($item['product']['product_main_image']))
            @php $product_image_path = "images/product_images/small/".$item['product']['product_main_image']; @endphp
          @else
            @php $product_image_path = ''; @endphp
          @endif

          @if(!empty($item['product']['product_main_image']) && file_exists($product_image_path))
            <img width="60" src="{{ asset('images/product_images/small/'.$item['product']['product_main_image']) }}" alt="Product Image">
            @else
            <img width="60" src="{{ asset('images/product_images/small/no-image.png') }}" alt="Product Image">
          @endif 
        </td>
        <td>
          {{ $item['product']['product_name'] }}<br/>
          Color : {{ $item['product']['product_color'] }} <br/>
          Size : {{ $item['size'] }} <br/>
        </td>
        <td>{{ $item['product']['product_code'] }}</td>
        <td>
          <div class="input-append">
            <input class="span1" style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="text" value="{{ $item['quantity'] }}">
            <button class="btn" type="button"><i class="icon-minus"></i></button>
            <button class="btn" type="button"><i class="icon-plus"></i></button>
            <button class="btn btn-danger" type="button"><i class="icon-remove icon-white"></i></button>       
          </div>
        </td>
        
        <td>TK. {{ $productPrice }}</td>
        <td>TK. 0.00</td>
        <td>TK. {{ $total = $item['quantity'] * $productPrice }}</td>
      </tr>
        @php $sum += $total; @endphp
      @endforeach
      <tr>
        <td colspan="6" style="text-align:right">Total Price: </td>
        <td>TK. {{ $sum }}</td>
      </tr>
      <tr>
        <td colspan="6" style="text-align:right">Total Discount:  </td>
        <td> TK. 0.00</td>
      </tr>
      <tr>
        <td colspan="6" style="text-align:right"><strong>GRAND TOTAL</strong></td>
        <td class="label label-important" style="display:block"> <strong> TK. {{ $sum }} </strong></td>
      </tr>
    </tbody>
  </table>
    
  <table class="table table-bordered">
      <tbody>
         <tr>
          <td> 
            <form class="form-horizontal">
              <div class="control-group">
                <label class="control-label"><strong> VOUCHERS CODE: </strong> </label>
                <div class="controls">
                  <input type="text" class="input-medium" placeholder="CODE">
                  <button type="submit" class="btn"> ADD </button>
                </div>  
              </div>
            </form>
          </td>
        </tr>
        
      </tbody>
  </table>
      
  <a href="products.html" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
  <a href="login.html" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
</div>
@endsection