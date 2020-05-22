
$(function(){

	var notify_urlsite = $('#name_page').text();

	var notify_html = ''+
	'<div class="notify-bg"></div>'+
	'<div class="notify-container">'+
		'<div class="notify-box">'+
			'<div class="notify-head">'+notify_urlsite+'</div>'+
			'<a href="javascript:;" class="notify-close notify-btn-close"><i class="fa fa-times"></i></a>'+
			'<div class="notify-text"></div>'+
			'<div class="notify-divider"></div>'+
			'<div class="notify-buttons">'+
				'<button type="button" id="notify-btn-accept" class="btn btn-sm btn-primary notify-close">Aceptar</button>'+
			'</div>'+
		'</div>'+
	'</div>';

	if($("#components").length ){
		$('#components').append(notify_html);
	} else {
		$('body').append('<div id="components"></div>');
		$('#components').append(notify_html);
	}

	$('.notify-close').on('click', function(){
		$('.notify-container').hide();
		$('.notify-bg').hide();
	});

});

function notify_open(text, color){
	notify_color(color);
	$('.notify-text').html(text);
	$('.notify-bg').show();
	$('.notify-container').css({'display':'flex'});
	$('#notify-btn-accept').focus();
}

function notify_color(color){
	$('.notify-head').removeClass('notify-head-success');
	$('.notify-head').removeClass('notify-head-info');
	$('.notify-head').removeClass('notify-head-warning');
	$('.notify-head').removeClass('notify-head-danger');
	switch(color){
		case "success":
			$('.notify-head').addClass('notify-head-success');
			break;
		case "info":
			$('.notify-head').addClass('notify-head-info');
			break;
		case "warning":
			$('.notify-head').addClass('notify-head-warning');
			break;
		case "danger":
			$('.notify-head').addClass('notify-head-danger');
			break;
	}
}