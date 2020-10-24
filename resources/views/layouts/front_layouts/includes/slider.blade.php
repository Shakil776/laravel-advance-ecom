@php 
  use App\Slider;
  $sliders = Slider::sliders();
@endphp

<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
			@foreach($sliders as $key=>$slider)
				<div class="item @if($key == 0) active @endif">
					<div class="container">
						<a @if(!empty($slider['link'])) href="{{ url($slider['link']) }}" @else href="javascript:void(0)" @endif>
							<img style="width:100%" src="{{ asset('images/slider_images/'.$slider['slider_image']) }}" @if(!empty($slider['alt_text'])) alt="{{ $slider['alt_text'] }}" @endif @if(!empty($slider['title'])) title="{{ $slider['title'] }}" @endif/>
						</a>
					</div>
				</div>
			@endforeach
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div>