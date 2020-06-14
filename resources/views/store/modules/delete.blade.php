@extends('store.in')

@section('section.admin', 'Eliminar negocio')

@section('admin')

<div class="row justify-content-center">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body card-body-pad">

				<div class="card-body-title card-body-title-1">
					<h1>Eliminar negocio</h1>
					<hr>
				</div>
				<div class="f17">
					<p>Estás a punto de eliminar tu negocio, y con ello también se eliminarán todos tus productos y servicios. Es importante que entiendas que esta operación es <b>irreversible</b>, y una vez que la confirmes no podrás recuperar la información que pierdas tras esta acción.</p>
					<p class="f17 bold marB20">¿Estás seguro/a de que deseas hacerlo?</p>
					<p>
						<a class="btn btn-important btn-danger" href="{{ route('store.delete.confirm', ['alias' => $store->alias]) }}">Sí, eliminar negocio</a>
						<a class="btn btn-important btn-link" href="{{ route('store.home', ['alias' => $store->alias]) }}">No, volver al inicio</a>
					</p>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection