@php
  use App\Product; 
@endphp
<div class="tab-pane  active" id="blockView">
  <ul class="thumbnails">
    @if(!empty($categoryProducts))
      @foreach($categoryProducts as $product)
        <li class="span3">
          <div class="thumbnail">
            <a href="{{ url('product/'.$product['id']) }}">
              @if(isset($product['product_main_image']))
                @php $product_image_path = "images/product_images/small/".$product['product_main_image']; @endphp
              @else
                @php $product_image_path = ''; @endphp
              @endif

              @if(!empty($product['product_main_image']) && file_exists($product_image_path))
                <img src="{{ asset('images/product_images/small/'.$product['product_main_image']) }}" alt="Product Image">
                @else
                <img src="{{ asset('images/product_images/small/no-image.png') }}" alt="Product Image">
              @endif
            </a>
            <div class="caption">
              <h5>{{ $product['product_name'] }}</h5>
              <p>
                {{ $product['product_code'] }}
              </p>
              @php $discounted_price = Product::getDiscountedPrice($product['id']); @endphp
              <h4 style="text-align:center">
                {{-- <a class="btn" href="{{ url('product/'.$product['id']) }}"> <i class="icon-zoom-in"></i></a>  --}}
                <a class="btn btn-custom" href="#">Add to <i class="icon-shopping-cart"></i></a> 

                @if($discounted_price > 0)
                  <a class="btn btn-danger btn-custom" href="javascript:">
                      <del>TK.&nbsp;{{ $product['product_price'] }}</del>
                  </a>
                  <a class="btn btn-primary btn-custom" href="javascript:">
                      TK.&nbsp;{{ $discounted_price }}
                  </a>
                @else
                  <a class="btn btn-primary btn-custom" href="javascript:">
                      TK.&nbsp;{{ $product['product_price'] }}
                  </a>
                @endif
              </h4>

            </div>
          </div>
        </li>
      @endforeach
    @endif
  </ul>
  <hr class="soft"/>
</div>