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
                  <i class="tag"></i>
                  <a href="{{ url('product/'.$item['id']) }}">
                    @php $image_path = "images/product_images/small/".$item['product_main_image']; @endphp
                    @if(!empty($item['product_main_image']) && file_exists($image_path))
                      <img src="{{ asset($image_path) }}" alt="Product Image">
                    @else
                      <img src="{{ asset('images/product_images/small/no-image.png') }}" alt="Product Image">
                    @endif
                  </a>
                  <div class="caption">
                    <h5>{{ $item['product_name'] }}</h5>
                    <h4><a class="btn" href="{{ url('product/'.$item['id']) }}">VIEW</a> <span class="pull-right">TK.&nbsp;{{ $item['product_price'] }}</span></h4>
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
            <h5>{{ $product['product_name'] }}</h5>
            <p>
              {{ $product['product_code'] }}
            </p>
            
            <h4 style="text-align:center"><a class="btn" href="{{ url('product/'.$product['id']) }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="javascript:">TK.&nbsp;{{ $product['product_price'] }}</a></h4>
          </div>
        </div>
      </li>
    @endforeach
  </ul>
</div>
@endsection