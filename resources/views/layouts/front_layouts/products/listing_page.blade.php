@extends('layouts.front_layouts.master')

@section('title', 'Product')

@section('main-content')
  <div class="span9">
    <ul class="breadcrumb">
      <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
      <li class="active"> <?php echo $categoryDetails['breadcrumbs']; ?> </li>
    </ul>
    <h3> {{ $categoryDetails['catDetails']['category_name'] }} <small class="pull-right"> {{ count($categoryProducts) }} products are available </small></h3>
    <hr class="soft"/>
    <p>{{ $categoryDetails['catDetails']['category_description'] }}</p>
    <hr class="soft"/>
    <form class="form-horizontal span6" name="sortProducts" id="sortProducts">
      <input type="hidden" name="url" id="url" value="{{ $url }}">
      <div class="control-group">
        <label class="control-label alignL">Sort By</label>
        <select name="sort" id="sort">
          <option value="">Select</option>
          <option value="latest_product" @if(isset($_GET['sort']) && $_GET['sort'] == 'latest_product') selected="" @endif>Latest Product</option>
          <option value="product_name_a_z" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_name_a_z') selected="" @endif>Product Name A - Z</option>
          <option value="product_name_z_a" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_name_z_a') selected="" @endif>Product Name Z - A</option>
          <option value="price_lowest" @if(isset($_GET['sort']) && $_GET['sort'] == 'price_lowest') selected="" @endif>Lowest Price First</option>
          <option value="price_highest" @if(isset($_GET['sort']) && $_GET['sort'] == 'price_highest') selected="" @endif>Highest Price First</option>
        </select>
      </div>
    </form>
    

    <br class="clr"/>
    <div class="tab-content filter_products">
      @include('layouts.front_layouts.products.ajax_products_listing_page')
    </div>
    <a href="#" class="btn btn-large pull-right">Compare Product</a>
    <div class="pagination">
      @if(isset($_GET['sort']) && !empty($_GET['sort']))
        {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}
      @else
        {{ $categoryProducts->links() }}
      @endif
    </div>
    <br class="clr"/>
  </div>
@endsection