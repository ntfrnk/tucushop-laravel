
$(document).on('ready', function(){

	// Mostrar contraseña
	$('.showpass').on('click', function(){
		if($('.showpass').hasClass('oki')){
			$('.showpass').removeClass('oki');
			$('.showpass').val('0');
			$('#login-pass').attr('type','password');
		} else {
			$('.showpass').addClass('oki');
			$('.showpass').val('1');
			$('#login-pass').attr('type','text');
		}
	});


	// Validar e ingresar
	$('.ingresar').on('click', function(){

		user = $('#login-user').val();
		pass = $('#login-pass').val();
		lastitem = $('#lastitem').html();

		if(user!="" && pass!=""){
			$.post('process/validate.php',{'user':user,'pass':pass},function(resp){
				if(resp=="ok"){
					if(lastitem!=""){
						window.location = lastitem;
					} else {
						window.location = 'login/welcome/';
					}
				} else {
					nalert("Alguno de los datos ingresados no es correcto.<BR>Por favor, revisa que estén escritos correctamente.");
				}
			});
		} else {
			nalert("Alguno de los campos está vacío.<BR>Por favor, ingresa tanto el usuario como la contraseña.");
		}

	});


	// Valida la direccion de correo
	$('#pass-email').on('keyup', function(){
		var email = $(this).val();
		if(validar_email(email)){
			$.post('process/email-exists.php',{'email':email},function(resp){
				if(resp=="si"){
					$('.email-cont').removeClass('has-error');
					$('.email-cont').addClass('has-success');
					$('.feedback-email').removeClass('fa-times');
					$('.feedback-email').addClass('fa-check');
					$('.vemail').html('1');
				} else {
					$('.email-cont').removeClass('has-success');
					$('.email-cont').addClass('has-error');
					$('.feedback-email').removeClass('fa-check');
					$('.feedback-email').addClass('fa-times');
					$('.vemail').html('');
				}
			});
		} else {
			$('.email-cont').removeClass('has-success');
			$('.email-cont').addClass('has-error');
			$('.feedback-email').removeClass('fa-check');
			$('.feedback-email').addClass('fa-times');
			$('.vemail').html('');
		}

	});


	// Envío del formulario
	$('.recuperar').on('click', function(){

		vemail = $('.vemail').html();

		if(vemail==1){
			
			email = $('#pass-email').val();

			$.post('process/recover.php', {'email':email}, function(resp){
				if(resp=="ok"){
					$('#alert-location-text').html("Te enviamos un correo electrónico de confirmación para que recuperes el acceso a tu cuenta. Por favor, revisa tu casilla.");
					$('#alert-do-location').attr('rel','login/repass/');
					$('#alert-location').modal('show');
				} else {
					nalert("Error con los datos ingresados. Por favor revisa que estén escritos correctamente.");
				}
			});

		} else {

			nalert("La dirección de correo que ingresaste no es válida.<BR>Por favor, revisa que la misma esté escrita correctamente.");

		}

	});


	// Probar código de recuperación

	$('.test-code-recover').on('click', function(){
		code = $('#pass-code').val();
		$.post('process/recover-test-code.php', {'code':code}, function(resp){
			if(resp=="ok"){
				window.location = 'login/newpass/';
			} else {
				nalert("El código que escribiste no es válido. Por favor corrige este dato e inténtalo nuevamente.");
			}
		});
	});


	// Nueva contraseña

	$('.new-pass-recover').on('click', function(){
		vpass = $('.vpass').html();
		vrepass = $('.vrepass').html();
		if(vpass==1 && vrepass==1){
			pass = $('#form-pass').val();
			$.post('process/recover-new-pass.php', {'pass':pass}, function(resp){
				if(resp=="ok"){
					$('#alert-location-text').html("<b>¡Perfecto!</b><br>¡Ahora puedes ingresar con la nueva contraseña!");
					$('#alert-do-location').attr('rel','login/');
					$('#alert-location').modal('show');
				} else {
					nalert("Por favor, revisa que las contraseñas coincidan, y cumplan con los requisitos mínimos.");
				}
			});
		}
	});





	// Valida contraseña
	$('#form-pass').on('keyup', function(){
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
	$('#form-repass').on('keyup', function(){
		var repass = $(this).val();
		var pass = $('#form-pass').val();
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



	$('#login-user').focus();
	
	$("#login-user").keypress(function(event) {
		if ( event.which == 13 ) {
			$('#login-pass').focus();
		}
	});
	
	$("#login-pass").keypress(function(event) {
		if ( event.which == 13 ) {
			$('.ingresar').trigger('click');
		}
	});

});