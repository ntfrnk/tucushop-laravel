
$(function(){

	/*
	 | RUTAS DEL SERVIDOR
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/

	url_base = $('#url_base').text();

	/*
	 | MENU DE USUARIO
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/

	$('.user-menu').on('click', function(){
		if($('.user-submenu').hasClass('user-submenu-on')){
			$('.user-submenu').removeClass('user-submenu-on');
		} else {
			$('.user-submenu').addClass('user-submenu-on');
		}
	});
	
	
	/*
	 | BUSCAR
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/

	$("#search").keypress(function(event) {
		valor = $(this).val();
		if(valor!=""){
			if ( event.which == 13 ) {
				$('#form-search').submit();
			}
		}
	});


	/*
	 | LOADING
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/
	
	$(".loading").on('click', function() {
		spinnOn();
	});

	$('button[type="submit"]:not([rel="submit"]), a:not([href="javascript:;"], [target="_blank"], [href^="#"])').on('click', function() {
		spinnOn();
	});


	/*
	 | ACCIONES ÚTILES
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/
	
	$(".refresh").on('click', function() {
		window.location.reload();
	});


	/*
	 | COMPRAS
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/

	$('.delivery-option').on('click', function(){
		valor = $(this).attr('rel');
		total = $('.sale').text();
		$('.delivery').text(valor);
		if(valor!=0){
			$('.total').text(parseInt(total) + parseInt(valor));
		} else {
			$('.total').text(parseInt(total));
		}
		$('#deliveryPrice').val(valor);
	});


	/*
	 | CAROUSEL DE ITEMS
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/


	/* Items sugeridos en detalle de item
	---------------------------------------------------- */
	$('#item-detail').owlCarousel({
	    margin:0,
	    nav:true,
		dots:false,
		items:1,
		responsive:{
	        0:{
				loop:false
	        },
	        600:{
				loop:false
	        },
	        1000:{
	            loop:false
	        }
	    }
	});

	$('#item-detail').on('translated.owl.carousel', function(event){
		item_actual = $('.owl-item.active .item img').attr('idph');
		item_actual = parseInt(item_actual) + 1;
		$('.n-actual').html(item_actual);
		$('.n-total').html(event.item.count);
	});

	$('.btn-photo-prev').on('click', function(){
		$('#item-detail').trigger('prev.owl.carousel')
	});

	$('.btn-photo-next').on('click', function(){
		$('#item-detail').trigger('next.owl.carousel')
	});


	/* Items sugeridos en detalle de item
	---------------------------------------------------- */
	$('#home-offers').owlCarousel({
	    loop:true,
	    margin:15,
	    nav:true,
	    dots:false,
	    navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
	    responsive:{
	        0:{
				items:2,
				center:true
	        },
	        600:{
				items:3,
				center:true
	        },
	        1000:{
	            items:4
	        }
	    }
	});

	$('.home-offers.carousel-next').on('click', function(){
		$('#home-offers .owl-next').trigger('click');
	});

	$('.home-offers.carousel-prev').on('click', function(){
		$('#home-offers .owl-prev').trigger('click');
	});



	/* Items sugeridos en detalle de item
	---------------------------------------------------- */
	$('#suggested').owlCarousel({
	    loop:true,
	    margin:15,
	    nav:true,
	    dots:false,
	    navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
	    responsive:{
	        0:{
				items:2,
				center:true
	        },
	        600:{
				items:3,
				center:true
	        },
	        1000:{
	            items:4
	        }
	    }
	});

	$('.suggested.carousel-next').on('click', function(){
		$('#suggested .owl-next').trigger('click');
	});

	$('.suggested.carousel-prev').on('click', function(){
		$('#suggested .owl-prev').trigger('click');
	});


	/* Items random en detalle de item
	---------------------------------------------------- */
	$('#random').owlCarousel({
	    loop:true,
	    margin:15,
	    nav:true,
	    dots:false,
	    navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
	    responsive:{
	        0:{
				items:2,
				center:true
	        },
	        600:{
				items:3,
				center:true
	        },
	        1000:{
				items:6,
				slideBy: 2
	        }
	    }
	});

	$('.random.carousel-next').on('click', function(){
		$('#random .owl-next').trigger('click');
	});

	$('.random.carousel-prev').on('click', function(){
		$('#random .owl-prev').trigger('click');
	});

});


function add_wishlist(item_id, sess){
	if(sess){
		url = url_base + '/item/like/' + item_id;
		$.get(url, {}, function(resp){
			if(resp==1){
				$('.heart-on .fa-heart').removeClass('far').addClass('fa');
			} else {
				$('.heart-on .fa-heart').removeClass('fa').addClass('far');
			}
		});
	} else {
		notify_open('Para agregar este artículo a favoritos primero debes iniciar sesión.');
	}
}


function add_cart(item_id, sess){
	spinnOn()
	if(sess){
		url = url_base + '/cart/add/' + item_id;
		$.get(url, {}, function(resp){
			if(resp==1){
				$('.cart-text').html('Quitar del carrito');
				$('.btn-cart').removeClass('btn-outline-primary').addClass('btn-secondary');
			} else {
				$('.cart-text').html('Agregar al carrito');
				$('.btn-cart').removeClass('btn-secondary').addClass('btn-outline-primary');
			}
			spinnOff()
		});
	} else {
		spinnOff()
		notify_open('Para agregar este artículo al carrito de compras primero debes iniciar sesión.');
	}
}

function remove_cart(item_id){
	url = url_base + '/cart/add/' + item_id;
	$.get(url, {}, function(resp){
		window.location.reload();
	});
}

function cart_increase(item_id){
	url = url_base + '/cart/increase/' + item_id;
	$.get(url, {}, function(){
		window.location.reload();
	});
}

function cart_decrease(item_id){
	url = url_base + '/cart/decrease/' + item_id;
	$.get(url, {}, function(){
		window.location.reload();
	});
}

function spinnOn(){
	$('.loader').show();
}

function spinnOff(){
	$('.loader').hide();
}