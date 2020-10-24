$(document).ready(function(){
    // check admin current password is correct or not
    $("#current_password").keyup(function(){
        var current_password = $(this).val();
        $.ajax({
            type: 'post',
            url: '/admin/current-pwd-check',
            data: {current_password:current_password},
            success: function(resp){
                if(resp == "true"){
                    $("#checkCurrentPassword").html("<font color=green>Current Password is correct.</font>");
                }else if(resp == "false"){
                    $("#checkCurrentPassword").html("<font color=red>Current Password is incorrect.</font>");
                }
            },
            error: function(){
                console.log("Error");
            }
        });
    }); 

    // change section status
    $(document).on("click", ".changeSectionStatus", function(){
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
        
        $.ajax({
            type: 'post',
            url: '/admin/section-status',
            data: {status:status, section_id:section_id},
            success: function(resp){
                if(resp['status'] == 0){
                    $("#section-"+section_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>");
                } else if(resp['status'] == 1){
                    $("#section-"+section_id).html("<i class='fas fa-toggle-on' status='Active'></i>");
                }
            },
            error: function(){
                console.log("Error");
            }
        });
    });

    // change category status
    $(document).on("click", ".changeCategoryStatus", function(){
        var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id");
        
        $.ajax({
            type: 'post',
            url: '/admin/category-status',
            data: {status:status, category_id:category_id},
            success: function(resp){
                if(resp['status'] == 0){
                    $("#category-"+category_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>");
                } else if(resp['status'] == 1){
                    $("#category-"+category_id).html("<i class='fas fa-toggle-on' status='Active'></i>");
                }
            },
            error: function(){
                console.log("Error");
            }
        });
    });

    // change product status
    $(document).on("click", ".changeProductStatus", function(){
        var status = $(this).children("i").attr("status");
        var product_id = $(this).attr("product_id");
        
        $.ajax({
            type: 'post',
            url: '/admin/product-status',
            data: {status:status, product_id:product_id},
            success: function(resp){
                if(resp['status'] == 0){
                    $("#product-"+product_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>");
                } else if(resp['status'] == 1){
                    $("#product-"+product_id).html("<i class='fas fa-toggle-on' status='Active'></i>");
                }
            },
            error: function(){
                console.log("Error");
            }
        });
    });

    // change product attribute status
    $(document).on("click", ".changeAttributeStatus", function(){
        var status = $(this).children("i").attr("status");
        var attribute_id = $(this).attr("attribute_id");
        
        $.ajax({
            type: 'post',
            url: '/admin/attribute-status',
            data: {status:status, attribute_id:attribute_id},
            success: function(resp){
                if(resp['status'] == 0){
                    $("#attribute-"+attribute_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>");
                } else if(resp['status'] == 1){
                    $("#attribute-"+attribute_id).html("<i class='fas fa-toggle-on' status='Active'></i>");
                }
            },
            error: function(){
                console.log("Error");
            }
        });
    });

    // change product image status
    $(document).on("click", ".changeImageStatus", function(){
        var status = $(this).children("i").attr("status");
        var image_id = $(this).attr("image_id");
        
        $.ajax({
            type: 'post',
            url: '/admin/image-status',
            data: {status:status, image_id:image_id},
            success: function(resp){
                if(resp['status'] == 0){
                    $("#image-"+image_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>");
                } else if(resp['status'] == 1){
                    $("#image-"+image_id).html("<i class='fas fa-toggle-on' status='Active'></i>");
                }
            },
            error: function(){
                console.log("Error");
            }
        });
    });

    // change brand status
    $(document).on("click", ".changeBrandStatus", function(){
        var status = $(this).children("i").attr("status");
        var brand_id = $(this).attr("brand_id");
        
        $.ajax({
            type: 'post',
            url: '/admin/brand-status',
            data: {status:status, brand_id:brand_id},
            success: function(resp){
                if(resp['status'] == 0){
                    $("#brand-"+brand_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>");
                } else if(resp['status'] == 1){
                    $("#brand-"+brand_id).html("<i class='fas fa-toggle-on' status='Active'></i>");
                }
            },
            error: function(){
                console.log("Error");
            }
        });
    });

    // change slider status
    $(document).on("click", ".changeSliderStatus", function(){
        var status = $(this).children("i").attr("status");
        var slider_id = $(this).attr("slider_id");
        
        $.ajax({
            type: 'post',
            url: '/admin/slider-status',
            data: {status:status, slider_id:slider_id},
            success: function(resp){
                if(resp['status'] == 0){
                    $("#slider-"+slider_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>");
                } else if(resp['status'] == 1){
                    $("#slider-"+slider_id).html("<i class='fas fa-toggle-on' status='Active'></i>");
                }
            },
            error: function(){
                console.log("Error");
            }
        });
    });

    // hide message
    $("#statusMessage").click(function(){
        $(this).hide();
    });

    // append categories level
    $("#section_id").change(function(){
        var section_id = $(this).val();
        $.ajax({
            type: 'post',
            url: '/admin/append-categories-level',
            data: {section_id:section_id},
            success: function(resp){
                $("#appendCategoriesLevel").html(resp);
            },
            error: function(){
                console.log("Error");
            }
        });
    });

    // delete using sweetalert 2
    $(document).on("click", ".confirmDelete", function(){
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
              window.location.href="/admin/delete-"+record+"/"+recordid;
            }
        });
    });

    // add attributes add/remove input field dynamically
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="size[]" id="size" placeholder="Size" style="margin-right:3px;margin-top:5px;width:100px" required=""/><input type="text" name="sku[]" id="sku" placeholder="SKU" style="margin-right:3px;margin-top:5px;width:100px" required=""/><input type="number" name="price[]" id="price" placeholder="Price" style="margin-right:3px;margin-top:5px;width:100px" required=""/><input type="number" name="stock[]" id="stock" placeholder="Stock" style="margin-right:3px; margin-top:5px;width:100px" required=""/><a href="javascript:void(0);" class="remove_button text-danger">&nbsp;<i class="fas fa-trash-alt text-danger"></i></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    






    

    // csrf token setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});