<div class="routing col-md-12">

	<span>Centro de ayuda &nbsp; </span>
	<span>@yield('section.help')</span>

	<span class="inline-block f-right nobold routing-back">
		@section('back.help')
			<a href="{{ route('help') }}">Volver al inicio</a>
		@show
	</span>

</div>