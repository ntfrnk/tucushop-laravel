<div class="col-md-4 col-lg-3 sidebar">

	<ul>
		<li>
			<a href="{{ route('user.home') }}">
				<i class="fa fa-home"></i> Principal
			</a>
		</li>
		<li>
			<a href="{{ route('user.account') }}">
				<i class="fa fa-key"></i> Datos de la cuenta
			</a>
		</li>
		<li class="d-block d-lg-none">
			<a href="{{ route('user.profile') }}">
				<i class="fa fa-image"></i> Foto de perfil
			</a>
		</li>
		<li>
			<a href="{{ route('user.edit') }}">
				<i class="fa fa-user"></i> Información personal
			</a>
		</li>
		<li>
			<a href="{{ route('user.contact') }}">
				<i class="fa fa-mobile-alt"></i> Datos de contacto
			</a>
		</li>
		<li>
			<a href="{{ route('user.likes') }}">
				<i class="fa fa-heart"></i> Mis favoritos
			</a>
		</li>
		{{-- <li>
			<a href="{{ route('user.preferences') }}">
				<i class="fa fa-users-cog"></i> Mis preferencias
			</a>
		</li> --}}
		<li>
			<a href="{{ route('user.messages') }}">
				<i class="fa fa-envelope"></i> Centro de Mensajes
			</a>
		</li>
	</ul>

</div>