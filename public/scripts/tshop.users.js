
$(function(){

	/*
	 | RUTAS DEL SERVIDOR
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/

	url_base = $('#url_base').text();

	/*
	 | SUBIR FOTOS AL SERVIDOR
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/

	$('#photo-upload').on('click', function(){
		$('#photo').trigger('click');
	});

	$('#photo').on('change', function(){

		var campo_archivo = document.getElementById('photo');
		var campo = campo_archivo.files[0];
		
		if($('#photo').val()!=""){
			if(campo_archivo.files.length != 0){ 
				if(campo.size>5242880){
					notify_open("La foto no debe pesar más de 5 MB. El archivo que intentas subir pesa " + parseInt(campo.size / 1000) + " MB.");
				} else {
					spinnOn();
					$('#form-uploader').submit();
				}
			} else {
				spinnOn();
				$('#form-uploader').submit();
			}
		} else {
			notify_open("Debes seleccionar un archivo para subir.");
		}

	});


	/*
	 | VALIDACIONES CON AJAX
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/

	$('#email').on('keyup', function(){
		let valor = $(this).val();
		let url_post = url_base + '/user/validate/email/' + valor;
		$.get(url_post, {}, function(resp){
			if(resp=="error"){
				$('.invalid-feedback.email').text('Este correo ya se encuentra en uso.')
				$('#email').addClass('is-invalid');
				$('.invalid-feedback.email').show();
			} else {
				$('.invalid-feedback.email').hide();
				$('#email').removeClass('is-invalid');
			}
		});
	});

	$('#nickname').on('keyup', function(){
		let valor = $(this).val();
		if(valor.length<6){
			$('.invalid-feedback.nickname').text('Debes ingresar al menos 6 (seis) caracteres')
			$('#nickname').addClass('is-invalid');
			$('.invalid-feedback.nickname').show();
		} else {
			let url_post = url_base + '/user/validate/nickname/' + valor;
			$.get(url_post, {}, function(resp){
				if(resp=="error"){
					$('.invalid-feedback.nickname').text('Este nombre de usuario ya se encuentra en uso.')
					$('#nickname').addClass('is-invalid');
					$('.invalid-feedback.nickname').show();
				} else {
					$('.invalid-feedback.nickname').hide();
					$('#nickname').removeClass('is-invalid');
				}
			});
		}
	});

	$('#password').on('keyup', function(){
		let valor = $(this).val();
		if(valor.length!=0){
			if(valor.length<6){
				$('.invalid-feedback.password').text('Debes ingresar al menos 6 (seis) caracteres')
				$('#password').addClass('is-invalid');
				$('.invalid-feedback.password').show();
			}
		} else {
			$('.invalid-feedback.password').hide();
			$('#password').removeClass('is-invalid');
		}
	});


});

function validarEmail(valor) {
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(valor)){
		return true;
	} else {
		return false;
	}
}