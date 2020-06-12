
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

});