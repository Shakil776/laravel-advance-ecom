<div class="tab-pane  active" id="blockView">
  <ul class="thumbnails">
    @if(!empty($categoryProducts))
      @foreach($categoryProducts as $product)
        <li class="span3">
          <div class="thumbnail">
            <a href="#">
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
              <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">TK.&nbsp;{{ $product['product_price'] }}</a></h4>
            </div>
          </div>
        </li>
      @endforeach
    @endif
  </ul>
  <hr class="soft"/>
</div>