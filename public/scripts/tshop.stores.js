
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
	    url: 'storage/json/features.json',
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