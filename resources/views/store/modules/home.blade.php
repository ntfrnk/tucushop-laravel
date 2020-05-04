@extends('store.index')

@section('section.admin', 'Home')
@section('back.admin')
@endsection

@section('admin')

<div class="row mainbar">
	<div class="col-md-4 box-admin">
		<div class="box-admin-container">
			<div class="card-header">Info general</div>
			<div class="card-body">
				<p>Administra el nombre, descripción y alias de tu negocio en esta web.</p>
				<p class="marB0"><a href="{{ route('store.edit', ['alias' => $store->alias]) }}" class="btn btn-primary btn-sm">Administrar</a></p>
			</div>
		</div>
	</div>
	<div class="col-md-4 box-admin">
		<div class="box-admin-container">
			<div class="card-header">Datos de contacto</div>
			<div class="card-body">
				<p>Gestiona los datos de contacto de tu negocio, para que los usuario puedan contactarte.</p>
				<p class="marB0"><a href="{{ route('store.data', ['alias' => $store->alias]) }}" class="btn btn-primary btn-sm">Administrar</a></p>
			</div>
		</div>
	</div>
	<div class="col-md-4 box-admin">
		<div class="box-admin-container">
			<div class="card-header">Tienda virtual</div>
			<div class="card-body">
				<p>Personaliza todos los aspectos de tu tienda para darle identidad.</p>
				<p class="marB0"><a href="{{ route('store.shopConfig', ['alias' => $store->alias]) }}" class="btn btn-primary btn-sm">Administrar</a></p>
			</div>
		</div>
	</div>
	<div class="col-md-4 box-admin">
		<div class="box-admin-container">
			<div class="card-header">Productos y servicios</div>
			<div class="card-body">
				<p>Gestiona los items que tienes a la venta, con todas sus características.</p>
				<p class="marB0"><a href="{{ route('items', ['alias' => $store->alias]) }}" class="btn btn-primary btn-sm">Administrar</a></p>
			</div>
		</div>
	</div>
	<div class="col-md-4 box-admin">
		<div class="box-admin-container">
			<div class="card-header">Administradores</div>
			<div class="card-body">
				<p>Agrega personas a tu equipo, para ayudarte a gestionar tu negocio.</p>
				<p class="marB0"><a href="{{ route('store.admins', ['alias' => $store->alias]) }}" class="btn btn-primary btn-sm">Administrar</a></p>
			</div>
		</div>
	</div>
	<div class="col-md-4 box-admin">
		<div class="box-admin-container">
			<div class="card-header">Centro de mensajes</div>
			<div class="card-body">
				<p>Revisa y responde las consultas que te envían los usuarios de la página.</p>
				<p class="marB0"><a href="{{ route('store.messages', ['alias' => $store->alias]) }}" class="btn btn-primary btn-sm">Administrar</a></p>
			</div>
		</div>
	</div>
</div>

@endsection