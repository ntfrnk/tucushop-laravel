
$(document).on('ready', function(){

	// Menú usuario

	$('.user-menu, .user-submenu').on('mouseover', function(){
		$('.user-submenu').addClass('user-submenu-on');
	});

	$('.user-menu, .user-submenu').on('mouseout', function(){
		$('.user-submenu').removeClass('user-submenu-on');
	});


	// Notificaciones

	$('.user-notif, .user-notifications').on('mouseover', function(){
		$('.user-notifications').addClass('user-notifications-on');
	});

	$('.user-notif, .user-notifications').on('mouseout', function(){
		$('.user-notifications').removeClass('user-notifications-on');
	});

	// Menú lateral

	$('.menu-side-show').on('click', function(){
		if($('.menu-side').hasClass('menu-side-ok')){
			$('.menu-side').removeClass('menu-side-ok');
		} else {
			$('.menu-side').addClass('menu-side-ok');
		}
	});

	// Buscar

	$("#searcher").on('focus', function() {
		$('.busquedas-cover').show();
		$('.busquedas').show();
	});

	$(".busquedas-cover").on('click', function() {
		$('.busquedas-cover').hide();
		$('.busquedas').hide();
	});

	$("#searcher").on('keyup', function(event) {
		if ( event.which == 13 ) {
			keyword = cleantext($(this).val());
			$.post('process/search-do.php', {'keyword':keyword}, function(resp){
				window.location = resp;
			});
		}
	});

	$('.gosearch').on('click', function(){
		keyword = cleantext($('#searcher').val());
		categoria = $('#filter-categoria').val();
		pricemin = $('#filter-pricemin').val();
		pricemax = $('#filter-pricemax').val();
		locate = $('#filter-location').val();
		$.post('process/search-do.php', {
			'keyword':keyword,
			'categoria':categoria,
			'pricemin':pricemin,
			'pricemax':pricemax,
			'locate':locate
		}, function(resp){
			window.location = resp;
		});
	});


	$('.filter-more').on('click', function(){
		if($('.filter-block').hasClass('filter-block-on')){
			$('.filter-block').removeClass('filter-block-on');
			$('.filter-more').removeClass('filter-more-on');
			$('.search2').removeClass('search2-on');
			$('.superbox').addClass('col-xs-8');
			$('.button2').show();
			$('.btn-filters').html('Ver filtros de búsqueda');
			$('.filter-block').css({'display':'none'});
			$.post('process/collection-filters-show.php',{'filters':'0'},function(){
				window.location.reload();
			});
		} else {
			$('.filter-block').addClass('filter-block-on');
			$('.filter-more').addClass('filter-more-on');
			$('.search2').addClass('search2-on');
			$('.superbox').removeClass('col-xs-8');
			$('.button2').hide();
			$('.btn-filters').html('Ocultar filtros de búsqueda');
			$.post('process/collection-filters-show.php',{'filters':'1'});
		}
	});


	// Registro de newsletter

	$('.news-send').on('click', function(){
		email = $('.femail-news').val();
		if(validar_email(email)){
			$.post('process/suscription-mail.php', {'email':email}, function(resp){
				if(resp=="ok") {
					$('#alert-text').html("¡Perfecto! ¡Te registraste correctamente en nuestra base de datos!");
					$('#alert').modal('show');
					$('.femail-news').val('');
					$('.aceptar').focus();
				} else if(resp=="yala") {
					$('#alert-text').html("Esta cuenta de correo ya está en nuestra base de datos.");
					$('#alert').modal('show');
					$('.femail-news').val('');
					$('.aceptar').focus();
				} else {
					report("Problema para ingresar cuenta de correo en newsletter.");
					$('#alert-text').html("No se pudo ingresar la cuenta de correo en la lista de newsletter.");
					$('#alert').modal('show');
					$('.aceptar').focus();
				}
			});
		} else {
			$('#alert-text').html("La cuenta de correo no es válida o el campo está vacío.");
			$('#alert').modal('show');
			$('.aceptar').focus();
		}
	});


	// Ordenar resultados

	$('#order-item').on('change', function(){
		selected = $(this).val();
		$.post('process/collection-item-orden.php', {'order':selected}, function(resp){
			window.location.reload();
		})
	});


	// Ordenar resultados en tiendas

	$('#order-item-store').on('change', function(){
		selected = $(this).val();
		storeID = $('#pag-storeID').html();
		$.post('process/tienda-item-orden.php', {'order':selected,'storeID':storeID}, function(resp){
			window.location.reload();
		})
	});


	// Agregar al carrito

	$('.add-cart').on('click', function(){
		productID = $(this).attr('rel');
		$.post('process/collection-add-cart.php', {'productID':productID}, function(resp){
			if(resp=="ok"){
				$('#alert-cart-text').html("¡El producto se agregó al carrito!");
				$('#alert-cart').modal('show');
			} else if(resp=="yala"){
				$('#alert-cart-text').html("Este producto ya está en el carrito.");
				$('#alert-cart').modal('show');
			} else {
				$('#alert-cart-text').html("No se pudo agregar el producto al carrito.");
				$('#alert-cart').modal('show');
			}
		});
	});


	// Alert RELOAD

	$('#alert-do-reload').on('click', function(){
		window.location.reload();
	});


	// Alert LOCATION

	$('#alert-do-location').on('click', function(){
		loc = $(this).attr('rel');
		window.location = loc;
	});


	// Enviar denuncia

	$('.send-denuncia').on('click', function(){
		itemID = $('#fitemID').val();
		reason = $('#freason').val();
		detail = $('#fdetail').val();
		$.post('process/collection-item-denunciar.php', {'itemID':itemID,'reason':reason,'detail':detail}, function(resp){
			if(resp=="ok"){
				$('#denunciar').modal('hide');
				itemID = $('#fitemID').val('');
				reason = $('#freason').val('');
				detail = $('#fdetail').val('');
				$('#alert-text').html("Tu denuncia fue realizada con éxito. ¡Gracias por contactarnos!");
				$('#alert').modal('show');
			}
		});
	});


	// Enviar reporte

	$('.send-reporte').on('click', function(){
		link = $('#link').val();
		detail = $('#fdetailreport').val();
		if(detail!=""){
			$.post('process/reporte-bugs.php', {'link':link,'detail':detail}, function(resp){
				if(resp=="ok"){
					$('.reporte').hide();
					$('.reporteok').show();
				} else {
					alert(resp);
				}
			});
		} else {
			$('#alert-text').html("El campo de texto está vacío.<br>Por favor indica cuál es el problema que encontraste.");
			$('#alert').modal('show');
		}
	});


	// Sistema de votación

	$('.star.star-1').hover(function(){
		$('.star-1').addClass('star-hover');
	}, function(){
		$('.star-1').removeClass('star-hover');
	});

	$('.star.star-2').hover(function(){
		$('.star-1, .star-2').addClass('star-hover');
	}, function(){
		$('.star-1, .star-2').removeClass('star-hover');
	});

	$('.star.star-3').hover(function(){
		$('.star-1, .star-2, .star-3').addClass('star-hover');
	}, function(){
		$('.star-1, .star-2, .star-3').removeClass('star-hover');
	});

	$('.star.star-4').hover(function(){
		$('.star-1, .star-2, .star-3, .star-4').addClass('star-hover');
	}, function(){
		$('.star-1, .star-2, .star-3, .star-4').removeClass('star-hover');
	});

	$('.star.star-5').hover(function(){
		$('.star-1, .star-2, .star-3, .star-4, .star-5').addClass('star-hover');
	}, function(){
		$('.star-1, .star-2, .star-3, .star-4, .star-5').removeClass('star-hover');
	});

	$('.star').on('click', function(){
		rate = $(this).attr('rate');
		productID = $(this).attr('productID');
		$.post('process/product-rate.php', {'productID':productID,'rate':rate}, function(resp){
			if(resp=="ok"){
				$('.valorar').load('process/product-new-rate.php', {'productID':productID}, function(){
					$(this).attr('title','Ya votaste este producto');
				});
			}
		})
	});


	$('.starstore').on('click', function(){
		rate = $(this).attr('rate');
		storeID = $(this).attr('storeID');
		$.post('process/store-rate.php', {'storeID':storeID,'rate':rate}, function(resp){
			if(resp=="ok"){
				$('.valorar').load('process/store-new-rate.php', {'storeID':storeID}, function(){
					$(this).attr('title','Ya votaste este negocio');
				});
			}
		})
	});


	$('.valorar').hover(function(){
		$('.rating-read').addClass('rating-off');
		$('.rating-write').removeClass('rating-off');
	}, function(){
		$('.rating-read').removeClass('rating-off');
		$('.rating-write').addClass('rating-off');
	});


	$('.nosess').on('click', function(){
		$('#alert-nosess-text').html("Para personalizar este contenido necesitas iniciar sesión.");
		$('#alert-nosess').modal('show');
	});


	// Inicializo popover

	$('[data-toggle="popover"]').popover()
	

});




