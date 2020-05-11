<div class="routing col-md-12">

	<span>Configuración de usuario</span>
	<span>@yield('section.admin')</span>

	<span class="inline-block f-right nobold routing-back">
		@section('back.admin')
			<a href="{{ route('user.home') }}">Volver al inicio</a>
		@show
	</span>

</div>