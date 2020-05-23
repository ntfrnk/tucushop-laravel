
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