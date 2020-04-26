<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	{{-- CSRF Token --}}

	<meta name="csrf-token" content="{{ csrf_token() }}">

	{{-- Título general de la web --}}

	<title>@yield('title') :: {{ config('app.name', 'Laravel') }}</title>

	{{-- Tags para SEO --}}

	<meta name="title" content="" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />

	{{-- Ruta base del sitio --}}

	<base href="" />

	{{-- Tags sociales --}}

	<meta property="fb:app_id" content="541723052872159" />
	<meta property="og:url" content="" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:image" content="" />

	<meta name="twitter:card" content="summary" />
	<meta name="twitter:title" content="" />
	<meta name="twitter:description" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:image" content="" />
	
	{{-- Estilos para plugins --}}

	<link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/OwlCarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/OwlCarousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/font-awesome/css/all.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/hover-effect/css/themeHover.css') }}" rel="stylesheet">

	{{-- Estilos CSS --}}

	<link href="{{ asset('styles/app.css') }}" rel="stylesheet">
	<link href="{{ asset('styles/tshop.base.css') }}" rel="stylesheet">
	<link href="{{ asset('styles/tshop.theme.css') }}" rel="stylesheet">
	<link href="{{ asset('styles/tshop.modules.css') }}" rel="stylesheet">
	<link href="{{ asset('styles/tshop.helpers.css') }}" rel="stylesheet">

	{{-- Icono --}}

	<link href="{{ asset('images/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
	<link href="{{ asset('images/favicon.ico') }}" rel="icon" type="image/x-icon">

	{{-- Tipografías Laravel --}}

	<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

</head>


