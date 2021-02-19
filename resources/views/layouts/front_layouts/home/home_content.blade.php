@php
  use App\Product; 
@endphp
@extends('layouts.front_layouts.master')

@section('title', 'Home')

@section('main-content')
<div class="span9">
  <div class="well well-small">
    <h4>Featured Products <small class="pull-right">{{ $featureProductsCount }} featured products</small></h4>
    <div class="row-fluid">
      <div id="featured" @if($featureProductsCount > 4) class="carousel slide" @endif>
        <div class="carousel-inner">
          @foreach($featuredChunk as $key=>$featuredItem)
          <div class="item @if($key == 0) active @endif">
            <ul class="thumbnails">
              @foreach($featuredItem as $item)
              <li class="span3">
                <div class="thumbnail">
                  {{-- <i class="tag"></i> --}}
                  <a href="{{ url('product/'.$item['id']) }}">
                    @php $image_path = "images/product_images/small/".$item['product_main_image']; @endphp
                    @if(!empty($item['product_main_image']) && file_exists($image_path))
                      <img src="{{ asset($image_path) }}" alt="Product Image">
                    @else
                      <img src="{{ asset('images/product_images/small/no-image.png') }}" alt="Product Image">
                    @endif
                  </a>
                  <div class="caption">
                    <h5><a href="{{ url('product/'.$item['id']) }}" style="text-decoration: none;">{{ $item['product_name'] }}</a></h5>
                    @php $discounted_price = Product::getDiscountedPrice($item['id']); @endphp
                    <h6>
                      <a class="btn" href="{{ url('product/'.$item['id']) }}">VIEW</a> 
                      <span class="pull-right">
                        @if($discounted_price > 0)
                          <span style="color: red;"><del>TK.&nbsp;{{ $item['product_price'] }}</del></span>
                          TK.&nbsp;{{ $discounted_price }}
                        @else
                          TK.&nbsp;{{ $item['product_price'] }}
                        @endif
                      </span>
                    </h6>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
          @endforeach
        </div>
        <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
        <a class="right carousel-control" href="#featured" data-slide="next">›</a>
      </div>
    </div>
  </div>
  <h4>Latest Products </h4>
  <ul class="thumbnails">
    @foreach($newProducts as $product)
      <li class="span3">
        <div class="thumbnail">
          <a  href="{{ url('product/'.$product['id']) }}">
            @php $image_path = "images/product_images/small/".$product['product_main_image']; @endphp
            @if(!empty($product['product_main_image']) && file_exists($image_path))
              <img src="{{ asset($image_path) }}" alt="Product Image">
            @else
              <img src="{{ asset('images/product_images/small/no-image.png') }}" alt="Product Image">
            @endif
          </a>
          <div class="caption">
            <h5><a href="{{ url('product/'.$product['id']) }}" style="text-decoration: none;">{{ $product['product_name'] }}</a></h5>
            <p>
              {{ $product['product_code'] }}
            </p>
            @php $discounted_price = Product::getDiscountedPrice($product['id']); @endphp
            <h4 style="text-align:center">
              <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> 

              @if($discounted_price > 0)
                <a class="btn btn-danger btn-custom" href="{{ url('product/'.$product['id']) }}">
                    <del>TK.&nbsp;{{ $product['product_price'] }}</del>
                </a>
                <a class="btn btn-primary btn-custom" href="{{ url('product/'.$product['id']) }}">
                    TK.&nbsp;{{ $discounted_price }}
                </a>
              @else
                <a class="btn btn-primary btn-custom" href="{{ url('product/'.$product['id']) }}">
                    TK.&nbsp;{{ $product['product_price'] }}
                </a>
              @endif

            </h4>
          </div>
        </div>
      </li>
    @endforeach
  </ul>
</div>
@endsection