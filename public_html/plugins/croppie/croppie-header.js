
$(function(){

	/* Recorte de las fotos de portada de stores
	---------------------------------------------------- */
	var basic = $('.recorte').croppie({
	    viewport: {width: 740, height: 186},
	    boundary: { width: 740, height: 186 }
	});

	basic.croppie('bind', {
	    url: $('#photo_url').text()
	});

	$('.show-result-header').on('click', function(){

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

		$('#crop-data-header').submit();

	});

	/* Recorte de las fotos de portada de stores
	---------------------------------------------------- */
	var basic = $('.recorte-movil').croppie({
	    viewport: {width: 360, height: 90},
	    boundary: {width: 360, height: 90}
	});

	basic.croppie('bind', {
	    url: $('#photo_url').text()
	});

	$('.show-result-header').on('click', function(){

		// Objeto con las coordenadas
		p = $('.recorte-movil').croppie('get');

		x = p.points[0];
		y = p.points[1];
		w = p.points[2] - p.points[0];
		h = p.points[3] - p.points[1];

		$('#x').val(x);
		$('#y').val(y);
		$('#w').val(w);
		$('#h').val(h);

		$('#crop-data-header').submit();

	});

});