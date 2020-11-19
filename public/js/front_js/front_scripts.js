$(document).ready(function() {
	// csrf token setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	/*listing page show product usging ajax*/ 
	$("#sort").on('change', function(){
		var sort = $(this).val();
		var fabric = get_filter('fabric');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fit = get_filter('fit');
		var url = $("#url").val();

		$.ajax({
			url: url,
			method: 'POST',
			data: {fabric:fabric, pattern:pattern, sleeve:sleeve, fit:fit, sort:sort, url:url},
			success: function(data){
				$(".filter_products").html(data);
			}
		});
	});

	// filter product
	// fabric
	$(".fabric").on('click', function(){
		var fabric = get_filter('fabric');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fit = get_filter('fit');
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
			url: url,
			method: 'POST',
			data: {fabric:fabric, pattern:pattern, sleeve:sleeve, fit:fit, sort:sort, url:url},
			success: function(data){
				$(".filter_products").html(data);
			}
		});
	});
	// pattern
	$(".pattern").on('click', function(){
		var fabric = get_filter('fabric');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fit = get_filter('fit');
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
			url: url,
			method: 'POST',
			data: {fabric:fabric, pattern:pattern, sleeve:sleeve, fit:fit, sort:sort, url:url},
			success: function(data){
				$(".filter_products").html(data);
			}
		});
	});
	// sleeve
	$(".sleeve").on('click', function(){
		var fabric = get_filter('fabric');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fit = get_filter('fit');
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
			url: url,
			method: 'POST',
			data: {fabric:fabric, pattern:pattern, sleeve:sleeve, fit:fit, sort:sort, url:url},
			success: function(data){
				$(".filter_products").html(data);
			}
		});
	});
	// fit
	$(".fit").on('click', function(){
		var fabric = get_filter('fabric');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fit = get_filter('fit');
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
			url: url,
			method: 'POST',
			data: {fabric:fabric, pattern:pattern, sleeve:sleeve, fit:fit, sort:sort, url:url},
			success: function(data){
				$(".filter_products").html(data);
			}
		});
	});

	function get_filter(class_name){
		var filter = [];
		$('.'+class_name+':checked').each(function(){
			filter.push($(this).val());
		});
		return filter;
	}


	// get price depends on size
	$("#getPrice").on('change', function(){
		var size = $(this).val();
		if(size != ""){
			var product_id = $(this).attr("product-id");
			$.ajax({
				url: '/get-product-price',
				type: 'POST',
				data:{size:size, product_id:product_id},
				success: function(resp){
					$(".getAttrPrice").html('TK. '+resp);
				},
				error: function(){
					console.log("Error");
				}
			});
		}
	});

});