var _token = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function (e) {

    $('#flash-message').fadeOut(10000);
    
    $('#search-order').keydown(function (e) {

        var keyword = $(this).val();
        var body = $('#order-body');
    });

    $('#search-haggler').keyup(function (e) {
        
        var keyword = $(this).val();
        var body = $('#hagglers-list');
        if ($(this).val().length === 0 || $(this).val().length === 1) {
            var myObject = { method: "POST", url:'/haggler/featured', data:{  _token:_token } };
        } else {
            var myObject = { method: "POST", url:'/haggler/search', data:{ keyword:keyword, _token:_token } };
        }
        Searches(myObject,body);
    });

    $('#bargain-list').keydown(function (e) {

        var keyword = $(this).val();
        var body = $('#lists');
        var myObject = { method: "POST", url: "/list-search", data: { keyword:keyword, _token:_token } };
        Searches(myObject,body);
    });

    $('#search-category').keydown(function (e) {

        var keyword = $(this).val();
        var category = $(this).data('category');
        var myObject = { method: "POST", url: "/fulltext", data: { category:category ,keyword:keyword, _token:_token} };
        var body = $('#filter');
        Searches(myObject, body);
    })

    $('#search-by-name').keydown(function(event){

        var tag = $(this).val();
        var body = $('.product-table');
        var myObject = { method: "POST", url: "/search-by-name" , data: { tag:tag ,_token:_token }};
        body.html(" ");
        Searches(myObject, body);
    });

    $('#find-haggler').keypress(function(event){

        var name = $(this).val();
        var body = $('.haggler-list');
        var myObject = { method: "POST", url: "/search-haggler" , data: { name:name, _token:_token }};
        Searches(myObject, body);
    });

});

$(document).on('click','#openFileDialog' , function() {
    
    $('#file').click();
})

.on('change','#file', function() {
    
    var $preview = $('#subImage').empty();
    if ( this.files.length>4 ){
        alert('you reached the maximum of 4');
    }
    else {
        if (this.files) $.each(this.files, readAndPreview);

        function readAndPreview(i, file) {
        
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
            
                return alert(file.name +" is not an image");
            }
            var reader = new FileReader();
            $(reader).on("load", function() {
                $preview.append($("<img/>", {src:this.result, style:"height:90px;margin:5px;"}));
            });
            reader.readAsDataURL(file);
        }
    }
})

.on('click','#openFileDisplay' , function() {
    
    $('#displayfile').click();
})

.on('change','#displayfile', function() {
    var $preview = $('#preview').empty();
    if ( this.files.length>1 ){
        alert('you reached the maximum of 4');
    }
    else {
        if (this.files) $.each(this.files, readAndPreview);

        function readAndPreview(i, file) {
            
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
                return alert(file.name +" is not an image");
            }

            var reader = new FileReader();
            $(reader).on("load", function() {
                $preview.append($("<img/>", {src:this.result, style:"width:100%;"}));
            });

            reader.readAsDataURL(file);
        }
    }
})

.on('change','#change-dp', function(e) {
    e.preventDefault();
    switch($(this).val()) {
        case "Take Photo":

        break;
        case "Browse photo":
            $('#file').click();
        break;
    }
})

.on('change','#file', function(e) {
    
    var $preview = $('#image-dp').empty();

    if (this.files) $.each(this.files, readAndPreview);
    function readAndPreview(i, file) {
        if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
        return alert(file.name +" is not an image");
    }
    var reader = new FileReader();
        $(reader).on("load", function() {
            $preview.append($("<img/>", {src:this.result, style:"width:100%;max-width:250px;"}));
        });
     reader.readAsDataURL(file);
    }
})

.on('click', '.upload-image', function(e){

    $(this).parents("form").ajaxForm(options);

    var options = {
        complete: function(response) {
            if($.isEmptyObject(response.responseJSON.error)){
                alert('Image Upload Successfully.');
            }else{
                printErrorMsg(response.responseJSON.error);
            }
        }
    };

    function printErrorMsg (msg) {
        $.each( msg, function( key, value ) {
           alert(value);
        });
    }
})

.on('click','button[data-bargain]',function() {
    
    var id = $(this).data('bargain'), price = $('#price').val(), qty = $('#qty').val(), 
    user = $(this).data('user'), msg = $('#msg').val() ;
    var myObject = { url:'/bargain', method: 'POST',
        data: { id:id, user:user, price:price, qty:qty, msg:msg, _token:_token}
    };
    bargainAjax(myObject);
})

