
$(function(){

	/* Recorte de las fotos de portada de stores
	---------------------------------------------------- */
	var imgToCrop = $('.recorte')
	
	imgToCrop.croppie({
	    viewport: {width: 300, height: 300},
		boundary: { width: 300, height: 300 },
		enableOrientation: true
	});

	imgToCrop.croppie('bind', {
		url: $('#photo_url').text(),
		orientation: 1
	});

	$('.photo-rotate').on('click', function() {
		posicionar = $(this).data('deg');
		posicion = $('#imgrotate').val();
		if(posicionar=="suma"){
			if(posicion != 4){
				newposicion = parseInt(posicion) + 1;
			} else {
				newposicion = 1;
			}
			grados = -90;
		} else {
			if(posicion != 1){
				newposicion = parseInt(posicion) - 1;
			} else {
				newposicion = 4;
			}
			grados = 90;
		}
		imgToCrop.croppie('rotate', parseInt(grados));
		$('#imgrotate').val(newposicion);
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