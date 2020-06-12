@if(isset(\Auth::user()->profile->photo) && !empty(\Auth::user()->profile->photo))
	@php($image_file = public_path().'/storage/users/resized/'.\Auth::user()->profile->photo)
    @if(file_exists($image_file) && !is_dir($image_file))
        @php($img = route('home').'/storage/users/resized/'.\Auth::user()->profile->photo.'?v='.\Auth::user()->profile->version_photo)
    @else
        @php($noimg = 1)
        @php($img = route('home').'/storage/users/resized/no-photo.jpg')
    @endif
@else
    @php($noimg = 1)
    @php($img = route('home').'/storage/users/resized/no-photo.jpg')
@endif

<header>

	<div class="container">
		<div class="">

			<div class="menu-logo">
				<a class="menu-logo-a" href="{{ route('home') }}">
					<img src="{{ asset('images/logo.svg') }}" class="menu-logo-img" />
				</a>
			</div>

			<div class="menu-search d-none d-md-inline-block">
				<form id="form-search" action="{{ route('search') }}" method="POST">
					@csrf
					<input type="text" id="search" name="search" placeholder="Escribe aquí lo que estás buscando" autocomplete="off" />
				</form>
			</div>

			<div class="menu-nav">

				<a href="javascript:;" class="d-block d-md-none menu-bars">
					<i class="fa fa-bars"></i>
				</a>

				<ul class="menu-nav-list d-none d-md-inline-block">
					@guest
						<li>
						    <a href="{{ route('login') }}">
						    	<i class="f17 fa fa-sign-in-alt"></i> Ingresar
						    </a>
						</li>
						<li>
						    <a href="{{ route('register') }}">
						    	<i class="f17 fa fa-id-card"></i> Registrarme
						    </a>
						</li>
					@else
						<li class="">
							<a href="javascript:;" class="user-menu">
								<img src="{{ isset($img) ? asset($img) : '' }}" class="rounded-circle" style="width: 36px; margin: 0 5px 0 10px;">
								{{ \Auth::user()->profile->name." ".\Auth::user()->profile->lastname }} <span class="caret"></span>
							</a>
							<ul class="user-submenu pad10">
								<li>
									<a href="{{ route('user.home') }}">
										<i class="w15 f17 fa fa-user"></i>
										Mi cuenta
									</a>
								</li>
								<li>
									<a href="{{ route('user.likes') }}">
										<i class="w15 f17 fa fa-heart"></i>
										Mis favoritos
									</a>
								</li>
								<li>
									<a href="{{ route('user.messages') }}">
										<i class="w15 f17 fa fa-envelope"></i>
										Mis mensajes
									</a>
								</li>
								<li>
									<a href="{{ route('store.list') }}">
										<i class="w15 f17 fa fa-store-alt"></i>
										Mis negocios
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="javascript:;" onclick="$('#logout-form').submit();">
										<i class="w15 f17 fa fa-sign-out-alt"></i> Salir
									</a>
		
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</li>
							</ul>
						</li>
						
						{{-- <li>
							<a href="{{ route('cart.items') }}"><i class="f17 fa fa-shopping-cart"></i></a>
						</li> --}}

					@endguest

					<li>
						<a href="{{ route('help') }}"><i class="f17 fa fa-question-circle"></i></a>
					</li>
				</ul>

			</div>

		</div>
	</div>

	<ul class="menu-nav-movil d-block d-md-none">
		@guest
			<li>
				<a href="{{ route('login') }}">
					<i class="f17 fa fa-sign-in-alt"></i> Ingresar
				</a>
			</li>
			<li>
				<a href="{{ route('register') }}">
					<i class="f17 fa fa-id-card"></i> Registrarme
				</a>
			</li>
			<li>
				<a href="{{ route('help') }}">
					<i class="w15 f17 fa fa-question-circle"></i> Centro de ayuda
				</a>
			</li>
		@else
			<li class="marL30 marB20 padB20">
				<img src="{{ isset($img) ? asset($img) : '' }}" class="rounded-circle" style="width: 36px; margin: 0 5px 0 0;">
				{{ \Auth::user()->profile->name." ".\Auth::user()->profile->lastname }}
			</li>
			<li>
				<a href="{{ route('user.home') }}">
					<i class="w15 f17 fa fa-user"></i>
					Mi cuenta
				</a>
			</li>
			<li>
				<a href="{{ route('user.likes') }}">
					<i class="w15 f17 fa fa-heart"></i>
					Mis favoritos
				</a>
			</li>
			<li>
				<a href="{{ route('user.messages') }}">
					<i class="w15 f17 fa fa-envelope"></i>
					Mis mensajes
				</a>
			</li>
			<li>
				<a href="{{ route('store.list') }}">
					<i class="w15 f17 fa fa-store-alt"></i>
					Mis negocios
				</a>
			</li>
			<li>
				<a href="{{ route('help') }}">
					<i class="w15 f17 fa fa-question-circle"></i> Centro de ayuda
				</a>
			</li>
			<li>
				<a href="javascript:;" onclick="$('#logout-form').submit();">
					<i class="w15 f17 fa fa-sign-out-alt"></i> Salir
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</li>
			
			{{-- <li>
				<a href="{{ route('cart.items') }}"><i class="f17 fa fa-shopping-cart"></i></a>
			</li> --}}

		@endguest

	</ul>
	 
</header>