// Funciones barra de busqueda

function delete_searches_confirm(){
	nconfirm("¿Seguro que quieres eliminar tu historial de búsqueda?", 'delete_searches()');
}

function delete_searches(){
	$.post('process/search-delete.php', {}, function(resp){
		if(resp=="ok"){
			nalert("El historial de búsqueda se limpió correctamente.", "window.location.reload()");
		} else {
			nalert("No se pudo limpiar el historial de búsqueda.");
		}
	});
}




// Funciones para el carrito y la lista de deseos

function add_cart(itemID){
	$.post('process/collection-add-cart.php', {'itemID':itemID}, function(resp){
		if(resp=="ok"){
			$('#alert-cart-text').html("¡El producto se agregó al carrito!");
			$('#alert-cart').modal('show');
		} else if(resp=="yala"){
			$('#alert-cart-text').html("Este producto ya está en el carrito.");
			$('#alert-cart').modal('show');
		} else {
			report("No se pudo agregar un producto al carrito");
			$('#alert-cart-text').html("No se pudo agregar el producto al carrito.");
			$('#alert-cart').modal('show');
		}
	});
}


function add_wishlist(itemID, reload){
	if(reload==0){
		link_reload = "offalerts()";
	} else {
		link_reload = "window.location.reload()";
	}
	$.post('process/collection-wishlist-add.php', {'itemID':itemID}, function(resp){
		if(resp=="ok"){
			heart_on(itemID);
			nalert("¡Este item se agregó a tus favoritos!", link_reload);
		} else if(resp=="yala"){
			nconfirm("Este item está en tu lista de favoritos.<br>¿Deseas quitarlo?", "remove_wishlist("+itemID+", "+reload+")");
		} else if(resp=="nosess"){
			nsession("Para agregar este item a tus favoritos necesitas iniciar sesión.");
		} else {
			report("No se pudo agregar un item a favoritos.");
			nalert("No se pudo agregar el item a favoritos.");
		}
	});
}


