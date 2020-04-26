
$(document).on('ready', function(){

	// Iniciar trial 30 días

	$('#gotrial').on('click', function(){
		storeID = $('#storeID').html();
		$.post('process/store-trial-start.php', {'storeID':storeID}, function(resp){
			if(resp=="ok"){
				window.location.reload();
			} else {
				nalert('Ocurrió un error. Por favor contacta con el administrador.');
			}
		});
	});


	// Seleccionar plan

	$('.select-plan').on('click', function(){
		planID = $(this).attr('planID');
		storeID = $('#storeID').html();
		token = $('#token').html();
		$.post('process/store-select-plan.php', {
			'planID':planID,
			'storeID':storeID
		}, function(resp){
			if(resp=="ok"){
				window.location = 'store/checkout/' + token + '/';
			} else {
				nalert('Ocurrió un error. Por favor contacta con el administrador.');
			}
		});
	});


	// Checkear alerta

	$('.check-alert').on('click', function(){
		Id = $(this).attr('alertID');
		$.post('process/alert-check.php',{'Id':Id});
	});


	// Validación del token
	$('.token-test').on('click', function(){

		userID = $('#userID').html();
		token = $('#token').html() + $('#ftoken').val();

		$.post('process/store-token.php', {'token':token,'userID':userID}, function(resp){

			if(resp=="ok"){
				$('#alert-location-text').html('<b>¡Perfecto!</b><br>Ahora sólo debes aguardar a que el dueño del negocio apruebe tu participación. ¡En breve tendrás noticias!');
				$('#alert-do-location').attr('rel','store/');
				$('#alert-location').modal('show');
			} else if(resp=="errtoken"){
				nalert('El token que ingresaste es incorrecto o ya fue usado anteriormente.');
			} else if(resp=="erryala"){
				nalert('Ya estás administrando el negocio correspondiente al token ingresado');
			}

		});

	});


	/* UPDATE PROFILE ************************************************/

	$('.guardar-shop').on('click', function(){

		vuser = $('.vuser').html();

		token = $('#token').html();

		storeID = $('#storeID').val();
		name = $('#shop-name').val();
		user = $('#store-user').val();
		type = $('#shop-type').val();
		description = $('#shop-description').val();
		address = $('#shop-address').val();
		areaID = $('#shop-areaID').val();
		telefono = $('#shop-telefono').val();
		cellphone = $('#shop-cellphone').val();
		website = $('#shop-website').val();
		email = $('#shop-email').val();
		facebook = $('#shop-facebook').val();
		twitter = $('#shop-twitter').val();
		instagram = $('#shop-instagram').val();

		if(name!="" && user!=""){

			if(vuser==1){

				$.post('process/store-update-info.php', {
					'name':name,
					'description':description,
					'user':user,
					'type':type,
					'address':address,
					'areaID':areaID,
					'telefono':telefono,
					'cellphone':cellphone,
					'website':website,
					'email':email,
					'facebook':facebook,
					'twitter':twitter,
					'instagram':instagram,
					'storeID':storeID
				}, function(resp){

					if(resp=="ok"){
						nlocation('<b>Perfecto!</b> Los datos se guardaron correctamente.', "'store/' + token + '/'");
					} else {
						report("Error al guardar datos del negocio.");
						nalert('Ocurrió un error al guardar los datos. Por favor inténtalo de nuevo.');
					}

				});

			} else {

				nalert('El nombre de usuario que elegiste ya está en uso o no cumple con la longitud requerida (entre 6 y 30 caracteres).');

			}

		} else {

			nalert('El nombre no puede quedar vacío.');

		}

	});


	// Creo nombre de usuario
	$('#store-name').on('keyup', function(){
		name = $(this).val();
		$.post('process/store-create-user.php', {'name':name}, function(resp){
			$('#store-user').val(resp);
		})
	});


	// Valido el user del negocio
	$('#store-name, #store-user').on('keyup', function(){
		user = $('#store-user').val();
		storeID = $('#storeID').val();
		longUser = user.length;
		if(longUser<6) {
			$('.user-cont').removeClass('has-success');
			$('.user-cont').addClass('has-error');
			$('.feedback-user').removeClass('fa-check');
			$('.feedback-user').addClass('fa-times');
			$('.vuser').html('AAA');
		} else {
			$.post('process/store-user-exists.php', {'user':user,'storeID':storeID}, function(resp){
				if(resp=="si"){
					$('.user-cont').removeClass('has-success');
					$('.user-cont').addClass('has-error');
					$('.feedback-user').removeClass('fa-check');
					$('.feedback-user').addClass('fa-times');
					$('.vuser').html('BBB');
				} else if(resp=="no") {
					$('.user-cont').removeClass('has-error');
					$('.user-cont').addClass('has-success');
					$('.feedback-user').removeClass('fa-times');
					$('.feedback-user').addClass('fa-check');
					$('.vuser').html('1');
				}
			});
		}
	});


	$('.registrar').on('click', function(){

		userID = $('#userID').html();
		name = $('#store-name').val();
		user = $('#store-user').val();
		type = $('#store-type').val();
		vuser = $('.vuser').html();
		description = $('#store-description').val();

		if(name!="" && user!=""){

			if(vuser==1){

				$.post('process/store-new.php', {'name':name,'user':user,'type':type,'description':description,'userID':userID}, function(resp){

					if(resp!=""){
						window.location = 'store/' + resp + '/';
					} else {
						report("Error al cargar un nuevo negocio.");
						nalert('Hubo un error en el sistema. Contacta con el administrador.');
					}

				});

			} else {

				nalert('Este nombre de usuario ya está en uso.<br>Por favor prueba con otro.');

			}

		} else {

			nalert('El nombre y usuario del negocio son obligatorios.');

		}

	});


	/* Leer mensaje */

	$('.message-read').on('click', function(){

		messageID = $(this).attr('id');
		seccion = $('#pow_seccion').html();

		$.post('process/user-message.php', {'messageID':messageID,'seccion':seccion}, function(resp){
			
			$('.message-show').html(resp);
			$('#message').modal('show');

		});		

	});


	/* Guardar sucursales */

	$('.guardar-locations').on('click', function(){

		storeID = $('#storeID').val();
		name = $('#locations-name').val();
		address = $('#locations-address').val();
		areaID = $('#locations-areaID').val();
		phone = $('#locations-phone').val();
		cellphone = $('#locations-cellphone').val();
		email = $('#locations-email').val();
		id = $('#pow_id').html();
		token = $('#token').html();

		if(id==""){
			action = 'newlocation';
			path = 'store/locations/newlocation/'+token+'/#';
		} else {
			action = 'editlocation';
			path = 'store/locations/newlocation/'+id+'/'+token+'/#';
		}

		$.post('process/store-'+action+'.php',{
			'storeID':storeID,
			'name':name,
			'address':address,
			'areaID':areaID,
			'phone':phone,
			'cellphone':cellphone,
			'email':email,
			'locationID':id
		}, function(resp){
			if(resp=="ok"){
				window.location = 'store/locations/'+token+'/';
			} else {
				report("Error al cargar / modificar una sucursal.");
				nalert('Hubo un error en el sistema. Intenta de nuevo más tarde.');
			}
		});

	});


	// Borrar sucursales 

	$('.delete-location').on('click', function() {
		id = $(this).attr('rel');
		if(confirm('Estás seguro de que quieres eliminar este registro?')) {
			$.post('process/store-delete-location.php', {'Id':id}, function(resp){
				if(resp=="ok"){
					window.location.reload();
				} else {
					report("Problema para eliminar una sucursal.");
					nalert('No se pudo eliminar la sucursal. Intenta de nuevo más tarde.');
				}
			});
		}
	});


	// Horarios de atención

	$('#fturno').on('change', function(){
		if($(this).val()==1){
			$('.ttarde').addClass('none');
			$('.tunic').html('Turno único:');
		} else {
			$('.ttarde').removeClass('none');
			$('.tunic').html('Turno mañana:');
		}
	});


	$('#add-schedule').on('click', function(){
		token = $('#token').html();
		locationID = $('#locationID').val();
		dia = $('.fdia').val();
		turno = $('.fturno').val();
		mopen = $('.fmopen').val();
		mclose = $('.fmclose').val();
		topen = $('.ftopen').val();
		tclose = $('.ftclose').val();
		schid = $('.schid').val();
		$.post('process/store-add-schedule.php',{
			'locationID':locationID,
			'dia':dia,
			'turno':turno,
			'mopen':mopen,
			'mclose':mclose,
			'topen':topen,
			'tclose':tclose,
			'schid':schid
		}, function(resp){
			if(resp=="ok"){
				if(schid==""){
					window.location.reload();
				} else {
					window.location = 'store/schedule/'+token+locationID+'/';
				}
			} else {
				report("Erro al cargar horarios de atención de sucursales.");
				nalert("Ocurrió un error al cargar el horario de atención.");
			}
		});
	});


	/*  */

	$('.delete-schedule').on('click', function(){
		Id = $(this).attr('rel');
		$.post('process/store-delete-schedule.php', {'Id':Id}, function(resp){
			if(resp=="ok"){
				window.location.reload();
			} else {
				report("Error al eliminar un horario de atención.");
				nalert("Ocurrió un error al eliminar el horario de atención.");
			}
		});
	});


	/* Guardar items */

	$('.guardar-item').on('click', function(){

		storeID = $('#storeID').val();
		categoryID = $('#item-categoryID').val();
		name = $('#item-name').val();
		detail = $('#item-detail').val();
		talle = $('#item-feature-talle').val();
		color = $('#item-feature-color').val();
		marca = $('#item-feature-marca').val();
		precio = $('#item-feature-precio').val();
		genre = $('#item-feature-genre').val();
		edad = $('#item-feature-edad').val();
		tags = $('#item-feature-tags').val();
		tipo = $('#item-tipo').val();
		itemID = $('#item-itemID').val();
		token = $('#token').html();

		if(itemID==""){
			action = 'item-new';
		} else {
			action = 'item-edit';
		}

		if(name!="" && detail!=""){

			$.post('process/store-'+action+'.php', {
				'categoryID':categoryID,
				'storeID':storeID,
				'name':name,
				'detail':detail,
				'talle':talle,
				'color':color,
				'marca':marca,
				'precio':precio,
				'genre':genre,
				'edad':edad,
				'tags':tags,
				'tipo':tipo,
				'itemID':itemID
			}, function(resp){
				if(resp=="ok"){
					if(tipo == "p"){
						window.location = 'store/products/'+token+'/';
					} else {
						window.location = 'store/services/'+token+'/';
					}
				} else {
					report("Error al guardar un producto.");
					nalert('Hubo un error en el sistema. Intenta de nuevo más tarde.');
				}
			});

		} else {
			nalert('Para guardar el producto debes rellenar el nombre y la descripción como mínimo.');
		}

	});


	// Subir fotos

	$('#photo').on('change', function(){

		var campo_archivo = document.getElementById('photo');
		var campo = campo_archivo.files[0];
		
		if($('#photo').val()!=""){
			if(campo_archivo.files.length != 0){ 
				if(campo.size>2048000){
					nalert("La foto no debe pesar más de 2000 KB. El archivo que intentas subir pesa " + parseInt(campo.size / 1000) + " KB.");
				} else {
					$('.miniloading').css({'display':'block'});
					$('.btnback').hide();
					$('#uploader').submit();
				}
			} else {
				$('.miniloading').css({'display':'block'});
				$('.btnback').hide();
				$('#uploader').submit();
			}
		} else {
			nalert("Debes seleccionar un archivo para subir.");
		}

	});


	// Duplicar foto

	$('.duplicate-photo').on('click', function(){
		photoID = $(this).attr('rel');
		$.post('process/store-item-photos-duplicate.php', {'photoID':photoID}, function(resp){
			if(resp=="ok"){
				window.location.reload();
			} else {
				report("Error al duplicar una foto.");
				nalert("Ocurrió un error al duplicar la foto.");
			}
		});
	});


	// Ordenar fotos

	$("#sortable-item").sortable({
		stop : function() {
			neworder = $("#sortable-item").sortable("serialize", {
				key : "sort"
			});
			$.post('process/store-item-photos-order.php', {
				'orden' : neworder
			});
		}
	});

	$("#sortable-item").disableSelection();


	// Deshabilitar / habilitar productos 

	$('.active-item').on('click', function() {
		itemID = $(this).attr('rel');
		$.post('process/store-item-active.php', {'itemID':itemID}, function(resp){
			if(resp=="ok"){
				window.location.reload();
			} else if(resp=="nofoto"){
				nalert('Notamos que este ítem no tiene fotos cargadas. Para poder habilitarlo primero debes agregarle una (o más) foto/s.');
			} else {
				report("Error al activar o desactivar un item.");
				nalert('No se pudo realizar la acción. Intenta de nuevo más tarde.');
			}
		});
	});


	// Poner / Quitar producto de vidriera

	$('.show-item').on('click', function() {
		storeID = $('#storeID').val();
		itemID = $(this).attr('rel');
		$.post('process/store-item-show.php', {'itemID':itemID,'storeID':storeID}, function(resp){
			if(resp=="ok"){
				window.location.reload();
			} else if(resp=="tope") {
				nalert('Alcanzaste el límite de productos destacados en tu vidriera.');
			} else {
				report("Error al agregar un producto a la vidriera.");
				nalert('No se pudo realizar la acción. Intenta de nuevo más tarde.');
			}
		});
	});


	// Crear oferta

	$('.offer-item').on('click', function(){
		itemID = $(this).attr('rel');
		precio = $(this).attr('price');

		if($(this).hasClass('isoff')){
			$.post('process/store-item-offer-delete.php', {'itemID':itemID}, function(resp){
				if(resp=="ok"){
					window.location.reload();
				} else {
					report("Error al eliminar una oferta.");
					nalert("No se pudo eliminar la oferta. Por favor inténtalo nuevamente más tarde.");
				}
			})
		} else {
			$.post('process/store-item-offer-limit.php', {'itemID':itemID}, function(resp){
				if(resp=="ok"){
					$('#fitemID').val(itemID);
					$('#fnewprice').val(precio);
					$('#fprecio').val(precio);
					$('#alert-offer').modal('show');
				} else {
					nalert("Alcanzaste el límite de ofertas permitidas para tu tipo de cuenta (<b>"+resp+" en total</b>). Para poder agregar nuevas ofertas deberás contratar un plan con mayores capacidades.");
				}
			});
		}

	});


	$('#fpercent').on('change', function(){
		percent = 100 - $(this).val();
		porc = percent / 100;
		precio = $('#fprecio').val();
		newprice = porc * precio;
		$('#fnewprice').val(newprice.toFixed(2));
	});


	$('#create-offer').on('click', function(){
		itemID = $('#fitemID').val();
		storeID = $('#storeID').val();
		percent = $('#fpercent').val();
		newprice = $('#fnewprice').val();
		deadline = $('#fdeadline').val();
		$.post('process/store-item-offer-create.php', {'itemID':itemID,'storeID':storeID,'percent':percent,'newprice':newprice,'deadline':deadline}, function(resp){
			if(resp=="ok"){
				window.location.reload();
			} else {
				report("Error al cargar una oferta.");
				nalert("Ocurrió un problema al cargar la oferta. Por favor inténtalo nuevamente más tarde.");
			}
		});
	});


	// Orden de productos y servicios en vidriera

	$("#sortable-shower").sortable({
		stop : function() {
			neworder = $("#sortable-shower").sortable("serialize", {
				key : "sort"
			});
			$.post('process/store-item-shower-order.php', {
				'orden' : neworder
			}, function() {
				// location.reload();
			});
		}
	});

	$("#sortable-shower").disableSelection();


	// Quitar ítems de vidriera

	$('.shower-item-delete').on('click', function(){
		itemID = $(this).attr('rel');
		if(confirm('Estás seguro de que quieres quitar este ítem de la vidriera?')) {
			$.post('process/store-item-shower-delete.php', {'itemID':itemID}, function(resp){
				if(resp=="ok") {
					window.location.reload();
				} else {
					nalert('No se pudo quitar este ítem de la vidriera. Intenta de nuevo más tarde.');
				}
			});
		}
	});


	$('#user-search').on('keyup', function(e){
		$('.user-sugestions').show();
		keyword = $(this).val();
		$.post('process/store-users-search.php', {'keyword':keyword}, function(resp){
			$('.user-sugestions').html(resp);
		});
	});


	var options = {
		url: "assets/json/usuarios.json",
		getValue: "user",
		list: {	
			match: {
				enabled: true
			},
			maxNumberOfElements: 5
		},
		theme: "square",
		template: {
			type: "custom",
			method: function(value, item) {
				return "@" + value + " <i>(" + item.name + " " + item.lastname + ")</i>";
			}
		}
	};

	$("#users-list").easyAutocomplete(options);

	$('.add-admin').on('click', function(){
		user = $('#users-list').val();
		storeID = $('#storeID').val();
		token = $('#token').html();
		$.post('process/store-add-admin.php',{'user':user,'storeID':storeID}, function(resp){
			if(resp=="ok"){
				$('#alert-location-text').html('El administrador fue agregado exitosamente.');
				$('#alert-do-location').attr('rel','store/admins/' + token + '/');
				$('#alert-location').modal('show');
			} else if(resp=="yala") {
				nalert("El usuario que indicaste ya figura como administrador de este negocio.");
			} else if(resp=="nola") {
				nalert("El usuario que intentas agregar no existe en nuestra base de datos.");
			} else {
				report("Error al agregar un admidnistrador.");
				nalert("<span class='texto'>Ocurrió un error al intentar agregar el administrador. <a href='javascript:;' onclick='reportar();' data-dismiss='modal'>¿Deseas reportarlo?</a></span>");
			}
		});
	});


	// Invitar admin

	$('.send-invitation').on('click', function(){
		email = $('#femail').val();
		token = $('#token').html();
		storeID = $('#storeID').val();
		vemail = $('.vemail').html();
		if(vemail==1){
			$.post('process/mail/send-invitation.php', {'email':email,'token':token,'storeID':storeID}, function(resp){
				if(resp=="ok"){
					$('#alert-location-text').html("La invitación fue enviada correctamente.");
					$('#alert-do-location').attr('rel','store/admins/' + token + '/');
					$('#alert-location').modal('show');
				} else {
					nalert(resp);
				}
			});
		} else {
			nalert("La dirección de correo que ingresaste está mal escrita o pertenece a un usuario ya registrado, en cuyo caso podrás agregar con su nombre de usuario, en la solapa «Usuarios registrados».");
		}
	});


	// Valida la direccion de correo
	$('#femail').on('keyup', function(){
		var email = $(this).val();
		if(validar_email(email)){
			$.post('process/email-exists.php',{'email':email},function(resp){
				if(resp=="no"){
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


	// Asignar rango a administradores 

	$('.level-admin').on('click', function() {
		userID = $(this).attr('userID');
		levelID = $(this).attr('levelID');
		storeID = $('#storeID').val();
		$.post('process/store-level-admin.php', {'userID':userID,'storeID':storeID,'levelID':levelID}, function(resp){
			if(resp=="ok"){
				window.location.reload();
			} else {
				report("Error al asignar un nivel a un administrador.");
				nalert('No se pudo realizar la acción. Intenta de nuevo más tarde.');
			}
		});
	});


	// Deshabilitar / habilitar administradores 

	$('.active-admin').on('click', function() {
		userID = $(this).attr('rel');
		storeID = $('#storeID').val();
		$.post('process/store-active-admin.php', {'userID':userID,'storeID':storeID}, function(resp){
			if(resp=="ok"){
				window.location.reload();
			} else {
				report("Error al habilitar / deshabilitar un administrador.");
				nalert('No se pudo realizar la acción. Intenta de nuevo más tarde.');
			}
		});
	});


	// Borrar administradores 

	$('.delete-admin').on('click', function() {
		userID = $(this).attr('rel');
		storeID = $('#storeID').val();
		if(confirm('Estás seguro de que quieres eliminar este administrador?')) {
			$.post('process/store-delete-admin.php', {'userID':userID,'storeID':storeID}, function(resp){
				if(resp=="ok"){
					window.location.reload();
				} else {
					report("Error al eliminar un administrador.");
					nalert('No se pudo eliminar el administrador. Intenta de nuevo más tarde.');
				}
			});
		}
	});


	// Confirmar desactivación de negocio

	$('#store-deactivate-confirm').on('click', function(){

		$('#alert-deactivate-store-text').html('Estás a punto de deshabilitar este negocio. Todos los productos y/o servicios que tienes publicados van a dejar de mostrarse en la web (aunque no se borrarán). ¿Deseas confirmar?');
		$('#alert-deactivate-store').modal('show');

	});


	// Desactivar negocio

	$('#store-deactivate').on('click', function(){
		token = $('#token').html();
		$.post('process/store-deactivate.php', {'token':token}, function(resp){
			if(resp=="ok"){
				$('#alert-deactivate-store').modal('hide');
				$('#alert-reload-text').html('El negocio fue deshabilitado. Cuando quieras puedes habilitarlo de nuevo.');
				$('#alert-reload').modal('show');
			} else {
				report("Error al desactivar un negocio.");
				$('#alert-deactivate-store').modal('hide');
				nalert('El negocio no pudo ser deshabilitado. Por favor, inténtalo de nuevo más tarde.');
			}
		});
	});


	// Confirmar activación de negocio

	$('#store-activate-confirm').on('click', function(){

		$('#alert-activate-store-text').html('Estás a punto de habilitar este negocio. Por favor confirma esta acción.');
		$('#alert-activate-store').modal('show');

	});


	// Activar negocio

	$('#store-activate').on('click', function(){
		token = $('#token').html();
		$.post('process/store-activate.php', {'token':token}, function(resp){
			if(resp=="ok"){
				$('#alert-activate-store').modal('hide');
				$('#alert-reload-text').html('El negocio fue habilitado. Todos los productos que hayas publicado están disponibles en el sitio web.');
				$('#alert-reload').modal('show');
			} else {
				report("Error al habilitar un negocio.");
				$('#alert-activate-store').modal('hide');
				nalert('El negocio no pudo ser habilitado. Por favor, inténtalo de nuevo más tarde.');
			}
		});
	});


	// Confirmar ELIMINACIÓN de negocio

	$('#store-delete-confirm').on('click', function(){

		$('#alert-delete-store-text').html('Estás a punto de eliminar definitivamente este negocio. Una vez realizada esta acción no podrás volver atrás. ¿Deseas confirmar?');
		$('#alert-delete-store').modal('show');

	});


	// ELIMINAR negocio

	$('#store-delete').on('click', function(){
		token = $('#token').html();
		$.post('process/store-delete.php', {'token':token}, function(resp){
			if(resp=="ok"){
				$('#alert-delete-store').modal('hide');
				$('#alert-location-text').html('El negocio fue eliminado exitosamente.');
				$('#alert-do-location').attr('rel','store/');
				$('#alert-location').modal('show');
			} else {
				report("Error al eliminar un negocio.");
				$('#alert-delete-store').modal('hide');
				nalert('El negocio no pudo ser eliminado. Por favor, inténtalo de nuevo más tarde.');
			}
		});
	});


	// Subir foto de cabecera

	$('#headerpic').on('change', function(){

		$('.miniloading1').css({'display':'block'});

		var campo_archivo = document.getElementById('headerpic');
		var campo = campo_archivo.files[0];
		
		if($('#headerpic').val()!=""){
			if(campo_archivo.files.length != 0){ 
				if(campo.size>6200000){
					nalert("La foto no debe pesar más de 6 MB. El archivo que intentas subir pesa " + parseInt(campo.size / 1000000) + " MB.");
				} else {
					$('#uploader-headerpic').submit();
				}
			} else {
				$('#uploader-headerpic').submit();
			}
		} else {
			nalert("Debes seleccionar un archivo para subir.");
		}

	});


	// Borrar foto de cabecera

	$('.delete-headerpic').on('click', function() {
		token = $('#token').html();
		storeID = $('#storeID').val();
		if(confirm('Estás seguro de que quieres eliminar esta foto?')) {
			$.post('process/store-delete-headerpic.php', {'storeID':storeID}, function(resp){
				if(resp=="ok"){
					window.location = 'store/shop/'+token+'/';
				} else {
					report("Error al eliminar una foto de cabecera para tienda.");
					nalert('No se pudo eliminar la foto. Intenta de nuevo más tarde.');
				}
			});
		}
	});


	$('#fopacity-value').on('change', function(){
		valor = $(this).val();
		opacityheader = $('#fopacity-value').val();
		storeID = $('#storeID').val();
		$('#fopacity').val(valor);
		if(valor==100){
			$('.fopacity-cover').css({'background':'rgba(0,0,0,1)'})
		} else if(valor<10){
			$('.fopacity-cover').css({'background':'rgba(0,0,0,0.0'+valor+')'})
		} else {
			$('.fopacity-cover').css({'background':'rgba(0,0,0,0.'+valor+')'})
		}
		$.post('process/store-tienda-save.php', {'opacityheader':opacityheader,'storeID':storeID});
	});


	$('#fopacity').on('change', function(){
		valor = $(this).val();
		opacityheader = $('#fopacity').val();
		storeID = $('#storeID').val();
		$('#fopacity-value').val(valor);
		if(valor==100){
			$('.fopacity-cover').css({'background':'rgba(0,0,0,1)'})
		} else if(valor<10){
			$('.fopacity-cover').css({'background':'rgba(0,0,0,0.0'+valor+')'})
		} else {
			$('.fopacity-cover').css({'background':'rgba(0,0,0,0.'+valor+')'})
		}
		$.post('process/store-tienda-save.php', {'opacityheader':opacityheader,'storeID':storeID});
	});


	$('#logopic').on('change', function(){

		$('.miniloading').css({'display':'block'});

		var campo_archivo = document.getElementById('logopic');
		var campo = campo_archivo.files[0];
		
		if($('#logopic').val()!=""){
			if(campo_archivo.files.length != 0){ 
				if(campo.size>6200000){
					nalert("La foto no debe pesar más de 6 MB. El archivo que intentas subir pesa " + parseInt(campo.size / 1000000) + " MB.");
				} else {
					$('#uploader-logopic').submit();
				}
			} else {
				$('#uploader-logopic').submit();
			}
		} else {
			nalert("Debes seleccionar un archivo para subir.");
		}

	});


	// Borrar foto de cabecera

	$('.delete-logopic').on('click', function() {
		token = $('#token').html();
		storeID = $('#storeID').val();
		if(confirm('Estás seguro de que quieres eliminar esta foto?')) {
			$.post('process/store-delete-logopic.php', {'storeID':storeID}, function(resp){
				if(resp=="ok"){
					window.location = 'store/shop/'+token+'/';
				} else {
					report("Error al eliminar una foto de perfil.");
					nalert('No se pudo eliminar la foto. Intenta de nuevo más tarde.');
				}
			});
		}
	});


	// Ordenar resultados en tiendas

	$('#order-product-tienda').on('change', function(){
		selected = $(this).val();
		storeID = $('#storeID').val();
		$.post('process/order-product-tienda.php', {'order':selected,'storeID':storeID});
	});


	// Definir pestaña de inicio en tienda

	$('#tab-home-tienda').on('change', function(){
		selected = $(this).val();
		storeID = $('#storeID').val();
		$.post('process/store-tabhome-tienda.php', {'tabhome':selected,'storeID':storeID});
	});


});

/* *********************************| FUNCIONES |************************************* */


// Borrar item 

function delete_item(itemID) {
	$.post('process/store-item-delete.php', {'Id':itemID}, function(resp){
		if(resp=="ok"){
			nalert('El ítem fue eliminado exitosamente', 'window.location.reload()');
		} else {
			report("Error al eliminar un ítem.");
			nalert('No se pudo eliminar este ítem. Intenta de nuevo más tarde.');
		}
	});
}

// Borrar foto de item

function delete_photo(photoID) {
	$.post('process/store-item-delete-photo.php', {'photoID':photoID}, function(resp){
		if(resp=="ok"){
			nalert('La foto fue eliminada correctamente.', "window.location.reload()");
		} else {
			report("Error al eliminar una foto.");
			nalert('No se pudo eliminar la foto. Intenta de nuevo más tarde.');
		}
	});
}