.on('click','a[data-deal]', function(e) {

    e.preventDefault();

    var id = $(this).data('deal');

    $('#order-id').removeAttr('data-order');

    $.ajax({
        method: "POST",
        url: "/bargain/modal-deal",
        data: { id:id, _token:_token } 
    }).done( data => {

        $.each(data, function(index, element){
            
            $('#deal-name').html(element.name);
            $('#deal-img').attr('src', baseUrl+"storage/" + element.user_photo);
            $('#deal-stock').html(element.quantity_offer);
            $('#deal-price').html(element.price_offer);
            $('#info-phone').html(element.phone_number);
            $('#info-email').html(element.email_address);
            $('#order-id').attr('data-order', element.id);
        }); 
    })
})

.on('click', '#order-id', function(e) {
    e.preventDefault();

    var id = $(this).data('order');

    $.ajax({
        type: "POST",
        url: "/bargain/accept-order",
        data: {
            id:id,
            _token:_token
        },
        success: function(data) {
            
            alert("You accept this offer!!!");
        }
    });
})

.on('click','button[data-placeorder]', function(e) {
    e.preventDefault();
    
	var id = $(this).data('placeorder');
    var result = $('button[data-result]').data('result');

	$.ajax({
		type: "POST",
		url: "/billing",
		data: {
			id:id,
			fname:$('#fname').val(),
			address:$('#address').val(),
			city:$('#city').val(),
			zip:$('#zip').val(),
			email:$('#email').val(),
			number:$('#number').val(),
			otherNote:$('#otherNote').val(),
            result: result,
			_token:_token
		},
		success: function(data) {

			if(data.includes('buyer')) {

				window.location.href = "/billing/order/summary/order-number="+id;
			}
			else if(data.includes('seller')) {

			    window.location.href = "/";
            }
			else {

                alert(data);
			}
		}
	});
})

.on("click","input[name='radio']", function(e) {
	switch ( $(this).val() ) {
		case "Cash on delivery":
			$('#shipment-quote').html(" ");
			$('#shipment-quote').append("<p style='font-weight:600;'>Pay at your doorstep</p>");
			$('#shipment-quote').append("<p style='margin-top:1%;'>You can pay in cash to our courier when you receive the goods at your doorstep</p>");
			$('#shipment-quote').append("<a class='btn btn-default red-btn' style='margin-top:10%;'>Place your order</a>");
		break;
		case "Paypal":
			$('#shipment-quote').html(" ");
			$('#shipment-quote').append("<p style='font-weight:600;'>You can pay with your paypal account</p>");
			$('#shipment-quote').append("<p style='margin-top:1%;'>You can pay only for a hassle free service</p>");
			$('#shipment-quote').append("<a class='btn btn-default red-btn' style='margin-top:10%;'>Place your order</a>");
		break;
	}
})

.on('click', '#pyo-btn', function() {

	$.ajax({
		type: "POST",
		url: "/billing/order/deal",
		data: {
			products_id: $('#products_id').html(),
			billing_id: $('#billing_id').html(),
			shippingFee: $('#shippingFee').html(),
			mop: $('input[name="radio"]').attr('value'),
			_token: _token
		},
		success: function(data) {

			window.location.href = "/deliveryinformation/trackingnumber=" + data;
		}
	});

})

.on('click', '#sad', function(e) {

    $.ajax({
        type: "POST",
        url: "/tite",
        data: { _token:_token},
        success: function(tangina) {
            alert(tangina);
        }
    });
})

.on('click', 'a[data-featured]', function(e) {

    e.preventDefault();
    
    var id = $(this).data('featured');

    $('.modal-body').attr('data-pid', id);

    $('#promote').css("display", "block");

    $('#payment').css("display", "none");

    $('#form').css("display", "none");

    $('#choosenPromote').html(" ");

    $('#choosenPayment').html(" ");

})

.on('click', 'a[data-promote]', function(e) {

    e.preventDefault();
    
    var id = $(this).data('promote');

    $('.modal-title').html("Payment option");

    $('.modal-body').attr('data-promd', id);

    $('#choosenPromote').html($(this).html());

    $('#promote').css("display", "none");

    $('#payment').css("display", "block");

})

.on('click','a[data-payment]', function(e) {

    e.preventDefault();

    var id = $(this).data('payment');

    $('.modal-title').html("Confirm");

    $('.modal-body').attr('data-payoption', id);

    $('#choosenPayment').html($(this).html());

    $('#payment').css("display", "none");

    $('#form').css("display", "block");

    $(".modal-footer").append("<button class='btn btn red-btn' id='upgradeproduct'>Buy</button>");
})

.on('click', '#upgradeproduct', function(e){

    e.preventDefault();

     var product_id = $('div[data-pid]').data('pid');
     var promo = $('div[data-promd]').data('promd'); 
     var payment = $('div[data-payoption]').data('payoption');
     var pass = $('#pass').val();

     $.ajax({
        type: "POST",
        url: "/buypromo",
        data: {
            product_id:product_id,
            promo:promo,
            payment:payment,
            pass:pass,
            _token:_token
        },
        success: function(data) {
            alert(data);
        }
     });

})

