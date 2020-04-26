
$(document).on('ready', function(){

	$('.share-box').on('click', function(){

		if($('.share-box').hasClass('share-box-on')){

			$('.share-cover').hide();
			$('.share-box>.arrow').hide();
			$('.share-box>ul').hide();
			$('.share-box').removeClass('share-box-on');

		} else  {

			$('.share-cover').show();
			$('.share-box>.arrow').show();
			$('.share-box>ul').show();
			$('.share-box').addClass('share-box-on');

		}

	});
			

	$('.share-cover').on('click', function(){
		$('.share-cover').hide();
		$('.share-box>.arrow').hide();
	});

});