function remove_wishlist(itemID, reload){
	if(reload==0){
		link_reload = "offalerts()";
	} else {
		link_reload = "window.location.reload()";
	}
	$.post('process/collection-remove-wishlist.php', {'itemID':itemID}, function(resp){
		if(resp=="ok"){
			heart_off(itemID);
			nalert("El item se quitó de tus favoritos", link_reload);
		} else {
			report("Error al quitar un producto de la lista de deseos.");
			nalert("Error al quitar el producto de la lista. Por favor intente más tarde.");
		}
	});
}


function heart_on(itemID){
	$('.item-'+itemID).removeClass('heart-off');
	$('.item-'+itemID).addClass('heart-on');
	$('.itemh-'+itemID).removeClass('far');
	$('.itemh-'+itemID).addClass('fas');
	$('.item-'+itemID).attr('title', 'Quitar de favoritos');
}

function heart_off(itemID){
	$('.item-'+itemID).removeClass('heart-on');
	$('.item-'+itemID).addClass('heart-off');
	$('.itemh-'+itemID).removeClass('fas');
	$('.itemh-'+itemID).addClass('far');
	$('.item-'+itemID).attr('title', 'Agregar a favoritos');
}


function consultar() {
	consulta = $('#consult-detail').val();
	itemID = $('#itemID').val();
	storeID = $('#storeID').val();
	if(consulta!=""){
		$.post('process/collection-item-enviar-consulta.php', {'itemID':itemID,'storeID':storeID,'consulta':consulta}, function(resp){
			if(resp=="ok"){
				$('#alert-question').modal('hide');
				$('#alert-reload-text').html("¡Perfecto! La consulta se realizó correctamente. En breve recibirás la respuesta en tu zona de usuario.");
				$('#alert-reload').modal('show');
			} else {
				report("Error al enviar una consulta en tienda.");
				$('#alert-question').modal('hide');
				$('#alert-text').html("No se pudo realizar la consulta");
				$('#alert').modal('show');
			}
		});
	} else {
		$('#alert-question').modal('hide');
		$('#alert-text').html("No puedes enviar una consulta vacía.");
		$('#alert').modal('show');
	}

}