.on('click','input[data-value]', function(e) {

    var id = $(this).data('value');

    $.ajax({

        type: "POST",
        url: "/addnewcategory",
        data: {
            id:id,
            _token:_token
        },
        success: function(data) {

            window.location.href = "/category/" + data;
        }   

    });
})


.on('click', '#update-name', function (e) {

    e.preventDefault();

    $('#nav-name').html("");

    var data = {
        name: $('#name').val(),
        _token: _token
    };

    $.ajax({
        type: "POST",
        url: "/update-name",
        data: data,
        success: function (data) {

            $('#nav-name').html($('#name').val());
            alert(data);
        }
    });

})

.on('click', '#update-contact', function (e) {

    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "/update-contact",
        data: {
            email: $('#email').val(),
            number: $('#number').val(),
            city: $('#city').val(),
            _token: _token
        },
        success: function (data) {

            alert(data);
        }
    })
})

.on('click', '#update-detail', function (e) {

    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "/update-detail",
        data: {
            about: $('#about').val(),
            address: $('#address').val(),
            _token: _token
        },
        success: function(data) {

            alert(data);
        }

    });
})

.on('change', '#search-by-category', function(e) {

    var category = $(this).val();
    var url = "/search-by-category";

    filterStoreProduct(category,url);
})

.on('click', 'input[data-comment]', function() {

    var id = $(this).data('comment');
    var comment = $('#comment-area').val();
    var rating = $('input[name="radio"]').attr('value');

    alert(rating);

    $.ajax({
        type: "POST",
        url: "/add-comment",
        data: {id:id, comment:comment, rating:rating,  _token:_token},
        success:function (data) {

            $('#product-comments').html(data);
        }
    });
})

.on('click', 'a[data-buy]', function(e) {

    var id = $(this).data('buy');
    var qty = $('#qty-stock').val();
    var offer_price = $('#offer_price').val();
    var data = {id:id, qty:qty, offer_price:offer_price, _token:_token};
    $.ajax({
        type: "POST",
        url: "/buy/send-notif",
        data: data,
        success: function(data) {

            alert(data);
        }
    });
})

.on('click', '#notification', function (e) {

    $.ajax({

        type: "POST",
        url: "/notification",
        data: {_token:_token},
        success: function (data) {

            if(data.includes('empty')) {

                $('#notif-content').html("<center style='margin-top:30%;'><h4>No notification</h4></center>");
            }
            else {
                $('#notif-content').html(data);
            }
        }
    });
})

.on('click', 'a[data-accept]', function (e) {

    var id = $(this).data('accept');

    $.ajax({
        type: "POST",
        url: "/accept-buy-offer",
        data: { id:id, _token:_token},
        success:function (data) {

            $('#deal-content').html(data);

            $('#order-id').attr('data-uporder', id);
        }
    });
})

.on('click', 'a[data-uporder]', function (e) {

    var id = $(this).data('uporder');

    $.ajax({
        type: "POST",
        url: "/update-order",
        data: {id:id , _token:_token},
        success:function (data) {

            window.location.href = "/billing/seller/"+data;
        }
    });
})

//store ajax pagination
.on('click', '#store-page a', function (e) {

    e.preventDefault();
    var data = $(this).attr('href').split('page=')[1];
    var url = '/product/store?page=' + data;

    $('.product-table').html(' ');
    
    $.ajax({
        method: "GET",
        url: '/page/store?page=' + data,
    }).done(function (result) {

        $('.product-table').html(result);

        location.hash = data;
    });
})

.on('change', 'select[data-filter]', function(e) {

    var params = $('div[data-route]').data('route');

    switch($(this).data('filter')) {

        case "price":
            
            var data = { key:params, filterBy:$(this).val(), _token:_token };
            var url = "/filter-by-price";
            filterSearch(data, url);
            break;
        case "date":

            var data = { key:params, filterBy:$(this).val(), _token:_token };
            var url = "/filter-by-date";
            filterSearch(data, url);
            break;
        case "category":
            var data = { key:params, filterBy:$(this).val(), _token:_token };
            var url = "/filter-by-category";
            filterSearch(data, url);
            break;
    }


})

.on('change', 'select[data-haggler]', function(e) {

    var id = $(this).data('id');

    switch($(this).data('haggler')){

        case "category":

            var data = {id:id , category:$(this).val(), _token:_token};
            var url = "/user-product-category-filter";
            filterProdHaggler(data, url);
            break;
        case "date":

            var data = {id:id , date:$(this).val(), _token:_token};
            var url = "/user-product-date-filter";
            filterProdHaggler(data, url);
            break;
        case "price":

            var data = {id:id , price:$(this).val(), _token:_token};
            var url = "/user-product-price-filter";
            filterProdHaggler(data, url);
            break;
    }
})

