
$(document).on('ready', function(){

	$('.keyword').on('keyup', function(){
		keyword = $(this).val();
		$.post('process/help-search.php', {'keyword':keyword}, function(resp){
			$('.topics').html(resp);
		});
	});

	$('.help-list>li>a').on('click', function(){
		$('.help-list ul').slideUp();
		id = $(this).attr('rel');
		$('#cat-'+id).slideDown();
	});

});