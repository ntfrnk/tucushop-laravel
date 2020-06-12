<div class="routing col-md-12">

	<span>Mi cuenta</span>
	<span class="d-none d-md-inline-block">@yield('section.admin')</span>

	<span class="inline-block f-right nobold routing-back">
		@section('back.admin')
			<a href="{{ route('user.home') }}">Volver al inicio</a>
		@show
	</span>

</div>