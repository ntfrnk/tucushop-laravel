
$(document).on('ready', function(){

	$('.contact-send').on('click', function(){
		message = $('#contact-message').val();
		storeID = $('#storeID').html();
		$.post('process/send-contact.php', {'message':message, 'storeID':storeID}, function(resp){
			if(resp=="ok"){
				$('#alert-reload-text').html("¡Perfecto! Tu mensaje fue enviado con éxito.");
				$('#alert-reload').modal('show');
			} else {
				report("Error al enviar una consulta desde tienda.");
				$('#alert-text').html("El mensaje no pudo enviarse correctamente. Por favor, vuelve a intentarlo más tarde.");
				$('#alert').modal('show');
			}
		});
	});

});

function schedule(locationID){
	$.post('process/tienda-schedules.php', {'Id':locationID}, function(resp){
		$('.schedule-content').html(resp);
		$('#schedules').modal('show');
	});
}