
$(document).on('ready', function(){

	/* UPDATE PROFILE ************************************************/

	$('.guardar-profile').on('click', function(){

		userID = $('#userID').html();
		name = $('#profile-name').val();
		lastname = $('#profile-lastname').val();
		birthday = $('#profile-birthday').val();
		dni = $('#profile-dni').val();
		genre = $('#profile-genre').val();
		email = $('#profile-email').val();
		phone = $('#profile-phone').val();
		cellphone = $('#profile-cellphone').val();
		address = $('#profile-address').val();
		areaID = $('#profile-areaID').val();

		if(name!="" && lastname!="" && birthday!="" && email!=""){

			$.post('process/user-update-profile.php', {
				'name':name,
				'lastname':lastname,
				'birthday':birthday,
				'dni':dni,
				'genre':genre,
				'email':email,
				'phone':phone,
				'cellphone':cellphone,
				'address':address,
				'areaID':areaID,
				'userID':userID
			}, function(resp){

				if(resp=="ok"){
					nalert('<b>Perfecto!</b> Los datos se actualizaron correctamente.');
				} else {
					report("Error al actualizar los datos de usuario.");
					nalert('Ocurrió un error al actualizar los datos. Por favor inténtalo de nuevo.');
				}

			});

		} else {

			nalert('Los campos con el (*) no pueden quedar vacíos.');

		}

	});


	/* SAVE / UPDATE DELIVERY INFO ***********************************/

	$('.guardar-delivery').on('click', function(){

		userID = $('#userID').html();
		name = $('#delivery-name').val();
		lastname = $('#delivery-lastname').val();
		dni = $('#delivery-dni').val();
		phone = $('#delivery-phone').val();
		cellphone = $('#delivery-cellphone').val();
		address = $('#delivery-address').val();
		areaID = $('#delivery-areaID').val();
		postalcode = $('#delivery-postalcode').val();

		$.post('process/user-update-delivery.php', {
			'name':name,
			'lastname':lastname,
			'dni':dni,
			'phone':phone,
			'cellphone':cellphone,
			'address':address,
			'areaID':areaID,
			'postalcode':postalcode,
			'userID':userID
		}, function(resp){

			if(resp=="ok"){
				nalert('<b>Perfecto!</b> Los cambios se guardaron correctamente.');
			} else {
				report("Error al actualizar datos de envio.");
				nalert('Ocurrió un error al guardar los datos. Por favor inténtalo de nuevo.');
			}

		});

	});


	/* CAMBIO DE CONTRASEÑA ******************************************/

	// Valida contraseña actual
	$('#pass-passnow').on('keyup', function(){
		var pass = $(this).val();
		var userID = $('#userID').html();
		$.post('process/user-passnow.php',{'userID':userID,'pass':pass}, function(resp){
			if(resp=="si"){
				$('.passnow-cont').removeClass('has-error');
				$('.passnow-cont').addClass('has-success');
				$('.feedback-passnow').removeClass('fa-times');
				$('.feedback-passnow').addClass('fa-check');
				$('.vpassnow').html('1');
			} else {
				$('.passnow-cont').removeClass('has-success');
				$('.passnow-cont').addClass('has-error');
				$('.feedback-passnow').removeClass('fa-check');
				$('.feedback-passnow').addClass('fa-times');
				$('.vpassnow').html('');
			}
		});
	});

	// Valida contraseña
	$('#pass-pass').on('keyup', function(){
		var pass = $(this).val();
		var longPass = pass.length;
		if(longPass<8) {
			$('.pass-cont').removeClass('has-success');
			$('.pass-cont').addClass('has-error');
			$('.feedback-pass').removeClass('fa-check');
			$('.feedback-pass').addClass('fa-times');
			$('.vpass').html('');
		} else {
			$('.pass-cont').removeClass('has-error');
			$('.pass-cont').addClass('has-success');
			$('.feedback-pass').removeClass('fa-times');
			$('.feedback-pass').addClass('fa-check');
			$('.vpass').html('1');
		}
	});

	// Valida la repetición de contraseña
	$('#pass-repass').on('keyup', function(){
		var repass = $(this).val();
		var pass = $('#pass-pass').val();
		if(repass!=pass) {
			$('.repass-cont').removeClass('has-success');
			$('.repass-cont').addClass('has-error');
			$('.feedback-repass').removeClass('fa-check');
			$('.feedback-repass').addClass('fa-times');
			$('.vrepass').html('');
		} else {
			$('.repass-cont').removeClass('has-error');
			$('.repass-cont').addClass('has-success');
			$('.feedback-repass').removeClass('fa-times');
			$('.feedback-repass').addClass('fa-check');
			$('.vrepass').html('1');
		}
	});

	// Confirmación del cambio
	$('.guardar-password').on('click', function(){

		vpassnow = $('.vpassnow').html();
		vpass = $('.vpass').html();
		vrepass = $('.vrepass').html();

		if(vpassnow==1 && vpass==1 && vrepass==1){
			
			userID = $('#userID').html();
			pass = $('#pass-pass').val();

			$.post('process/user-changepass.php', {'userID':userID,'pass':pass}, function(resp){
				if(resp=="ok"){
					nalert('<b>Perfecto!</b> Tu nueva contraseña se guardó correctamente.');
				} else {
					report("Error al cambiar la constraseña en stores.");
					nalert('Ocurrió un error al cambiar la contraseña. Por favor inténtalo de nuevo.');
				}
			});

		} else {

			nalert('Alguno de los datos ingresados es incorrecto.');

		}

	});


	// Quitar producto de la lista de deseos

	$('.remove-wishlist').on('click', function(){

		itemID = $(this).attr('rel');

		if(confirm('Estás seguro de que quieres eliminar este item de tu lista?')) {
			$.post('process/collection-remove-wishlist.php', {'itemID':itemID}, function(resp){
				if(resp=="ok"){
					window.location.reload();
				} else {
					report("Error al quitar un item de la lista de deseos.");
					nalert("Error al quitar el item de la lista. Por favor intente más tarde.");
				}
			});
		}

	});


	// Ver mensaje

	$('.message-read').on('click', function(){

		messageID = $(this).attr('id');
		seccion = $('#pow_seccion').html();

		$.post('process/user-message.php', {'messageID':messageID,'seccion':seccion}, function(resp){

			$('.message-show').html(resp);
			$('#message').modal('show');

		});

		//$('#message').modal('show');

	});


	/* Eliminar mensaje */

	$('.delete-message-ok').on('click', function(){

		messageID = $(this).attr('rel');

		$.post('process/message-delete.php', {'messageID':messageID}, function(resp){
			if(resp=="ok"){
				window.location.reload();
			} else {
				report("Error al eliminar mensaje.");
				nalert("El mensaje no pudo eliminarse. Contacta con el administrador.");
			}
		});

	});


	// Subir foto de perfil

	$('#profilepic').on('change', function(){

		$('.miniloading').css({'display':'block'});

		var campo_archivo = document.getElementById('profilepic');
		var campo = campo_archivo.files[0];
		
		if($('#profilepic').val()!=""){
			if(campo_archivo.files.length != 0){ 
				if(campo.size>2048000){
					nalert("La foto no debe pesar más de 2000 KB. El archivo que intentas subir pesa " + parseInt(campo.size / 1000) + " KB.");
				} else {
					$('#uploader-profilepic').submit();
				}
			} else {
				$('#uploader-profilepic').submit();
			}
		} else {
			nalert("Debes seleccionar un archivo para subir.");
		}

	});


	// Borrar foto de perfil

	$('.delete-profilepic').on('click', function() {
		if(confirm('Estás seguro de que quieres eliminar esta foto?')) {
			$.post('process/user-delete-profilepic.php', {}, function(resp){
				if(resp=="ok"){
					window.location.reload();
				} else {
					report("Error al eliminar foto de perfil de usuario.");
					nalert('No se pudo eliminar la foto. Intenta de nuevo más tarde.');
				}
			});
		}
	});


	// Preferencias

	$("#fkeyword").keypress(function(event) {
		if ( event.which == 13 ) {
			$('.addword-form').trigger('click');
		}
	});

	$('.addword-form').on('click', function(){
		keyword = $('#fkeyword').val();
		$.post('process/user-add-word-preference.php', {'keyword':keyword}, function(resp){
			if(resp=="ok"){
				window.location.reload();
			} else if(resp=="yala") {
				nalert("Ya palabra que intentas agregar ya está en tu lista.");
			} else {
				report("Error al agregar una palabra a preferencias desde formulario.");
				nalert("No se pudo agregar esta palabra. Por favor inténtalo nuevamente más tarde.");
			}
		});
	});

	$('.addword').on('click', function(){
		keyword = $(this).html();
		$.post('process/user-add-word-preference.php', {'keyword':keyword}, function(resp){
			if(resp=="ok"){
				window.location.reload();
			} else if(resp=="yala") {
				nalert("Ya palabra que intentas agregar ya está en tu lista.");
			} else {
				report("Error al agregar una palabra a preferencias desde sugerencias.");
				nalert("No se pudo agregar esta palabra. Por favor inténtalo nuevamente más tarde.");
			}
		});
	});

	$('.added').on('click', function(){
		id = $(this).attr('rel');
		$('#confirm-text').html("Estás a punto de eliminar esta palabra de tus preferencias.<br>¿Estás seguro de que quieres hacerlo?");
		$('#confirm-function').attr('onclick','deleteword('+id+')');
		$('#confirm').modal('show');

	});


});



function deleteword(idword){
	$.post('process/user-delete-word-preference.php', {'Id':idword}, function(resp){
		if(resp=="ok"){
			window.location.reload();
		} else {
			report("Error al eliminar una palabra de preferencias");
			nalert("No se pudo eliminar esta palabra. Por favor inténtalo nuevamente más tarde.");
		}
	});
}


/* Borrar mensaje */

function delete_message(id){
	$('.delete-message-ok').attr('rel',id);
	$('#confirm-delete-message-text').html('Estás a punto de finalizar esta conversación. Luego de hacer esto no podrás retomarla, y solo podrás iniciar una conversación nueva.<br>¿Realmente deseas hacerlo?');
	$('#confirm-delete-message').modal('show');
}