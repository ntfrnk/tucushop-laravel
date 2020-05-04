
$(function(){

	var confirm_urlsite = $('#name_page').text();

	var confirm_html = ''+
	'<div class="confirm-bg"></div>'+
	'<div class="confirm-container">'+
		'<div class="confirm-box">'+
			'<div class="confirm-head">'+confirm_urlsite+'</div>'+
			'<a href="javascript:;" class="confirm-close confirm-btn-close"><i class="fa fa-times"></i></a>'+
			'<div class="confirm-text"></div>'+
			'<div class="confirm-divider"></div>'+
			'<div class="confirm-buttons">'+
				'<button type="button" id="confirm-btn-accept" class="btn btn-sm btn-primary marR10">Aceptar</button>'+
				'<button type="button" id="confirm-btn-cancel" class="btn btn-sm btn-outline-secondary confirm-close">Cancelar</button>'+
			'</div>'+
		'</div>'+
	'</div>';

	if($("#components").length ){
		$('#components').append(confirm_html);
	} else {
		$('body').append('<div id="components"></div>');
		$('#components').append(confirm_html);
	}

	$('.confirm-close').on('click', function(){
		$('.confirm-container').hide();
		$('.confirm-bg').hide();
	});

});

function confirm_open(text, funcion, color){

	// Callback
	//funcion = callback.split(',');
	funcion_callback = funcion[0] + '(' + funcion[1] + ',' + funcion[2] + ')';

	confirm_color(color);
	$('.confirm-text').html(text);
	$('.confirm-bg').show();
	$('.confirm-container').css({'display':'flex'});
	$('#confirm-btn-accept').attr('onclick', funcion_callback + '; confirm_close();');
	$('#confirm-btn-accept').focus();

}

function confirm_close(){
	$('.confirm-container').hide();
	$('.confirm-bg').hide();
}

function confirm_color(color){
	$('.confirm-head').removeClass('confirm-head-success');
	$('.confirm-head').removeClass('confirm-head-info');
	$('.confirm-head').removeClass('confirm-head-warning');
	$('.confirm-head').removeClass('confirm-head-danger');
	switch(color){
		case "success":
			$('.confirm-head').addClass('confirm-head-success');
			break;
		case "info":
			$('.confirm-head').addClass('confirm-head-info');
			break;
		case "warning":
			$('.confirm-head').addClass('confirm-head-warning');
			break;
		case "danger":
			$('.confirm-head').addClass('confirm-head-danger');
			break;
	}
}