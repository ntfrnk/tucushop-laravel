
$(function(){

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
	 | CAROUSEL DE ITEMS
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/


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
	            items:2
	        },
	        600:{
	            items:3
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
	            items:2
	        },
	        600:{
	            items:3
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
	            items:2
	        },
	        600:{
	            items:3
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