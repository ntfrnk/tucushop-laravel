<header>

	<div class="container">
		<div class="">

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
							<a href="help/"><i class="f17 fa fa-question-circle"></i> Ayuda</a>
						</li>
					@else
						<li class="">
							<a href="javascript:;" class="user-menu">
								<img src="{{ asset('images/profile.jpg') }}" class="rounded-circle" style="width: 36px; margin: 0 5px 0 10px;">
								Mi cuenta <span class="caret"></span>
							</a>
							<ul class="user-submenu">
								<li><a href="user/home">Mis datos</a></li>
								<li><a href="user/likes">Mis favoritos</a></li>
								<li><a href="user/messages">Mensajes<</a></li>
								<li><a href="user/stores">Mis negocios</a></li>
							</ul>
						</li>
						<li>
							<a href="help/"><i class="f17 fa fa-question-circle"></i> Ayuda</a>
						</li>
						<li>
							<a class="dropdown-item" href="javascript:;" onclick="$('#logout-form').submit();">
								<i class="f17 fa fa-sign-out-alt"></i> Salir
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							    @csrf
							</form>
						</li>
					@endguest
				</ul>
			</div>

		</div>
	</div>
	 
</header>