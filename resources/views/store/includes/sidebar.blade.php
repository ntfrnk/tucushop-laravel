<div class="col-md-3 sidebar">

	<ul>
		<li>
			<a href="{{ route('store.home', ['alias' => $store->alias]) }}">
				<i class="fa fa-home"></i> Principal
			</a>
		</li>
		<li>
			<a href="{{ route('store.edit', ['alias' => $store->alias]) }}">
				<i class="fa fa-door-closed"></i> Info general
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
			<a href="{{ route('store.items', ['alias' => $store->alias]) }}">
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
		<li>
			<a href="{{ route('store.status', ['alias' => $store->alias]) }}">
				<i class="fa fa-ban"></i> Deshabilitar negocio
			</a>
		</li>
		<li>
			<a href="{{ route('store.delete', ['alias' => $store->alias]) }}">
				<i class="fa fa-times"></i> Eliminar negocio
			</a>
		</li>
	</ul>

</div>