.on('change', '#supply-demand', function(e) {

    var id = $(this).val();
    var data = {id:id, _token:_token};
    
    if (id === "all")
    {
        storeDemand(data);
        storeSupply(data);
    }
    else 
    {
        demandAjax(data);
        supplyAjax(data);    
    }
})

.on('click','#qty-plus', function(e) {
    
    
    var qty = $('#qty-stock').val();
    var stock = $('#stock').html();
    var price = $('#offer_price').val();
    if (stock !== qty) {

        var newStock = parseInt(qty) + 1;
        var newprice = parseInt(price) * parseInt(newStock);
        $('#qty-stock').css('border-color', '#ccc');
        $('#qty-stock').val(newStock);
        $('#offer_price').val(" ");
    }
    else if(stock === qty) {

        $('#qty-stock').css('border-color', 'red');
    }

})
    
.on('click','#qty-minus', function(e) {

    $('#qty-stock').css('border-color', '#ccc');
    var qty = $('#qty-stock').val();
    var price = $('#offer_price').val();
    var newStock = parseInt(qty) - 1;

    if (newStock < 1) {
        $('#qty-stock').val(1);
    } else {
        var newprice = parseInt(price) * parseInt(qty);
        $('#qty-stock').val(newStock);
        $('#offer_price').val(" ");
    }
})
    
.on('change', '#category-navigation', function(e) {

    var link = $(this).val().split(/[ ,]+/).join('-');
    window.location.href = "/category/"+link;
})

.on('click', 'input[data-category]', function(e) {
    
    var category = $('div[data-value]').data('value');
    
    $.ajax({
        method: "POST",
        url: '/search',
        data: { category:category , filter:$(this).val() ,_token:_token}
    }).done( response => {

        console.log(response);
    });
})

.on('click', 'a[data-store]', function(e) {

    $('#prod_name').text(" ");
    $.ajax({
        method: 'POST',
        url: '/store-modal-edit',
        data: { id:$(this).data('store'), _token:_token }
    }).done( response => {
        $('#prod_name').removeData('id');
        for (var i in response )
        {
            $('#prod_name').text(response[i].product_name);
            $('#prod_name').attr('data-id', response[i].id);
            $('#product_price').val(response[i].product_regular_price);
        }
    });
})

.on('click','a[data-haggle]', function (e) {

    var id = $('#prod_name').data('id');
    var type = $(this).data('haggle');

    $.ajax({
       method: 'POST',
       url: '/product-make-bargain',
       data: { id:id, type:type, _token:_token}  
    }).done( response => {
        alert(response);
    });
})

.on('click','button[data-move]', function (e){

    var ids = [];

    if($(this).data('move') === "move")
    {   
        $(this).removeData('move');
        $(this).attr('data-move', 'save');
        $('div[data-id]').each(function(){
            
            $(this).css('cursor','move');
        });
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
        
        $(this).text('Save'); 
    }
    else 
    {   
        $(this).removeData('move');
        $(this).attr('data-move', 'move');
        $('div[data-id]').each(function(){
            
            var id = $(this).data('id');
            ids.push(id);
            $(this).css('cursor','default');
        });

        $.ajax({
            method: 'POST',
            url: '/change-position',
            data: { ids:ids, _token:_token}
        }).done(response => {

            alert(response);
        });
        
        $(this).text('Move');
    }
})

.on('click', 'button[data-group]', function(){

    alert($(this).data('group'));
})

.on('click','#con-shop', function () {
    
    $.ajax({
        method: 'POST',
        url: '/continue-shopping',
        data: { _token:_token }
    }).done( function (data) {

        window.location.href = "/";
    });
})

.on('click','li[data-clone]', function () {

    var id = $(this).data('clone');

    $.ajax({
        method: 'POST',
        url: '/clone-product',
        data: { _token:_token, id:id }
    }).done( response => {
        
        var dom;
        for (var i in response)
        {
            dom = "<div data-modalid='"+response[i].id+"' style='border-bottom:1px solid #333;'>"+ 
            
            response[i].product_name +
            
            "</div>";
        }

        $('.pro-list').append( dom );
    });
})

.on('click', '#group', function() {
    
    var array = [];
    $('div[data-modalid]').each(function(a, b) {
        
        var id = $(this).data('modalid');

        array.push(id);
    });
    
    $.ajax({
        method: 'POST',
        url: '/create-group',
        data: { array:array.slice(0,leng) , name:$('#g_name').val(),  _token:_token}
    }).done( response => {
    
        alert(response);
    });
})

.on('click', '#product-message', function (event) {

    $.ajax({
        method: 'POST',
        url: '/modal-send-message',
        data: { 
            sellerId:$('#seller-id').text(),
            body:$('#message-body').val(),
            _token:_token 
        }
    }).done( response => {

        alert( response );
    });
});