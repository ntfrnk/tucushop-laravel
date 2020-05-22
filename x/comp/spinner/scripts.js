
$(function(){

	var spinner_urlsite = $('#name_page').text();

	var spinner_html = ''+
	'<div class="spinner-bg"></div>'+
	'<div class="spinner-container">'+
		'<div class="spinner-box">'+
			'<div class="spinner-head">'+spinner_urlsite+'</div>'+
			'<a href="javascript:;" class="spinner-close spinner-btn-close"><i class="fa fa-times"></i></a>'+
			'<div class="spinner-text"></div>'+
			'<div class="spinner-divider"></div>'+
		'</div>'+
	'</div>';

	if($("#components").length ){
		$('#components').append(spinner_html);
	} else {
		$('body').append('<div id="components"></div>');
		$('#components').append(spinner_html);
	}

	$('.spinner-close').on('click', function(){
		$('.spinner-container').hide();
		$('.spinner-bg').hide();
	});

});

function spinner_open(text, color){
	spinner_color(color);
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