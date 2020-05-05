@extends('store.index')

@section('section.admin', 'Eliminar negocio')

@section('admin')

<div class="row justify-content-center">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body pad30">

				<div class="f17">
					<h1 class="f30 marB15">Advertencia</h1>
					<p>Estás a punto de eliminar tu negocio, y con ello también se eliminarán todos tus productos y servicios. Es importante que entiendas que esta operación es <b>irreversible</b>, y una vez que la confirmes no podrás la información que potencialmente puedas llegar a perder.</p>
					<p class="f17 bold marB20">¿Estás seguro/a de que deseas realizar este cambio?</p>
					<p>
						<a class="btn padLR40 btn-danger marR10" href="{{ route('store.delete.confirm', ['alias' => $store->alias]) }}">Sí, eliminar negocio</a>
						<a class="btn padLR40 btn-outline-secondary" href="{{ route('store.home', ['alias' => $store->alias]) }}">No, volver al inicio</a>
					</p>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection