$(document).ready(function() {
	/*start listing page show product usging php*/ 
		/*$("#sort").on("change", function(){
			this.form.submit();
		});*/
	/*end listing page show product usging php*/

	/*listing page show product usging ajax*/ 
	$("#sort").on('change', function(){
		var sort = $(this).val();
		var url = $("#url").val();

		$.ajax({
			url: url,
			method: 'POST',
			data: {sort:sort, url:url},
			success: function(data){
				$(".filter_products").html(data);
			}
		});
	});
});