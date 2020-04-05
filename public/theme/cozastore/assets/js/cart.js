jQuery(document).ready(function($) {

    var base_url = window.location.origin+'/'+window.location.pathname.split('/')[1]+'/';
	function number_format( number, decimals, dec_point, thousands_sep ) {
    
	    // * example 1: number_format(1234.5678, 2, '.', '');
	    // * returns 1: 1234.57
	                              
	    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
	    var d = dec_point == undefined ? "," : dec_point;
	    var t = thousands_sep == undefined ? "," : thousands_sep, s = n < 0 ? "-" : "";
	    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
	                              
	    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    }
	$('.js-addwish-b2').on('click', function(e){
		e.preventDefault();
	});

	$('.js-addwish-b2').each(function(){
		var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
		$(this).on('click', function(){
			swal(nameProduct, "is added to wishlist !", "success");

			$(this).addClass('js-addedwish-b2');
			$(this).off('click');
		});
	});

	$('.js-addwish-detail').each(function(){
		var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

		$(this).on('click', function(){
			swal(nameProduct, "is added to wishlist !", "success");

			$(this).addClass('js-addedwish-detail');
			$(this).off('click');
		});
	});

	/*---------------------------------------------*/

	$('.js-addcart-detail').each(function(){
		$(this).on('click', function(){
            var parents     = $(this).parents('.row');
            var posi = parents.find('.product_code .pointer-none').index();
            if (posi == -1) {
                posi = 0;
            }
		 	var	nameProduct = parents.find('.product_name').text(),
		 		url			= $(this).attr('url'),
		 		id 			= $(this).attr('id'),
		 		qty         = parents.find('.num-product').val(),
            	color       = parents.find('.product_clr option:selected').val(),
            	size        = parents.find('.product_siz option:selected').val(),
            	dataform	= {"id" : id, "qty" : qty, "color" : color, "size" : size, "posi" : posi};
            $.ajax({
            	url: url,
            	type: 'POST',
            	data: dataform,
            })
            .done(function(data) {
            	var res = $.parseJSON(data);
            	var ar = [];
            	var total_count = 0;
            	console.log(res);
            	$.each(res.val, function(index, val) {
            		item = '<li class="header-cart-item flex-w flex-t m-b-12">'+
								'<div class="header-cart-item-img rmov-cart" url="'+base_url+'cart/del'+'" id="'+val.rowid+'">'+
									'<img src="'+val.image_link+'" alt="IMG">'+
								'</div>'+
								'<div class="header-cart-item-txt p-t-8">'+
									'<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">'+
										val.name+
									'</a>'+
									'<span class="header-cart-item-info">'+
										val.qty+' x '+number_format(val.price,0)+'.vnđ'+
									'</span>'+
								'</div>'+
							'</li>',
					total_count += val.subtotal; 
					ar.push(item);
            	});
            	$('.js-show-cart').attr('data-notify', res.totals);
            	$('.header-cart-total span').html(number_format(total_count,0)+'.vnđ');
            	$('.header-cart-wrapitem').html(ar);
				swal(nameProduct, "is added to cart !", "success");
            })
		});
	});

    $('.change-size').change(function(event) {
        var $this = $(this),
        	x = $this.find('option:selected').index(),
        	url = $this.attr('url'),
            data = $this.val();
            id = $this.attr('attr-id'),
            $.ajax({
            	url: url,
            	type: 'POST',
            	data: {data: data,id: id},
            })
            .done(function(data) {
            	var val = $.parseJSON(data);
            	var value = [];
            	$.each(val.size.split(','), function(index, vl) {
            		item = '<option>Size '+vl+'</option>';
            		value.push(item);
            	});
            	$this.parents('tr').find('.siz').html(value);
            	$('.posi').val(x);
            })
    });
	/* REMOVE A PRODUCT IN CART */
	$('body').on('click','.rmov-cart', function(){
        var	url 		= $(this).attr('url'),
        	nameProduct = $(this).parents('.header-cart-item').find('.header-cart-item-name').text(),
        	id 			= $(this).attr('id');
        $.ajax({
        	url: url,
        	type: 'POST',
        	data: {id: id},
        })
        .done(function(data) {
        	var res = $.parseJSON(data);
        	var ar  = [];
        	var total_count = 0;
        	$.each(res.val, function(index, val) {
        		item = '<li class="header-cart-item flex-w flex-t m-b-12">'+
							'<div class="header-cart-item-img rmov-cart" url="'+base_url+'cart/del'+'" id="'+val.rowid+'">'+
								'<img src="'+val.image_link+'" alt="IMG">'+
							'</div>'+
							'<div class="header-cart-item-txt p-t-8">'+
								'<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">'+
									val.name+
								'</a>'+
								'<span class="header-cart-item-info">'+
									val.qty+' x '+number_format(val.price,0)+'.vnđ'+
								'</span>'+
							'</div>'+
						'</li>',
				total_count += val.subtotal; 
				ar.push(item);
        	});
            $('.header-cart-wrapitem').html(ar);
        	$('.header-cart-total span').html(number_format(total_count,0)+'.vnđ');
        	$('.js-show-cart').attr('data-notify', res.totals);
        	swal(nameProduct, 'is remove cart !', "success");
        })
	});
	/* shipping */
    $('.get_citi').change(function(event) {
        var val = parseInt($(this).val()),
            pri = parseInt($('.sub-total').attr('subtt')),
            total = val+pri;
            if (val > 0) {
                $('.notif').slideUp('slow');
                $('.sub-order').removeAttr('disabled');
            	$('.amount').html('Total: '+number_format(total,0)+'.vnđ');
            	$('.ttmount').val(total);
            }else{
                $('.notif').slideDown('slow');
                $('.sub-order').attr('disabled');
            }
    });
});