
$(function(){

	/* Recorte de las fotos
	---------------------------------------------------- */
	var basic = $('.recorte').croppie({
	    viewport: {width: 270, height: 303},
	    boundary: { width: 270, height: 303 }
	});

	basic.croppie('bind', {
	    url: $('#photo_url').text()
	});

	$('.show-result').on('click', function(){

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

		$('#crop-data').submit();

	});

});