
$(function(){

	/*
	 | RUTAS DEL SERVIDOR
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/

	url_base = $('#url_base').text();


	/*
	 | ELEGIR TIPO DE LISTADO
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/
	
	$('#save-form-item').on('click', function(){
		$('#form-item').submit();
	});
	

	/*
	 | VALIDACIÓN DE CAMPOS NUEVO NEGOCIO
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/

	$('#name').on('keyup', function(){
		name = $(this).val();
		if(name.length<6){
			$('.invalid-feedback.name').text('Debes ingresar al menos 6 (seis) caracteres')
			$('#name').addClass('is-invalid');
			$('.invalid-feedback.name').show();
		} else {
			$('.invalid-feedback.name').hide();
			$('#name').removeClass('is-invalid');
		}
	});

	$('#alias').on('keyup', function(){
		alias = $(this).val();
		store_id = $('#store_id').text();
		expresion = /^[a-zA-Z0-9._]{6,30}$/;
		if(alias.length<6){
			$('.invalid-feedback.alias').text('Debes ingresar al menos 6 (seis) caracteres')
			$('#alias').addClass('is-invalid');
			$('.invalid-feedback.alias').show();
		} else if(alias.length>30){
			$('.invalid-feedback.alias').text('No puedes usar más de 30 (treinta) caracteres')
			$('#alias').addClass('is-invalid');
			$('.invalid-feedback.alias').show();
		} else if(expresion.test(alias)==false){
			$('.invalid-feedback.alias').text('Sólo puedes usar letras, números, puntos y guiónes bajos')
			$('#alias').addClass('is-invalid');
			$('.invalid-feedback.alias').show();
		} else {
			if(store_id==""){
				url_post = url_base + '/store/alias/validate/' + alias;
			} else {
				url_post = url_base + '/store/alias/validate/' + alias + '/' + store_id;
			}
			$.get(url_post, {}, function(resp){
				if(resp=="error"){
					$('.invalid-feedback.alias').text('Esta dirección ya está siendo usada por otro negocio.')
					$('#alias').addClass('is-invalid');
					$('.invalid-feedback.alias').show();
				} else {
					$('.invalid-feedback.alias').hide();
					$('#alias').removeClass('is-invalid');
				}
			});
		}
	});


	/*
	 | CREAR UNA OFERTA
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/

	$('#offer-price').on('change', function(){
		new_price = $(this).val();
		old_price = $('#old-price').val();
		percent = parseInt(new_price) * 100 / parseInt(old_price);
		$('#offer-percent').val(100 - Math.round(percent));
	});

	$('#offer-percent').on('change', function(){
		percent = $(this).val();
		old_price = $('#old-price').val();
		new_price = old_price * (100 - percent) / 100;
		$('#offer-price').val(Math.round(new_price));
	});

    $('.new-offer').on('click', function(){
		$('.pop-bg').show();
		$('#m-offer').show();
    });

    $('#send-offer').on('submit', function(e){

        e.preventDefault();
		spinnModalOn();
		
		data = $(this).serialize();
    
        url = url_base + '/store/item/offer';
    
        $.post(url, data, function(resp){
            if(resp=="ok"){
                window.location.reload();
            }
        }, '');
        
    });


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
				if(campo.size>10485760){
					notify_open("La foto no debe pesar más de 10 MB. El archivo que intentas subir pesa " + parseInt(campo.size / 1000) + " KB.");
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
	 | ORDENAR FOTOS DE UN ITEM
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/
	$("#sortable").sortable({
		stop : function() {
			neworder = $("#sortable").sortable("toArray");
			url_post = url_base + '/store/item/photo/order/' + neworder;
			$.get(url_post);
		}
	});

	$("#sortable").disableSelection();


	/*
	 | AUTOCOMPLETE FEATURES
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/

	$.ajax({
	    url: $('#features-json').val(),
		type: 'POST',
	    success: function(data){

			$("#feature_name").autocomplete({
				source: data
			});

	    }
	});
	
	
	/*
	 | GUARDAR CARACTERÍSTICAS
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/
	
	$('#add-feature').on('click', function(){
		
		feature = $('#feature_name').val();
		content = $('#feature_content').val();
		item_id = $('#item_id').val();
		token = $('#token').text();

		url_post = url_base + '/item/feature/add';
		
		if(feature==""){
			$('#feature_name').focus();
		} else if(content==""){
			$('#feature_content').focus();
		} else {

			$.post(url_post, {
				'feature':feature,
				'content':content,
				'item_id':item_id,
				'_token':token
			}, function(data){

				html = '<div class="badge badge-light f13 marB5 marR5" id="feature-' + item_id + '-' + data.feature_id + '">' + data.feature + ': ' + 
						'<span class="fw400 inline-block">' + data.content + '</span>' + 
						'<a href="javascript:;" onclick="featureDelete(' + item_id + ', ' + data.feature_id + ');" class="inline-block marL10">' + 
						'<i class="fa fa-times"></i>' + 
						'</a>' + 
						'</div>';

				$('#show-features').append(html);

				$('#feature_content').val('');
				$('#feature_name').val('').focus();

			}, 'JSON');

		}

	});

	$("#feature_name").keypress(function(event) {
		if ( event.which == 13 ) {
			$('#feature_content').focus();
		}
	});

	$("#feature_content").keypress(function(event) {
		if ( event.which == 13 ) {
			$('#add-feature').trigger('click');
		}
	});


	/*
	 | GUARDAR ETIQUETAS
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/
	
	$('#add-tags').on('click', function(){
		
		keyword = $('#keyword').val();
		item_id = $('#item_id').val();
		token = $('#token').text();

		url_post = url_base + '/item/tag/add';
		
		if(keyword==""){
			$('#keyword').focus();
		} else {

			$.post(url_post, {
				'keyword':keyword,
				'item_id':item_id,
				'_token':token
			}, function(data){

				//alert(data);

				var n = data.length;

				for(i=0; i<n; i++){

					html = '<div class="inline-block badge badge-light pad5 marT5 marR5 f13" id="tag-' + item_id + '-' + data[i].keyword_id + '"> ' +
							'#'+ data[i].keyword + 
							'<a href="javascript:;" onclick="tagDelete(' + item_id + ', ' + data[i].keyword_id + ');" class="inline-block marL10">' + 
							'<i class="fa fa-times"></i>' + 
							'</a>' + 
							'</div>';

					$('#show-tags').append(html);

				}

				$('#keyword').val('').focus();

			}, 'JSON');

		}

	});

	$("#keyword").keypress(function(event) {
		if ( event.which == 13 ) {
			$('#add-tags').trigger('click');
		}
	});


	/*
	 | TIENDA VIRTUAL
	 | ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	*/

	/* Oscurecer cabecera
	---------------------------------------------------- */
	$('.opacity-range').on('change', function(){

		opacity = $('.opacity-range').val();
		store_id = $('#store_id').text();

		if(opacity.length<2){ 
			opacity = '0' + opacity;
		}

		$('.opacity-input').val(opacity);
		$('.bg-header').css({'background':'rgba(0,0,0,0.' + opacity + ')'});
		
		url_get = url_base + '/store/eshop/opacity/' + store_id + '/' + opacity;

		$.get(url_get, {}, function(resp){
			console.log(resp);
		});

	});

	/* Oscurecer cabecera
	---------------------------------------------------- */
	$('.opacity-range-movil').on('change', function(){

		opacity = $('.opacity-range-movil').val();
		store_id = $('#store_id').text();

		if(opacity.length<2){ 
			opacity = '0' + opacity;
		}

		$('.bg-header-movil').css({'background':'rgba(0,0,0,0.' + opacity + ')'});
		
		url_get = url_base + '/store/eshop/opacity/' + store_id + '/' + opacity;

		$.get(url_get, {}, function(resp){
			console.log(resp);
		});

	});


	/* Subir imagen de portada
	---------------------------------------------------- */
	$('#image-header-upload, #image-header-upload-movil').on('click', function(){
		$('#image-header').trigger('click');
	});

	$('#image-header').on('change', function(){

		var campo_archivo = document.getElementById('image-header');
		var campo = campo_archivo.files[0];
		
		if($('#image-header').val()!=""){
			if(campo_archivo.files.length != 0){ 
				if(campo.size>8388608){
					notify_open("La foto no debe pesar más de 8 MB. El archivo que intentas subir pesa " + parseInt(campo.size / 1000) + " KB.");
				} else {
					spinnOn();
					$('#form-image-header').submit();
				}
			} else {
				spinnOn();
				$('#form-image-header').submit();
			}
		} else {
			notify_open("Debes seleccionar un archivo para subir.");
		}

	});


	/* Subir imagen de perfil
	---------------------------------------------------- */
	$('#image-profile-upload, #image-profile-upload-movil').on('click', function(){
		$('#image-profile').trigger('click');
	});

	$('#image-profile').on('change', function(){

		var campo_archivo = document.getElementById('image-profile');
		var campo = campo_archivo.files[0];
		
		if($('#image-profile').val()!=""){
			if(campo_archivo.files.length != 0){ 
				if(campo.size>5242880){
					notify_open("La foto no debe pesar más de 5 MB. El archivo que intentas subir pesa " + parseInt(campo.size / 1024 / 1024) + " MB.");
				} else {
					spinnOn();
					$('#form-image-profile').submit();
				}
			} else {
				spinnOn();
				$('#form-image-profile').submit();
			}
		} else {
			notify_open("Debes seleccionar un archivo para subir.");
		}

	});

});


/*
| ELIMINAR CARACTERÍSTICA
| ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/
function featureDelete(item_id, feature_id){

	url_post = url_base + '/item/feature/delete/' + item_id + '/' + feature_id;

	$.get(url_post, {}, 
	function(data){
		if(data.resp == "ok"){
			$('#feature-' + item_id + '-' + feature_id).remove();
		} else {
			alert(data.resp);
		}
	}, 'JSON');

}


/*
| ELIMINAR ETIQUETA
| ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/
function tagDelete(item_id, keyword_id){

	url_post = url_base + '/item/tag/delete/' + item_id + '/' + keyword_id;

	$.get(url_post, {}, 
	function(data){
		if(data.resp == "ok"){
			$('#tag-' + item_id + '-' + keyword_id).remove();
		} else {
			alert(data.resp);
		}
	}, 'JSON');

}