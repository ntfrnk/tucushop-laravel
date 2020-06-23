
$(function(){

    $('.menu-bars').on('click', function(){
        if($('.menu-nav-movil').hasClass('menu-on')){
            $('.menu-nav-movil').removeClass('menu-on');
            $('.menu-bars i').removeClass('fa-times').addClass('fa-bars')
        } else {
            $('.menu-nav-movil').addClass('menu-on');
            $('.menu-bars i').removeClass('fa-bars').addClass('fa-times')
        }
    });

    $('#show-searchbox').on('click', function(){
        if($('.search-movil').hasClass('on')){
            $('.search-movil').removeClass('on');
            $('.search-movil').slideUp(100);
        } else {
            $('.search-movil').addClass('on');
            $('.search-movil').slideDown(100);
            $('#search-movil-field').focus();
        }
    });

    $('#search-movil-field').on('keyup', function(){
        if ( event.which == 13 ) {
            $('#form-search').submit();
		} else {
            text = $('#search-movil-field').val();
            $('#search').val(text);
        }
    });


    $('.h-toggle-features').on('click', function(){
        $('.div-toggle-features').toggle(200);
        if($('.h-toggle-features span').hasClass('on')){
            $('.h-toggle-features span').removeClass('on');
            $('.h-toggle-features span').removeClass('fa-angle-up').addClass('fa-angle-down');
        } else {
            $('.h-toggle-features span').addClass('on');
            $('.h-toggle-features span').removeClass('fa-angle-down').addClass('fa-angle-up');
        }
    });

    $('.h-toggle-tags').on('click', function(){
        $('.div-toggle-tags').toggle(200);
        if($('.h-toggle-tags span').hasClass('on')){
            $('.h-toggle-tags span').removeClass('on');
            $('.h-toggle-tags span').removeClass('fa-angle-up').addClass('fa-angle-down');
        } else {
            $('.h-toggle-tags span').addClass('on');
            $('.h-toggle-tags span').removeClass('fa-angle-down').addClass('fa-angle-up');
        }
    });

    $('.h-toggle-options').on('click', function(){
        $('.div-toggle-options').toggle(200);
        if($('.h-toggle-options span').hasClass('on')){
            $('.h-toggle-options span').removeClass('on');
            $('.h-toggle-options span').removeClass('fa-angle-up').addClass('fa-angle-down');
        } else {
            $('.h-toggle-options span').addClass('on');
            $('.h-toggle-options span').removeClass('fa-angle-down').addClass('fa-angle-up');
        }
    });

    $('.onoff').on('click', function(){
        if($('.onoff').hasClass('onoff-on')){
            $('.onoff').removeClass('onoff-on').addClass('onoff-off');
        } else {
            $('.onoff').removeClass('onoff-off').addClass('onoff-on');
        }
    });


    /* SCROLL */

	$(document).on('scroll', function(){
	    
        var top = $(document).scrollTop();
        var altura = $(document).height();
        var footer = $('footer').height();

        var alturapie = parseInt(altura - footer - 600);
		
		// Cabecera 
		if(top >= alturapie){
			$('.btn-new').css({'opacity':'0'});
		} else {
			$('.btn-new').css({'opacity':'1'});
		}
		
	});

});