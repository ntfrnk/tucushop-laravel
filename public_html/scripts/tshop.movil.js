
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