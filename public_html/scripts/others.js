
$(document).on('ready', function(){

	superplaceholder({
		el: keyword,
		sentences: [ 'Escribe lo que estás buscando...', 'blusa', 'zapatos', 'pantalón', 'perfume' ],
		options: {
			letterDelay: 80,
			loop: true,
			autoStart: true
		}
	});

});