<div class="routing col-md-12">

	<span><a href="{{ route('store.list') }}">Mis negocios</a></span>
	<span><a href="{{ route('store.home', ['alias' => $store->alias]) }}" class="{{ $store->status == 0 ? 'text-danger' : '' }}">{{ $store->name }} {!! $store->status == 0 ? '<b>(Deshabilitado)</b>' : '' !!}</a></span>
	<span>@yield('section.admin')</span>

	<span class="inline-block f-right nobold routing-back">
		@section('back.admin')
			<a href="{{ route('store.home', ['alias' => $store->alias]) }}">Volver al inicio</a>
		@show
	</span>

</div>