function askquestion(itemID){
	userID = $('#userID').html();
	if(userID!=""){
		$.post('process/collection-item-consultar.php', {'itemID':itemID}, function(resp){
			$('#alert-question-content').html(resp);
			$('#alert-question').modal('show');
		});
	} else {
		$('#alert-question').modal('hide');
		$('#alert-nosess-text').html("Para consultar sobre este item necesitas iniciar sesión.");
		$('#alert-nosess').modal('show');
	}
}


function quickview(itemID){

	$.post('process/collection-item-quickview.php', {'itemID':itemID}, function(resp){

		$('#modal-content').html(resp);
		$('#quickview').modal('show');

	});

}


function answer(){
	$('.answer-box').slideDown(200);
	$('.btn-resp').hide();
}


function denunciar(itemID){
	$('#fitemID').val(itemID);
	$('#denunciar').modal('show');
}

function reportar(){
	$('#reportar').modal('show');
}

function contactus(){
	$('#contactus').modal('show');
}


// Votar producto

function rate(){
	$('.rating-read').addClass('rating-off');
	$('.rating-write').removeClass('rating-off');
}

function unrate(){
	$('.rating-read').removeClass('rating-off');
	$('.rating-write').addClass('rating-off');
}

function rateover(rating){
	if(rating==1){
		$('.star-1').addClass('star-hover');
	} else if(rating==2){
		$('.star-1, .star-2').addClass('star-hover');
	} else if(rating==3){
		$('.star-1, .star-2, .star-3').addClass('star-hover');
	} else if(rating==4){
		$('.star-1, .star-2, .star-3, .star-4').addClass('star-hover');
	} else if(rating==5){
		$('.star-1, .star-2, .star-3, .star-4, .star-5').addClass('star-hover');
	}
}

function rateout(rating){
	if(rating==1){
		$('.star-1').removeClass('star-hover');
	} else if(rating==2){
		$('.star-1, .star-2').removeClass('star-hover');
	} else if(rating==3){
		$('.star-1, .star-2, .star-3').removeClass('star-hover');
	} else if(rating==4){
		$('.star-1, .star-2, .star-3, .star-4').removeClass('star-hover');
	} else if(rating==5){
		$('.star-1, .star-2, .star-3, .star-4, .star-5').removeClass('star-hover');
	}
}

function dorate(itemID, rate){
	$.post('process/product-rate.php', {'productID':productID,'rate':rate}, function(resp){
		if(resp=="ok"){
			$('.valorar').load('process/product-new-rate.php', {'productID':productID}, function(){
				$(this).attr('title','Ya votaste este producto');
			});
		}
	})
}



// Votar servicio

function rate_service(){
	$('.rating-read').addClass('rating-off');
	$('.rating-write').removeClass('rating-off');
}

function unrate_service(){
	$('.rating-read').removeClass('rating-off');
	$('.rating-write').addClass('rating-off');
}

function rateover_service(rating){
	if(rating==1){
		$('.star-1').addClass('star-hover');
	} else if(rating==2){
		$('.star-1, .star-2').addClass('star-hover');
	} else if(rating==3){
		$('.star-1, .star-2, .star-3').addClass('star-hover');
	} else if(rating==4){
		$('.star-1, .star-2, .star-3, .star-4').addClass('star-hover');
	} else if(rating==5){
		$('.star-1, .star-2, .star-3, .star-4, .star-5').addClass('star-hover');
	}
}

