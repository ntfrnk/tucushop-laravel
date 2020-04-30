<div class="routing col-md-12">

	<span><a href="{{ route('store.list') }}">Mis negocios</a></span>
	<span><a href="{{ route('store.home', ['alias' => $store->alias]) }}">{{ $store->name }}</a></span>
	<span>@yield('section.admin')</span>

</div>