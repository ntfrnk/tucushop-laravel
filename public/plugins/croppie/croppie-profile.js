
$(function(){

	/* Recorte de las fotos de portada de stores
	---------------------------------------------------- */
	var basic = $('.recorte').croppie({
	    viewport: {width: 350, height: 350},
	    boundary: { width: 350, height: 350 }
	});

	basic.croppie('bind', {
	    url: $('#photo_url').text()
	});

	$('.show-result-profile').on('click', function(){

		// Objeto con las coordenadas
		p = $('.recorte').croppie('get');

		x = p.points[0];
		y = p.points[1];
		w = p.points[2] - p.points[0];
		h = p.points[3] - p.points[1];

		$('#x').val(x);
		$('#y').val(y);
		$('#w').val(w);
		$('#h').val(h);

		$('#crop-data-profile').submit();

	});

});