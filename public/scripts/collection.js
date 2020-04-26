
$(document).on('ready', function(){

	$('.solapilla-a').on('click', function(){

		if($('.filter-section').hasClass('escondida')){
			$('.filter-section').removeClass('escondida');
			$('.solapilla-icon').removeClass('fa-angle-double-down');
			$('.solapilla-icon').addClass('fa-angle-double-up');
			$('.show-hide').html('Ocultar filtros');
			$('.filter-section').slideDown();
		} else {
			$('.filter-section').addClass('escondida');
			$('.solapilla-icon').removeClass('fa-angle-double-up');
			$('.solapilla-icon').addClass('fa-angle-double-down');
			$('.show-hide').html('Mostrar filtros');
			$('.filter-section').slideUp();
		}

	});


	$('#load-more-items').on('click', function(){

		search_tags = $('#pag-search-tags').html();
		pagina_total = $('#pag-total').html();
		pagina_actual = $('#pag-actual').html();
		pagina_all = $('#pag-all').html();
		registros_por_pagina = $('#pag-reg').html();
		categories = $('#pag-post-categories').html();
		pricemin = $('#pag-post-pricemin').html();
		pricemax = $('#pag-post-pricemax').html();
		locate = $('#pag-post-location').html();
		catid = $('#pag-get-id').html();
		pagina_order = $('#pag-order').html();
		storeID = $('#pag-storeID').html();

		$.post('process/collection-load-more.php', {
			'tags':search_tags,
			'pagina_actual':pagina_actual,
			'all':pagina_all,
			'registros_por_pagina':registros_por_pagina,
			'categories':categories,
			'pricemin':pricemin,
			'pricemax':pricemax,
			'locate':locate,
			'catid':catid,
			'storeID':storeID,
			'pagina_order':pagina_order
		}, function(resp){

			$('#product-view-grid').append(resp);

			siguiente = (parseInt(parseInt(pagina_actual) + 1) * parseInt(registros_por_pagina));

			if(siguiente > parseInt(pagina_total)){
				$('#load-more-items').hide();
			}

			cambio_pag = parseInt(pagina_actual) + 1;
			$('#pag-actual').html(cambio_pag);

		});

	});


});