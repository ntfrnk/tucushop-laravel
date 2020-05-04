
$(function(){

	/* Rutas del servidor
	---------------------------------------------------- */

	url_base = $('#url_base').text();


	/* Elegir el tipo de listado (grilla o lista)
	---------------------------------------------------- */
	$('.save-trigger').on('click', function(){
		$('#save-form').trigger('click');
	});


	/* Botón "subir una foto"
	---------------------------------------------------- */
	$('#photo-upload').on('click', function(){
		$('#photo').trigger('click');
	});

	$('#photo').on('change', function(){

		var campo_archivo = document.getElementById('photo');
		var campo = campo_archivo.files[0];
		
		if($('#photo').val()!=""){
			if(campo_archivo.files.length != 0){ 
				if(campo.size>10485760){
					notify_open("La foto no debe pesar más de 10 MB. El archivo que intentas subir pesa " + parseInt(campo.size / 1000) + " KB.");
				} else {
					spinner_open("Estamos procesando la imagen...");
					$('#form-uploader').submit();
				}
			} else {
				spinner_open("Estamos procesando la imagen...");
				$('#form-uploader').submit();
			}
		} else {
			notify_open("Debes seleccionar un archivo para subir.");
		}

	});


	/* Ordenar las fotos
	---------------------------------------------------- */
	$("#sortable").sortable({
		stop : function() {
			neworder = $("#sortable").sortable("toArray");
			$('#neworder').val(neworder);
			$('#photo-ordering').removeClass('none');
		}
	});

	$("#sortable").disableSelection();

	$('#photo-ordering').on('click', function(){
		$('#ordering').submit();
	});

});


/* Eliminar característica
---------------------------------------------------- */
function featureDelete(item_id, feature_id){
	$.ajax({
	    url: url_base + '/item/feature/delete/' + item_id + '/' + feature_id,
	    type: 'GET',
	    success: function(resp){
	        if(resp){
	        	$('#tr' + item_id + feature_id).remove();
	        } else {
	        	console.log('Error al borrar la característica.');
	        }
	    }
	});
}