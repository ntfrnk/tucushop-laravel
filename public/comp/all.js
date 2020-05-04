
/* GLOBAL VARS ***********************************************************************************/

var urlsite = $('#name_page').text();



/* CONTAINER COMPONENTS **************************************************************************/

if($("#components").length == 0){
	$('body').append('<div id="components"></div>');
}


/* NOTIFY ****************************************************************************************/

$(function(){

	var notify_html = ''+
	'<div class="notify-bg"></div>'+
	'<div class="notify-container">'+
		'<div class="notify-box">'+
			'<div class="notify-head">'+urlsite+'</div>'+
			'<a href="javascript:;" class="notify-close notify-btn-close"><i class="fa fa-times"></i></a>'+
			'<div class="notify-text"></div>'+
			'<div class="notify-divider"></div>'+
			'<div class="notify-buttons">'+
				'<button type="button" id="notify-btn-accept" class="btn btn-sm btn-primary notify-close">Aceptar</button>'+
			'</div>'+
		'</div>'+
	'</div>';

	$('#components').append(notify_html);

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



/* CONFIRM ***************************************************************************************/

$(function(){

	var confirm_html = ''+
	'<div class="confirm-bg"></div>'+
	'<div class="confirm-container">'+
	'<div class="confirm-box">'+
	'<div class="confirm-head">'+urlsite+'</div>'+
	'<a href="javascript:;" class="confirm-close confirm-btn-close"><i class="fa fa-times"></i></a>'+
	'<div class="confirm-text"></div>'+
	'<div class="confirm-divider"></div>'+
	'<div class="confirm-buttons">'+
	'<button type="button" id="confirm-btn-accept" class="btn btn-sm btn-primary marR10">Aceptar</button>'+
	'<button type="button" id="confirm-btn-cancel" class="btn btn-sm btn-outline-secondary confirm-close">Cancelar</button>'+
	'</div>'+
	'</div>'+
	'</div>';
	
	$('#components').append(confirm_html);
	
	$('.confirm-close').on('click', function(){
		$('.confirm-container').hide();
		$('.confirm-bg').hide();
	});
	
});

function confirm_open(text, funcion, color){

	funcion_callback = funcion[0] + '(' + funcion[1] + ',' + funcion[2] + ')';

	confirm_color(color);
	$('.confirm-text').html(text);
	$('.confirm-bg').show();
	$('.confirm-container').css({'display':'flex'});
	$('#confirm-btn-accept').attr('onclick', funcion_callback + '; confirm_close();');
	$('#confirm-btn-accept').focus();
	
}

function confirm_open_link(text, link, color){
	confirm_color(color);
	$('.confirm-text').html(text);
	$('.confirm-bg').show();
	$('.confirm-container').css({'display':'flex'});
	$('#confirm-btn-accept').attr('onclick',"window.location = '" + link + "'");
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


/* SPINNER ***************************************************************************************/

$(function(){

	var spinner_html = ''+
	'<div class="spinner-bg"></div>'+
	'<div class="spinner-container">'+
		'<div class="spinner-box">'+
			'<div class="spinner-head">'+urlsite+'</div>'+
			'<a href="javascript:;" class="spinner-close spinner-btn-close"><i class="fa fa-times"></i></a>'+
			'<div class="spinner-border text-primary" role="status">' + 
			'<span class="sr-only">Loading...</span>' + 
			'</div>' + 
			'<div class="spinner-text f18"></div>'+
			'<div class="f13">(<em>Quedan sólo unos segundos</em>)</div>'+
			'<div class="spinner-divider"></div>'+
		'</div>'+
	'</div>';

	$('#components').append(spinner_html);

	$('.spinner-close').on('click', function(){
		$('.spinner-container').hide();
		$('.spinner-bg').hide();
	});

	$('.spn').on('click', function(){
		text = $(this).attr('spn-text');
		color = $(this).attr('spn-color');
		spinner_open(text, color)
	});

});

function spinner_open(text, color){
	spinner_color(color);
	if(text=="" || text==null || text==undefined){
		text = "Cargando";
	}
	$('.spinner-text').html(text);
	$('.spinner-bg').show();
	$('.spinner-container').css({'display':'flex'});
	$('#spinner-btn-accept').focus();
}

function spinner_color(color){
	$('.spinner-head').removeClass('spinner-head-success');
	$('.spinner-head').removeClass('spinner-head-info');
	$('.spinner-head').removeClass('spinner-head-warning');
	$('.spinner-head').removeClass('spinner-head-danger');
	switch(color){
		case "success":
			$('.spinner-head').addClass('spinner-head-success');
			break;
		case "info":
			$('.spinner-head').addClass('spinner-head-info');
			break;
		case "warning":
			$('.spinner-head').addClass('spinner-head-warning');
			break;
		case "danger":
			$('.spinner-head').addClass('spinner-head-danger');
			break;
	}
}


/* POP MODAL *************************************************************************************/

$(function(){

	var pop_html = ''+
	'<div class="pop-bg"></div>'+
	'<div class="pop-container">'+
		'<div class="pop-box">'+
			'<div class="pop-head">'+urlsite+'</div>'+
			'<a href="javascript:;" class="pop-close pop-btn-close"><i class="fa fa-times"></i></a>'+
			'<div class="pop-html"></div>'+
		'</div>'+
	'</div>';

	$('#components').append(pop_html);

	$('.pop-close').on('click', function(){
		$('.pop-container').hide();
		$('.pop-bg').hide();
	});

});

function pop_open(template, size){
	if(size!=""){
		$('.pop-box').addClass("pop-"+size);
	}
	cargar = $('#'+template).html();
	$('.pop-html').html(cargar);
	$('.pop-bg').show();
	$('.pop-container').css({'display':'block'});
	$('#pop-btn-accept').focus();
}

function pop_close(){
	$('.pop-container').hide();
	$('.pop-bg').hide();
}