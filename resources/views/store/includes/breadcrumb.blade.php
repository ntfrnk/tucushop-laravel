<div class="routing col-md-12">

	<span class="inline-block f-right nobold routing-back">
		@section('back.admin')
			<a href="{{ route('store.home', ['alias' => $store->alias]) }}">Volver al inicio</a>
		@show
	</span>

	<div class="d-none d-md-block">
		<span><a href="{{ route('store.list') }}">Mis negocios</a></span> / &nbsp; 
		<span>{{ $store->name }} {!! $store->status == 0 ? '<b>(Deshabilitado)</b>' : '' !!}</span>
		{{-- <span>@yield('section.admin')</span> --}}
	</div>

	<div class="d-inline-block d-md-none">
		<span>{{ $store->name }} {!! $store->status == 0 ? '<i class="fa fa-ban text-danger"></i>' : '<i class="fa fa-check text-success"></i>' !!}</span>
	</div>

</div>