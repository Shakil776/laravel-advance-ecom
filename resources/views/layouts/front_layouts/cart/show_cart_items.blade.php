@php
use App\Product;
@endphp
<div class="alert alert-danger" id="errorMsgShow" style="display: none; text-align: center;"></div>
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Product</th>
        <th>Description</th>
        <th>Code</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Discount</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @php $sum = 0; @endphp
      @foreach($cartItems as $item)
        @php $productPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']); @endphp
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
            <input class="span1" style="max-width:34px" size="16" type="text" value="{{ $item['quantity'] }}">
            <button class="btn updateCartItems itemMinus" data-cartid="{{ $item['id'] }}" type="button">
              <i class="icon-minus"></i>
            </button>
            <button class="btn updateCartItems itemPlus" data-cartid="{{ $item['id'] }}" type="button">
              <i class="icon-plus"></i>
            </button>
            <button class="btn btn-danger cartItemRemove" type="button" data-cartid="{{ $item['id'] }}">
              <i class="icon-remove icon-white"></i>
            </button>       
          </div>
        </td>
        
        <td>
          TK. {{ $productPrice['product_price'] }} <br/>
          ({{ $productPrice['product_price'] }} X {{ $item['quantity'] }} = {{ $productPrice['product_price'] * $item['quantity'] }})
        </td>
        <td>TK. {{ $item['quantity'] * $productPrice['discount'] }}</td>
        <td>TK. {{ $total = $item['quantity'] * $productPrice['final_price'] }}</td>
      </tr>
        @php $sum += $total; @endphp
      @endforeach
      <tr>
        <td colspan="6" style="text-align:right">Sub Total Price: </td>
        <td>TK. {{ $sum }}</td>
      </tr>
      <tr>
        <td colspan="6" style="text-align:right">Voucher Discount:  </td>
        <td>TK. 0.00</td>
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