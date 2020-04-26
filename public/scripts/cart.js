
$(document).on('ready', function(){

	// Vaciar el carrito

	$('.trash-cart').on('click', function(){
		if(confirm('Estás seguro de que quieres vaciar el carrito?')) {
			$.post('process/trash-cart.php', {}, function(resp){
				if(resp=="ok"){
					window.location.reload();
				} else {
					alert("Error al vaciar del carrito. Por favor intente más tarde.");
				}
			});
		}
	});

	// Eliminar un producto del carrito

	$('.remove-cart').on('click', function(){
		productID = $(this).attr('rel');
		if(confirm('Quieres eliminar este producto del carrito?')) {
			$.post('process/remove-cart.php', {'productID':productID}, function(resp){
				if(resp=="ok"){
					window.location.reload();
				} else {
					alert("Error al quitar el producto del carrito. Por favor intente más tarde.");
				}
			});
		}
	});


	// Cambio de total segun unidades

	$('.quant').on('change', function(){

		id = $(this).attr('rel');
		quantity = $(this).val();
		price = $('#priceu-'+id).html();

		subtotal = parseFloat(price) * parseFloat(quantity);
		total = decimales(subtotal, 2);

		$('#pricet-'+id).html(total);

		// Calculo total
		cant_items = $('.cart_cant').html();
		
		total_compra = 0;
		
		for(i=0;i<cant_items;i++){
			precio = $('#priceu-'+i).html();
			cantidad = $('#quant-'+i).val();
			total_compra += parseFloat(precio) * parseFloat(cantidad);
		}

		$('.total-sale').html(decimales(total_compra, 2));

	});

});


function decimales(Numero, Decimales){
	var pot = Math.pow(10,Decimales);
	var num = Math.round(Numero * pot) / pot;
	var nume = num.toString().split('.');
	var entero = nume[0];
	var decima = nume[1];
	var fin;
	if(decima != undefined){
		fin = Decimales-decima.length;
	} else {
		decima = '';
		fin = Decimales;
	}
	for(i=0;i<fin;i++){
		decima+=String.fromCharCode(48);
	}
	num=entero+'.'+decima;
	return num;
}