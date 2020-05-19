
$(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
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

    $('#reporting').on('click', function(){
        $('.pop-bg').show();
        $('#m-report').show();
    });

    $('#question').on('click', function(){
        pop_open('modal-question', 'sm');
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