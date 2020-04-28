
$(function(){

	/* Menú usuario */

	$('.user-menu').on('click', function(){
		if($('.user-submenu').hasClass('user-submenu-on')){
			$('.user-submenu').removeClass('user-submenu-on');
		} else {
			$('.user-submenu').addClass('user-submenu-on');
		}
	});


	/* Carousel */

	$('.owl-carousel').owlCarousel({
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
	})

	$('.carousel-next').on('click', function(){
		$('.owl-next').trigger('click');
	});

	$('.carousel-prev').on('click', function(){
		$('.owl-prev').trigger('click');
	});

});