<body>
	<div id="app">

		<header>

			<div class="container">
				<div class="row">

					<div class="menu-logo">
						<a class="menu-logo-a" href="{{ route('home') }}">
							<img src="{{ asset('images/logo.png') }}" class="menu-logo-img" />
						</a>
					</div>

					<div class="menu-search">
						<input type="text" id="searcher" value="" placeholder="Buscar productos y servicios..." autocomplete="off" />
					</div>

					<div class="menu-nav">

						<ul class="menu-nav-list">
							@guest
								<li>
								    <a href="{{ route('login') }}">{{ __('Login') }}</a>
								</li>
								<li>
								    <a href="{{ route('register') }}">{{ __('Register') }}</a>
								</li>
							@else
								<li class="">
									<a href="javascript:;" class="user-menu">
										<img src="" class="img-circle" style="width: 36px; margin-right: 10px; border: solid 2px #999;">
										Mi cuenta <span class="caret"></span>
									</a>
									<ul class="user-submenu">
										<li><a href="user/">Administrar</a></li>
										<li><a href="user/wishlist/">Favoritos</a></li>
										<li><a href="user/messages/">Mensajes<</a></li>
										<li><a href="store/">Mis negocios</a></li>
										<li><a href="logout/"><span class="text-danger">Cerrar sesión</span></a></li>
									</ul>
								</li>
								<li>
									<a class="dropdown-item" href="{{ route('logout') }}"
									   onclick="event.preventDefault();
									                 document.getElementById('logout-form').submit();">
									    {{ __('Logout') }}
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									    @csrf
									</form>
								</li>
							@endguest
							<li class=""><a href="help/"><i class="glyphicon glyphicon-question-sign margin-right-05em"></i>Ayuda</a></li>
						</ul>
					</div>

				</div>
			</div>
			 
		</header>


		<main class="py-4">
			@yield('content')
		</main>

	</div>


	
	{{-- Pie de página --}}

	<footer class="main_footer">
	    <div class="container">
	        <div class="padT70 padB40">
	            <div class="row">
	                <div class="col-md-4 col-sm-6 col-xs-12">
	                    <div class="foot-sec">
	                        <h3>Atención al cliente</h3>
	                        <p>Red Tucushop
	                            <br>Phone: +54 9 381 511-3710
	                            <br>E-mail: info@tucushop.com
	                        </p>
	                        <p>
	                            <a href="https://www.facebook.com/moda.tucushop/" target="_blank"><span><i class="fab fa-facebook" aria-hidden="true"></i></span></a>
	                            <a href="https://www.instagram.com/moda.tucushop/" target="_blank"><span><i class="fab fa-instagram" aria-hidden="true"></i></span></a>
	                            <a href="https://www.twitter.com/moda.tucushop/" target="_blank"><span><i class="fab fa-twitter" aria-hidden="true"></i></span></a>
	                            <a href="https://www.pinterest.com/moda.tucushop/" target="_blank"><span><i class="fab fa-pinterest" aria-hidden="true"></i></span></a>
	                        </p>
	                    </div>
	                </div>
	                <div class="col-md-4 col-sm-6 col-xs-12">
	                    <div class="foot-sec">
	                        <h3>TU CUENTA </h3>
	                        <ul class="pad0">
	                            <? if(!isset($_SESSION['moda_user'])){ ?>
	                                <li><a href="login/"><i class="fa fa-angle-right" aria-hidden="true"></i>Inicia sesión</a></li>
	                                <li><a href="register/"><i class="fa fa-angle-right" aria-hidden="true"></i>Crea tu cuenta</a></li>
	                            <? } else { ?>
	                                <li><a href="user/"><i class="fa fa-angle-right" aria-hidden="true"></i>Mis datos personales</a></li>
	                                <li><a href="store/"><i class="fa fa-angle-right" aria-hidden="true"></i>Administrar mis negocios</a></li>
	                            <? } ?>
	                            <li><a href="javascript:;" onclick="reportar()"><i class="fa fa-angle-right" aria-hidden="true"></i>Reportar un error en la página</a></li>
	                            <li><a href="javascript:;" onclick="contactus()"><i class="fa fa-angle-right" aria-hidden="true"></i>Hacenos una consulta</a></li>
	                        </ul>
	                    </div>
	                </div>
	                <div class="col-md-4 col-sm-6 col-xs-12">
	                    <div class="foot-sec">
	                        <h3>PARTICIPA </h3>
	                        <ul class="pad0">
	                            <li><a href="pages/vender-en-este-sitio_33/"><i class="fa fa-angle-right" aria-hidden="true"></i>Vender en este sitio</a></li>
	                            <li><a href="help/"><i class="fa fa-angle-right" aria-hidden="true"></i>Centro de ayuda</a></li>
	                            <li><a href="pages/politicas-de-privacidad_22/"><i class="fa fa-angle-right" aria-hidden="true"></i>Políticas de privacidad</a></li>
	                            <li><a href="pages/terminos-y-condiciones-del-servicio_11/"><i class="fa fa-angle-right" aria-hidden="true"></i>Términos y condiciones de uso</a></li>
	                        </ul>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="bottom-footer padTB30 hide">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-6 col-sm-6 col-xs-12">
	                    <p class="lh40">Copyright 2018 &copy; All Right Reserved - <a href="https://www.xtofactory.com/"><span>XTO Factory</span></a></p>
	                </div>
	                <div class="col-md-6 col-sm-6 col-xs-12">
	                    <figure>
	                        <img src="assets/images/logo-xtofactory.png" alt=""/>
	                    </figure>
	                </div>
	            </div>
	        </div>
	    </div>
	</footer>



	{{-- Scripts (cargan al final) --}}

	<script src="{{ asset('scripts/app.js') }}" defer></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" defer></script>
	<script src="{{ asset('plugins/OwlCarousel/owl.carousel.js') }}" defer></script>
	<script src="{{ asset('plugins/EasyAutocomplete/jquery.easy-autocomplete.min.js') }}" defer></script>
	<script src="{{ asset('scripts/tshop.basics.js') }}" defer></script>

</body>
</html>
