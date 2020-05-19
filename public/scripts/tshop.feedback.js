
$(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*
	 | REPORTAR UN BUG
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/

    $('#reporting').on('click', function(){
        $('.pop-bg').show();
        $('#m-report').show();
    });

    $('#send-report').on('submit', function(e){

        e.preventDefault();
        spinnModalOn();

        data = $(this).serialize();
    
        url = url_base + '/feedback/bugs';
    
        $.post(url, data, function(resp){
            if(resp=="ok"){
                $('.form-report').hide();
                $('.resp-report').show();
                spinnModalOff();
            }
        }, '');
        
    });


    /*
	 | ENVIAR UNA CONSULTA
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/

    $('#question').on('click', function(){
        $('.pop-bg').show();
        $('#m-question').show();
    });

    $('#send-question').on('submit', function(e){

        e.preventDefault();
        spinnModalOn();

        data = $(this).serialize();
    
        url = url_base + '/feedback/question';
    
        $.post(url, data, function(resp){
            if(resp=="ok"){
                $('.form-question').hide();
                $('.resp-question').show();
                spinnModalOff();
            }
        }, '');
        
    });

});

function pop_close(){
    $('.pop-bg').hide();
    $('.pop-container').hide();
}

function spinnModalOn(){
    spinner_html = '<div class="pop-spinner-container"><div><div class="pop-spinner"></div></div></div>';
    $('.pop-box').append(spinner_html);
}

function spinnModalOff(){
    $('.pop-spinner-container').remove();
}