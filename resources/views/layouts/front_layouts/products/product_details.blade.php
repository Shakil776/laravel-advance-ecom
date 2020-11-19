@php
  use App\Product; 
  $discounted_price = Product::getDiscountedPrice($productDetails['id']);
@endphp
@extends('layouts.front_layouts.master')

@section('title', 'Details')

@section('main-content')
<div class="span9">
  <ul class="breadcrumb">
    <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
    <li><a href="{{ url('/'.$productDetails['category']['category_url']) }}">{{ $productDetails['category']['category_name'] }}</a> <span class="divider">/</span></li>
    <li class="active">{{ $productDetails['product_name'] }}</li>
  </ul>
  <div class="row">
    <div id="gallery" class="span3">
      <a href="{{ asset('images/product_images/medium/'.$productDetails['product_main_image']) }}" title="{{ $productDetails['product_name'] }}">
        
        @if(isset($productDetails['product_main_image']))
          @php $product_image_path = "images/product_images/small/".$productDetails['product_main_image']; @endphp
        @else
          @php $product_image_path = ''; @endphp
        @endif

        @if(!empty($productDetails['product_main_image']) && file_exists($product_image_path))
          <img src="{{ asset('images/product_images/medium/'.$productDetails['product_main_image']) }}" style="width:100%" alt="{{ $productDetails['product_name'] }}"/>
          @else
          <img src="{{ asset('images/product_images/medium/no-image.png') }}" alt="Product Image">
        @endif
      </a>
      <div id="differentview" class="moreOptopm carousel slide">
        <div class="carousel-inner">
          <div class="item active">
            @foreach($productDetails['images'] as $image)
            <a href="{{ asset('images/product_images/medium/'.$image['image']) }}"> 
              <img style="width:29%" src="{{ asset('images/product_images/medium/'.$image['image']) }}" alt=""/>
            </a>
            @endforeach
          </div>
        </div>
      </div>
      
      <div class="btn-toolbar">
        <div class="btn-group">
          <span class="btn"><i class="icon-envelope"></i></span>
          <span class="btn" ><i class="icon-print"></i></span>
          <span class="btn" ><i class="icon-zoom-in"></i></span>
          <span class="btn" ><i class="icon-star"></i></span>
          <span class="btn" ><i class=" icon-thumbs-up"></i></span>
          <span class="btn" ><i class="icon-thumbs-down"></i></span>
        </div>
      </div>
    </div>
    <div class="span6">
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
      <h3>{{ $productDetails['product_name'] }}</h3>
      <small>{{ $productDetails['brand']['brand_name'] }}</small>
      <hr class="soft"/>
      <small>{{ $totalStock }} items in stock</small>
      <form action="{{ url('/add-to-cart') }}" method="post" class="form-horizontal qtyFrm">
        @csrf
        <div class="control-group">
          
          <h4 class="getAttrPrice">
            @if($discounted_price > 0)
              <span style="color: red;"><del>TK.&nbsp;{{ $productDetails['product_price'] }}</del></span>
              <span>TK.&nbsp;{{ $discounted_price }}</span>
            @else
              <span>TK.&nbsp;{{ $productDetails['product_price'] }}</span>
            @endif
          </h4>

            <select class="span2 pull-left" name="size" id="getPrice" product-id="{{ $productDetails['id'] }}" required="">
              <option value="">Select Size</option>
              @foreach($productDetails['attributes'] as $attribute)
                <option value="{{ $attribute['size'] }}">{{ $attribute['size'] }}</option>
              @endforeach
            </select>
            <input type="number" name="quantity" class="span1" placeholder="Qty" min="1" required="" />
            <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
            <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
          </div>
        </div>
      </form>
    
      <hr class="soft clr"/>
      <p class="span6">{{ $productDetails['product_description'] }}</p>
      <a class="btn btn-small pull-right" href="#detail">More Details</a>
      <br class="clr"/>
      <a href="#" name="detail"></a>
      <hr class="soft"/>
    </div>
    
    <div class="span9">
      <ul id="productDetail" class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
        <li><a href="#profile" data-toggle="tab">Related Products</a></li>
      </ul>
      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="home">
          <h4>Product Information</h4>
          <table class="table table-bordered">
            <tbody>
              <tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
              <tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">{{ $productDetails['brand']['brand_name'] }}</td></tr>
              <tr class="techSpecRow"><td class="techSpecTD1">Code:</td><td class="techSpecTD2">{{ $productDetails['product_code'] }}</td></tr>
              <tr class="techSpecRow"><td class="techSpecTD1">Color:</td><td class="techSpecTD2">{{ $productDetails['product_color'] }}</td></tr>
              @if(!empty($productDetails['product_fabric']))
              <tr class="techSpecRow"><td class="techSpecTD1">Fabric:</td><td class="techSpecTD2">{{ $productDetails['product_fabric'] }}</td></tr>
              @endif
              @if(!empty($productDetails['product_pattern']))
              <tr class="techSpecRow"><td class="techSpecTD1">Pattern:</td><td class="techSpecTD2">{{ $productDetails['product_pattern'] }}</td></tr>
              @endif
              @if(!empty($productDetails['product_sleeve']))
              <tr class="techSpecRow"><td class="techSpecTD1">Sleeve:</td><td class="techSpecTD2">{{ $productDetails['product_sleeve'] }}</td></tr>
              @endif
              @if(!empty($productDetails['product_fit']))
              <tr class="techSpecRow"><td class="techSpecTD1">Fit:</td><td class="techSpecTD2">{{ $productDetails['product_fit'] }}</td></tr>
              @endif
            </tbody>
          </table>
      
          <h5>Disclaimer</h5>
          <p>
            There may be a slight color variation between the image shown and original product.
          </p>
        </div>
        <div class="tab-pane fade" id="profile">
          <div id="myTab" class="pull-right">
            <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
            <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
          </div>
          <br class="clr"/>
          <hr class="soft"/>
          <div class="tab-content">
            <div class="tab-pane" id="listView">
              @foreach($relatedProducts as $relatedProduct)
              <div class="row">
                <div class="span2">
                  @if(isset($relatedProduct['product_main_image']))
                    @php $product_image_path = "images/product_images/small/".$relatedProduct['product_main_image']; @endphp
                  @else
                    @php $product_image_path = ''; @endphp
                  @endif

                  @if(!empty($relatedProduct['product_main_image']) && file_exists($product_image_path))
                    <img src="{{ asset('images/product_images/small/'.$relatedProduct['product_main_image']) }}" alt="Product Image">
                    @else
                    <img src="{{ asset('images/product_images/small/no-image.png') }}" alt="Product Image">
                  @endif
                </div>
                <div class="span4">
                  <h3>{{ $relatedProduct['product_name'] }}</h3>
                  <hr class="soft"/>
                  <h5>{{ $relatedProduct['product_code'] }}</h5>
                  <p>
                    {{ $relatedProduct['product_description'] }}
                  </p>
                  <a class="btn btn-small pull-right" href="{{ url('product/'.$relatedProduct['id']) }}">View Details</a>
                  <br class="clr"/>
                </div>
                <div class="span3 alignR">
                  <form class="form-horizontal qtyFrm">
                    <h3>TK. {{ $relatedProduct['product_price'] }}</h3>
                    
                    <div class="btn-group">
                      <a href="{{ url('product/'.$relatedProduct['id']) }}" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                      <a href="{{ url('product/'.$relatedProduct['id']) }}" class="btn btn-large"><i class="icon-zoom-in"></i></a>
                    </div>
                  </form>
                </div>
              </div>
              <hr class="soft"/>
              @endforeach
            </div>
            <div class="tab-pane active" id="blockView">
              <ul class="thumbnails">
                @foreach($relatedProducts as $relatedProduct)
                  <li class="span3">
                    <div class="thumbnail">
                      <a href="{{ url('product/'.$relatedProduct['id']) }}">
                        @if(isset($relatedProduct['product_main_image']))
                          @php $product_image_path = "images/product_images/small/".$relatedProduct['product_main_image']; @endphp
                        @else
                          @php $product_image_path = ''; @endphp
                        @endif

                        @if(!empty($relatedProduct['product_main_image']) && file_exists($product_image_path))
                          <img src="{{ asset('images/product_images/small/'.$relatedProduct['product_main_image']) }}" alt="Product Image">
                          @else
                          <img src="{{ asset('images/product_images/small/no-image.png') }}" alt="Product Image">
                        @endif
                      </a>
                      <div class="caption">
                        <h5>{{ $relatedProduct['product_name'] }}</h5>
                        <p>
                          {{ $relatedProduct['product_code'] }}
                        </p>
                        <h4 style="text-align:center">
                          <a class="btn" href="{{ url('product/'.$relatedProduct['id']) }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="{{ url('product/'.$relatedProduct['id']) }}">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="javascript:">TK. {{ $relatedProduct['product_price'] }}</a>
                        </h4>
                      </div>
                    </div>
                  </li>
                @endforeach
              </ul>
              <hr class="soft"/>
            </div>
          </div>
          <br class="clr">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection