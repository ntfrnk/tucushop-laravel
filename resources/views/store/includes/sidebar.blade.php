<div class="col-md-3 sidebar">

	<ul>
		<li>
			<a href="{{ route('store.home', ['alias' => $store->alias]) }}">
				<i class="fa fa-home"></i> Principal
			</a>
		</li>
		<li>
			<a href="{{ route('store.edit', ['alias' => $store->alias]) }}">
				<i class="fa fa-desktop"></i> Info general
			</a>
		</li>
		<li>
			<a href="{{ route('store.data', ['alias' => $store->alias]) }}">
				<i class="fa fa-at"></i> Datos de contacto
			</a>
		</li>
		<li>
			<a href="{{ route('store.shopConfig', ['alias' => $store->alias]) }}">
				<i class="fa fa-store-alt"></i> Tienda virtual
			</a>
		</li>
		<li>
			<a href="{{ route('items', ['alias' => $store->alias]) }}">
				<i class="fa fa-box-open"></i> Productos & Servicios
			</a>
		</li>
		<li>
			<a href="{{ route('store.admins', ['alias' => $store->alias]) }}">
				<i class="fa fa-users"></i> Administradores
			</a>
		</li>
		<li>
			<a href="{{ route('store.messages', ['alias' => $store->alias]) }}">
				<i class="fa fa-envelope"></i> Centro de Mensajes
			</a>
		</li>
		<li class="marT20">
			<a href="{{ route('store.status', ['alias' => $store->alias]) }}" class="text-{{ $store->status == 1 ? 'danger' : 'success' }}">
				<i class="fa fa-{{ $store->status == 1 ? 'store-slash' : 'store' }}"></i> {{ $store->status == 1 ? 'Deshabilitar' : 'Habilitar' }} negocio
			</a>
		</li>
		<li>
			<a href="{{ route('store.delete', ['alias' => $store->alias]) }}" class="text-danger">
				<i class="fa fa-times"></i> Eliminar negocio
			</a>
		</li>
	</ul>

</div>