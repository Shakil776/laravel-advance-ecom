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
					if (resp['discount'] > 0) {
						$(".getAttrPrice").html("<span style='color:red'><del>TK. "+resp['product_price']+"</del></span> TK."+resp['final_price']);
					}else{
						$(".getAttrPrice").html('TK. '+resp['product_price']);
					}
					
				},
				error: function(){
					console.log("Error");
				}
			});
		}
	});

	// update cart quantity
	$(document).on('click', '.updateCartItems', function(){
		// if quantity minus clicked
		if ($(this).hasClass('itemMinus')) {
			var quantity = $(this).prev().val();
			if (quantity <= 1) {
				$("#errorMsgShow").show();
				$("#errorMsgShow").html("<span style='color:red'>Quantity must be 1 or greater.</span>");
				return false;
			}else{
				var new_qty = parseInt(quantity) - 1;
			}
		}
		// if quantity plus clicked
		if ($(this).hasClass('itemPlus')) {
			var quantity = $(this).prev().prev().val();
			var new_qty = parseInt(quantity) + 1;
		}

		var cartid = $(this).data('cartid');
		$.ajax({
			url: '/update-cart-quantity',
			type: 'post',
			data: {cartid:cartid,qty:new_qty},
			success: function(resp){
				$("#appendCartItems").html(resp.view);
				if (resp.status == false) {
					$("#errorMsgShow").show();
					$("#errorMsgShow").html(resp.message);
				}
			},
			error: function(){
				console.log("Error");
			}
		});
	});

	// remove cart item
	$(document).on('click', '.cartItemRemove', function(){
		var cartid = $(this).data('cartid');
		var result = confirm("Remove from Cart?");
		if(result){
			$.ajax({
				url: '/cart-remove',
				type: 'post',
				data: {cartid:cartid},
				success: function(resp){
					$("#appendCartItems").html(resp.view);
					$("#errorMsgShow").show();
					$("#errorMsgShow").html(resp.message);
				},
				error: function(){
					console.log("Error");
				}
			});
		}
	});

	// validate register form
	$("#registerForm").validate({
		rules: {
			name: "required",
			email: {
				required: true,
				email: true,
				remote: "check-email"
			},
			mobile: {
				required: true,
				// digits: true,
				minlength: 11
			},
			password: {
				required: true,
				minlength: 6
			},
			confirm_password: {
				required: true,
				minlength: 6,
				equalTo: "#password"
			},
		},
		messages: {
			name: "Please enter your name.",
			email: {
				required: "Please enter your email.",
				email: "Please enter a valid email address.",
				remote: "Email address already exists."
			},
			mobile: {
				required: "Please enter your mobile number.",
				// digits: "Mobile number must be numeric.",
				minlength: "Mobile must be at least 11 digits long."
			},
			password: {
				required: "Please enter a password",
				minlength: "Your password must be at least 6 characters long"
			},
			confirm_password: {
				required: "Please enter your confirm password",
				minlength: "Your password must be at least 6 characters long",
				equalTo: "Confirm password not match."
			},
		}
	});

	// validate login form
	$("#loginForm").validate({
		rules: {
			email: {
				required: true,
				email: true,
			},
			password: {
				required: true
			}
		},
		messages: {
			email: {
				required: "Please enter your email.",
				email: "Please enter a valid email address."
			},
			password: {
				required: "Please enter a password."
			}
		}
	});


});