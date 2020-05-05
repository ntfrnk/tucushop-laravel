@extends('store.index')

@section('section.admin', 'Home')

@section('admin')

<div class="row justify-content-center">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body padT30 padB30 padLR30">
				
				@if($store->status == 1)

					<div class="f17">
						<h1 class="f30 marB15">Desactivar negocio</h1>
						<p>Estás a punto de desactivar tu negocio, y con ello también tus productos y servicios dejarán de estar publicados.</p>
						<p class="f17 bold marB20">¿Realmente deseas realizar este cambio?</p>
						<p>
							<a class="btn padLR40 btn-danger marR10" href="{{ route('store.status.change', ['alias' => $store->alias]) }}">Sí, desactivar negocio</a>
							<a class="btn padLR40 btn-outline-secondary" href="{{ route('store.home', ['alias' => $store->alias]) }}">No, volver al inicio</a>
						</p>
					</div>

				@else

					<div class="f17">
						<h1 class="f30 marB15">Reactivar negocio</h1>
						<p>Al realizar esta acción volverás a activar tu negocio. Esta operación también volverá a activar los productos y servicios que tienes publicados.</p>
						<p class="f17 bold marB20">¿Confirmas que deseas reactivar tu negocio?</p>
						<p>
							<a class="btn padLR40 btn-primary marR10" href="{{ route('store.status.change', ['alias' => $store->alias]) }}">Sí, reactivar negocio</a>
							<a class="btn padLR40 btn-outline-secondary" href="{{ route('store.home', ['alias' => $store->alias]) }}">No, volver al inicio</a>
						</p>
					</div>

				@endif

			</div>
		</div>
	</div>
</div>

@endsection