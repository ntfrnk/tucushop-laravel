
// Enviar respuesta a consulta
function message_answer_send(messageID, answer, sender){

	$.post('process/message-answer-send.php', {
		'messageID':messageID,
		'answer':answer,
		'sender':sender
	}, function(resp){
		if(resp=="ok"){
			$('#alert-text').html('Respuesta enviada correctamente');
			$('#alert').modal('show');
			window.location.reload();
		} else {
			report("Fallo en envío de respuesta de mensaje");
			$('#alert-text').html('Error en el envío de la respuesta.');
			$('#alert').modal('show');
		}
	});

}

function validar_email(valor){
    var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    if(filter.test(valor)){
        return true;
    } else {
    	return false;
    }
}

function report(detail){
	$.post('process/reporte-bugs-auto.php', {'link':'Error funcional','detail':detail});
}

function cleantext(texto) {
    return texto.normalize('NFD').replace(/[\u0300-\u036f]/g,"");
}