function rateout_service(rating){
	if(rating==1){
		$('.star-1').removeClass('star-hover');
	} else if(rating==2){
		$('.star-1, .star-2').removeClass('star-hover');
	} else if(rating==3){
		$('.star-1, .star-2, .star-3').removeClass('star-hover');
	} else if(rating==4){
		$('.star-1, .star-2, .star-3, .star-4').removeClass('star-hover');
	} else if(rating==5){
		$('.star-1, .star-2, .star-3, .star-4, .star-5').removeClass('star-hover');
	}
}

function dorate_service(serviceID, rate){
	$.post('process/service-rate.php', {'serviceID':serviceID,'rate':rate}, function(resp){
		if(resp=="ok"){
			$('.valorar').load('process/service-new-rate.php', {'serviceID':serviceID}, function(){
				$(this).attr('title','Ya votaste este servicio');
			});
		}
	})
}



// Votar negocio

function rate_store(){
	$('.rating-read').addClass('rating-off');
	$('.rating-write').removeClass('rating-off');
}

function unrate_store(){
	$('.rating-read').removeClass('rating-off');
	$('.rating-write').addClass('rating-off');
}

function rateover_store(rating){
	if(rating==1){
		$('.star-1').addClass('star-hover');
	} else if(rating==2){
		$('.star-1, .star-2').addClass('star-hover');
	} else if(rating==3){
		$('.star-1, .star-2, .star-3').addClass('star-hover');
	} else if(rating==4){
		$('.star-1, .star-2, .star-3, .star-4').addClass('star-hover');
	} else if(rating==5){
		$('.star-1, .star-2, .star-3, .star-4, .star-5').addClass('star-hover');
	}
}

function rateout_store(rating){
	if(rating==1){
		$('.star-1').removeClass('star-hover');
	} else if(rating==2){
		$('.star-1, .star-2').removeClass('star-hover');
	} else if(rating==3){
		$('.star-1, .star-2, .star-3').removeClass('star-hover');
	} else if(rating==4){
		$('.star-1, .star-2, .star-3, .star-4').removeClass('star-hover');
	} else if(rating==5){
		$('.star-1, .star-2, .star-3, .star-4, .star-5').removeClass('star-hover');
	}
}

function dorate_store(storeID, rate){
	$.post('process/store-rate.php', {'storeID':storeID,'rate':rate}, function(resp){
		if(resp=="ok"){
			$('.valorar').load('process/store-new-rate.php', {'storeID':storeID}, function(){
				$(this).attr('title','Ya votaste este negocio');
			});
		}
	})
}


//// MENU SCROLL ////////////////////////////////////////////////////////

/*$(document).on('scroll', function(){

	scrollTop = $(window).scrollTop();

	if(scrollTop>50) {
		$('.new-menu').addClass("new-menu-on");
		$('.menu-nav').addClass("menu-nav-on");
		$('.menu-side').addClass("menu-side-on");
	} else {
		$('.new-menu').removeClass("new-menu-on");
		$('.menu-nav').removeClass("menu-nav-on");
		$('.menu-side').removeClass("menu-side-on");
	}

});*/


/* Funciones para New Alerts */

function offalerts(){
	$('#nalert').hide();
	$('#nconfirm').hide();
	$('#nlocation').hide();
}

function redirect(url){
	window.location = url;
}

function nalert(texto, callback){
	offalerts();
	$('#nalert-text').html(texto);
	if(callback!=""){
		$('#nalert-accept').attr('onclick',callback);
	}
	$('#nalert').show();
}

function nalert_off(){
	$('#nalert').hide();
}


function nconfirm(texto, callback){
	offalerts();
	$('#nconfirm-text').html(texto);
	$('#nconfirm-ok').attr('onclick',callback);
	$('#nconfirm').show();
}

function nconfirm_off(){
	$('#nconfirm').hide();
}


function nlocation(texto, url){
	offalerts();
	$('#nlocation-text').html(texto);
	$('#nlocation-accept').attr('onclick', 'redirect('+url+')');
	$('#nlocation').show();
}

function nlocation_off(){
	$('#nlocation').hide();
}


function nsession(texto){
	offalerts();
	$('#nsession-text').html(texto);
	$('#nsession-accept').attr('onclick', 'nsession_off()');
	$('#nsession').show();
}

function nsession_off(){
	$('#nsession').hide();
}