
$(document).on('ready', function(){

	pow_seccion = $('#pow_seccion').html();
	pow_vista = $('#pow_vista').html();
	pow_id = $('#pow_id').html();

	// Valida nombre de usuario
	$('#form-user').on('keyup', function(){
		var user = $(this).val();
		var longUser = user.length;
		if(longUser<6) {
			$('.user-cont').removeClass('has-success');
			$('.user-cont').addClass('has-error');
			$('.feedback-user').removeClass('fa-check');
			$('.feedback-user').addClass('fa-times');
			$('.vuser').html('');
		} else {
			$.post('process/user-exists.php',{'user':user},function(resp){
				if(resp=="si"){
					$('.user-cont').removeClass('has-success');
					$('.user-cont').addClass('has-error');
					$('.feedback-user').removeClass('fa-check');
					$('.feedback-user').addClass('fa-times');
					$('.vuser').html('');
				} else {
					$('.user-cont').removeClass('has-error');
					$('.user-cont').addClass('has-success');
					$('.feedback-user').removeClass('fa-times');
					$('.feedback-user').addClass('fa-check');
					$('.vuser').html('1');
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

	// Valida la direccion de correo
	$('#form-email').on('keyup', function(){
		var email = $(this).val();
		if(validar_email(email)){
			$.post('process/email-exists.php',{'email':email},function(resp){
				if(resp=="si"){
					$('.email-cont').removeClass('has-success');
					$('.email-cont').addClass('has-error');
					$('.feedback-email').removeClass('fa-check');
					$('.feedback-email').addClass('fa-times');
					$('.vemail').html('');
				} else {
					$('.email-cont').removeClass('has-error');
					$('.email-cont').addClass('has-success');
					$('.feedback-email').removeClass('fa-times');
					$('.feedback-email').addClass('fa-check');
					$('.vemail').html('1');
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
	$('.registrar').on('click', function(){

		vuser = $('.vuser').html();
		vpass = $('.vpass').html();
		vrepass = $('.vrepass').html();
		vemail = $('.vemail').html();

		if(vuser==1 && vpass==1 && vrepass==1 && vemail==1){
			
			user = $('#form-user').val();
			pass = $('#form-pass').val();
			repass = $('#form-repass').val();
			email = $('#form-email').val();

			$.post('process/user-register.php', {'user':user,'pass':pass,'email':email}, function(resp){
				if(resp!=""){
					window.location = 'register/moredata/' + resp + '/';
				} else {
					nalert('Error con los datos ingresados. Por favor revisalos.');
				}
			});

		} else {

			nalert('Todos los campos son obligatorios.<br>Asegúrate de haberlos rellenado correctamente.');
		}

	});


	// Valida y carga datos personales

	$('.registrar2').on('click', function(){

		userID = $('#userID').html();
		name = $('#form-name').val();
		lastname = $('#form-lastname').val();
		genre = $('#form-genre').val();
		areaID = $('#form-areaID').val();

		if(userID==""){
			userID = $('#pow_id').html();
		}

		if(name!="" && lastname!=""){

			$.post('process/user-register-profile.php',{
				'userID':userID,
				'name':name,
				'lastname':lastname,
				'genre':genre,
				'areaID':areaID
			}, function(resp){
				
				if(resp!=""){
					window.location = 'register/terms/' + resp + '/';
				} else {
					nalert('Hubo un error con los datos ingresados. Por favor revísalos.');
				}

			});

		} else {
			nalert('Alguno/s de los campos obligatorios está vacío o no fue rellenado correctamente.');
		}

	});


	// Finalizar registro
	$('.registrar-ok').on('click', function(){

		userID = $('#newuserID').html();

		if(userID==""){
			userID = $('#pow_id').html();
		}

		if($('#terms').val()!=1){
			nalert("Debes aceptar los términos y condiciones del servicio.");
		} else {
			$.post('process/user-register-ok.php', {'userID':userID}, function(resp){
				if(resp=="ok"){
					window.location = 'register/welcome/' + userID + '/';
				} else {
					report("Error en pantalla de términos y condiciones.");
					nalert('Error desconocido. Por favor contacta con el administrador.');
				}
			});
		}

	});

	$('.checkterms').on('click', function(){
		if($('.checkterms').hasClass('oki')){
			$('.checkterms').removeClass('oki');
			$('.checkterms').val('0');
		} else {
			$('.checkterms').addClass('oki');
			$('.checkterms').val('1');
		}
	});

});