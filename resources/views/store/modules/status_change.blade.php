@extends('store.in')

@section('section.admin', $store->status == 1 ? 'Desactivar negocio' : 'Reactivar negocio')

@section('admin')

<div class="row justify-content-center">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body card-body-pad">
				
				@if($store->status == 1)

					<div class="card-body-title card-body-title-1">
						<h1>Deshabilitar negocio</h1>
						<hr>
					</div>
					<div class="f17">
						<p>Estás a punto de desactivar tu negocio, y con ello también tus productos y servicios dejarán de estar publicados.</p>
						<p class="f17 bold marB20">¿Realmente deseas realizar este cambio?</p>
						<p>
							<a class="btn btn-important btn-danger" href="{{ route('store.status.change', ['alias' => $store->alias]) }}">Sí, desactivar negocio</a>
							<a class="btn btn-important btn-link" href="{{ route('store.home', ['alias' => $store->alias]) }}">No, volver al inicio</a>
						</p>
					</div>

				@else

					<div class="card-body-title card-body-title-1">
						<h1>Habilitar negocio</h1>
						<hr>
					</div>
					<div class="f17">
						<p>Al realizar esta acción se activará tu negocio, y los items que tienes cargados (y habilitados) comenzarán a mostrarse en los listados de la web.</p>
						<p class="f17 bold marB20">¿Confirmas que deseas realizar esta operación?</p>
						<p>
							<a class="btn btn-important btn-primary" href="{{ route('store.status.change', ['alias' => $store->alias]) }}">Sí, habilitar mi negocio</a>
							<a class="btn btn-important btn-link" href="{{ route('store.home', ['alias' => $store->alias]) }}">No, volver al inicio</a>
						</p>
					</div>

				@endif

			</div>
		</div>
	</div>
</div>

@endsection