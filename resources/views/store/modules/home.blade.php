@extends('store.in')

@section('section.admin', 'Home')
@section('back.admin')
@endsection

@section('admin')

<div class="row mainbar">
	<div class="col-md-4 box-admin">
		<div class="box-admin-container">
			<div class="card-body">
				<h4 class="f17 fw600">
					<i class="fa fa-desktop inline-block marR5 text-primary"></i>
					<a href="{{ route('store.edit', ['alias' => $store->alias]) }}">Info general</a>
				</h4>
				<p class="f14">Administra el nombre, descripción y alias de tu negocio en esta web.</p>
				<p class="marB0"><a href="{{ route('store.edit', ['alias' => $store->alias]) }}" class="btn btn-primary btn-sm">Administrar</a></p>
			</div>
		</div>
	</div>
	<div class="col-md-4 box-admin">
		<div class="box-admin-container">
			<div class="card-body">
				<h4 class="f17 fw600">
					<i class="fa fa-at inline-block marR5 text-primary"></i>
					<a href="{{ route('store.data', ['alias' => $store->alias]) }}">Datos de contacto</a>
				</h4>
				<p class="f14">Gestiona los datos de contacto de tu negocio, para que los usuario puedan contactarte.</p>
				<p class="marB0"><a href="{{ route('store.data', ['alias' => $store->alias]) }}" class="btn btn-primary btn-sm">Administrar</a></p>
			</div>
		</div>
	</div>
	<div class="col-md-4 box-admin">
		<div class="box-admin-container">
			<div class="card-body">
				<h4 class="f17 fw600">
					<i class="fa fa-store inline-block marR5 text-primary"></i>
					<a href="{{ route('store.shop.config', ['alias' => $store->alias]) }}">Tienda virtual</a>
				</h4>
				<p class="f14">Personaliza todos los aspectos de tu tienda para darle identidad.</p>
				<p class="marB0"><a href="{{ route('store.shop.config', ['alias' => $store->alias]) }}" class="btn btn-primary btn-sm">Administrar</a></p>
			</div>
		</div>
	</div>
	<div class="col-md-4 box-admin">
		<div class="box-admin-container">
			<div class="card-body">
				<h4 class="f17 fw600">
					<i class="fa fa-box-open inline-block marR5 text-primary"></i>
					<a href="{{ route('items', ['alias' => $store->alias]) }}">Productos y servicios</a>
				</h4>
				<p class="f14">Gestiona los items que tienes a la venta, con todas sus características.</p>
				<p class="marB0"><a href="{{ route('items', ['alias' => $store->alias]) }}" class="btn btn-primary btn-sm">Administrar</a></p>
			</div>
		</div>
	</div>
	<div class="col-md-4 box-admin">
		<div class="box-admin-container">
			<div class="card-body">
				<h4 class="f17 fw600">
					<i class="fa fa-users inline-block marR5 text-primary"></i>
					<a href="{{ route('store.admins', ['alias' => $store->alias]) }}">Administradores</a>
				</h4>
				<p class="f14">Agrega personas a tu equipo, para ayudarte a gestionar tu negocio.</p>
				<p class="marB0"><a href="{{ route('store.admins', ['alias' => $store->alias]) }}" class="btn btn-primary btn-sm">Administrar</a></p>
			</div>
		</div>
	</div>
	<div class="col-md-4 box-admin">
		<div class="box-admin-container">
			<div class="card-body">
				<h4 class="f17 fw600">
					<i class="fa fa-envelope inline-block marR5 text-primary"></i>
					<a href="{{ route('store.messages', ['alias' => $store->alias]) }}">Centro de mensajes</a>
				</h4>
				<p class="f14">Revisa y responde las consultas que te envían los usuarios de la página.</p>
				<p class="marB0"><a href="{{ route('store.messages', ['alias' => $store->alias]) }}" class="btn btn-primary btn-sm">Administrar</a></p>
			</div>
		</div>
	</div>
</div>

@endsection