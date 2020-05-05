@extends('store.index')

@section('section.admin', 'Items')

@section('admin')

<div class="row justify-content-center">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body pad30">

				<div class="f17 marB30">
					<div class="f-right align-right">
						<a href="{{ route('item.list.type', ['alias' => $store->alias, 'style' => 'list']) }}" class="btn btn-{{ session('listType') == 'list' ? 'secondary disabled' : 'outline-secondary' }}" title="Mostrar los registros a modo de lista"><i class="fa fa-list"></i></a>
						<a href="{{ route('item.list.type', ['alias' => $store->alias, 'style' => 'grid']) }}" class="btn btn-{{ session('listType') == 'grid' ? 'secondary disabled' : 'outline-secondary' }}" title="Mostrar los registros a modo de grilla"><i class="fa fa-th-large"></i></a>
						<a href="{{ route('item.new', ['alias' => $store->alias]) }}" class="marL10 btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Agregar un nuevo item</a>
					</div>
					<h1 class="f30 marB15">Mis productos y servicios</h1>
					<hr>
				</div>

				{{-- <div class="marB30 row">
					<div class="input-group col-md-6">
						<input type="text" class="form-control" placeholder="Buscar un item" aria-label="Recipient's username" aria-describedby="button-addon2">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i> &nbsp;Buscar</button>
						</div>
					</div>
					<div class="align-center col-md-2">
						<a href="{{ route('item.list.type', ['alias' => $store->alias, 'style' => 'list']) }}" class="btn btn-{{ session('listType') == 'list' ? 'secondary disabled' : 'outline-secondary' }}" title="Mostrar los registros a modo de lista"><i class="fa fa-list"></i></a>
						<a href="{{ route('item.list.type', ['alias' => $store->alias, 'style' => 'grid']) }}" class="btn btn-{{ session('listType') == 'grid' ? 'secondary disabled' : 'outline-secondary' }}" title="Mostrar los registros a modo de grilla"><i class="fa fa-th-large"></i></a>
					</div>
					<div class="f-right align-right col-md-4">
						<a href="{{ route('item.new', ['alias' => $store->alias]) }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Agregar un nuevo item</a>
					</div>
				</div> --}}

				@if(session('listType')=='list')

					<div class="show-list">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="w45">Nombre del item</th>
									<th class="w55 a-right">Opciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($items as $item)
								<tr>
									<td>{{ $item->name }}</td>
									<td class="a-right">
										<a href="{{ route('item.edit', ['alias' => $store->alias, 'item_id' => $item->id]) }}" class="marR5 btn btn-sm btn-primary" title="Editar la información de este item"><i class="fa fa-edit"></i> Editar</a>
										<a href="{{ route('item.photos', ['alias' => $store->alias, 'item_id' => $item->id]) }}" class="marR5 btn btn-sm btn-primary" title="Gestionar las fotos de este item"><i class="fa fa-camera"></i> Fotos</a>
										<a href="{{ route('item.status', ['item_id' => $item->id]) }}" class="marR5 btn btn-sm btn-outline-secondary" title="Desactivar este item"><i class="fa fa-ban"></i> Desactivar</a>
										<a href="javascript:;" onclick="confirm_open_link('¿Estás seguro de que quieres eliminar este item?', '{{ route('item.delete', ['item_id' => $item->id]) }}');" class="btn btn-sm btn-outline-danger" title="Eliminar este item"><i class="fa fa-times"></i> Eliminar</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>

				@else

					<div class="show-grid">
						<div class="row">
							@php($noimg = 'storage/items/sm/no-image-min.jpg')
							@foreach($items as $item)
								@php($img = 'storage/items/sm/'.\PhotoItem::first($item->id))
								<div class="col-md-3">
									<div class="show-grid-item">
										<div class="item-info">
											<img src="{{ file_exists($img) && !is_dir($img) ? asset($img) : asset($noimg) }}" class="img-fluid">
											<div>{{ $item->name }}</div>
										</div>
										<div class="options">
											<a href="{{ route('item.edit', ['alias' => $store->alias, 'item_id' => $item->id]) }}" class="btn btn-sm btn-primary" title="Editar la información de este item"><i class="fa fa-edit"></i></a>
											<a href="{{ route('item.photos', ['alias' => $store->alias, 'item_id' => $item->id]) }}" class="btn btn-sm btn-primary" title="Gestionar las fotos de este item"><i class="fa fa-camera"></i></a>
											<a href="{{ route('item.status', ['item_id' => $item->id]) }}" class="btn btn-sm btn-{{ $item->status == 1 ? 'outline-secondary' : 'secondary' }}" title="{{ $item->status == 1 ? 'Desactivar' : 'Activar' }} este item"><i class="fa fa-ban"></i></a>
											<a href="javascript:;" onclick="confirm_open_link('¿Estás seguro de que quieres eliminar este item?', '{{ route('item.delete', ['item_id' => $item->id]) }}');" class="btn btn-sm btn-outline-danger" title="Eliminar este item"><i class="fa fa-times"></i></a>
										</div>
									</div>
								</div>
								@php($img='')
							@endforeach
						</div>
					</div>

				@endif

				<div class="a-center marT30">
					<hr>
					<div class="marAuto inline-block">
						{{ $items->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection