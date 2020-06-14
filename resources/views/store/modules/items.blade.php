@extends('store.in')

@section('section.admin', 'Items')

@section('admin')

<div class="row justify-content-center">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body card-body-pad">

				<div class="card-body-title ">
					<div class="f-right align-right d-none d-md-block">
						<a href="{{ route('item.list.type', ['alias' => $store->alias, 'style' => 'list']) }}" class="btn btn-{{ session('listType') == 'list' ? 'secondary disabled' : 'outline-secondary' }}" title="Mostrar los registros a modo de lista"><i class="fa fa-list"></i></a>
						<a href="{{ route('item.list.type', ['alias' => $store->alias, 'style' => 'grid']) }}" class="btn btn-{{ session('listType') == 'grid' ? 'secondary disabled' : 'outline-secondary' }}" title="Mostrar los registros a modo de grilla"><i class="fa fa-th-large"></i></a>
						<a href="{{ route('item.new', ['alias' => $store->alias]) }}" class="marL10 btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Agregar un nuevo item</a>
					</div>
					<h1>Mis productos y servicios</h1>
					<hr>
				</div>

				<a href="{{ route('item.new', ['alias' => $store->alias]) }}" class="btn-new">
					<i class="fa fa-plus"></i>
				</a>

				@if($items->count()!=0)

					@if(session('listType')=='list')

						<div class="show-list">
							<table class="table table-hover">
								<thead>
									<tr>
										<th class="w45">{{ __('Nombre del item') }}</th>
										<th class="w55 a-right">Opciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach($items as $item)
									<tr>
										<td>
											@if($item->offer && $item->offer->expiration > date('Y-m-d'))
												<span class="badge badge-success">OFERTA</span>
											@endif
											{{ $item->name }}
										</td>
										<td class="a-right">
											<a href="{{ route('item.edit', ['alias' => $store->alias, 'item_id' => $item->id]) }}" class="marR5 btn btn-sm btn-primary" title="Editar la información de este item"><i class="fa fa-edit"></i> Editar</a>
											<a href="{{ route('item.photos', ['alias' => $store->alias, 'item_id' => $item->id]) }}" class="marR5 btn btn-sm btn-primary" title="Gestionar las fotos de este item"><i class="fa fa-camera"></i> Fotos</a>
											@if($item->status == 0 && ($item->photos->count() == 0 || $item->price == 0 || empty($item->detail)))
												<a href="javascript:;" onclick="notify_open('No puedes publicar un item sin foto.')" class="marR5 btn btn-sm btn-secondary" title="Activar este item"><i class="fa fa-check"></i> Activar</a>
											@else
												<a href="{{ route('item.status', ['item_id' => $item->id]) }}" class="marR5 btn btn-sm btn-{{ $item->status == 1 ? 'outline-secondary' : 'secondary' }}" title="{{ $item->status == 1 ? 'Desactivar' : 'Activar' }} este item"><i class="fa fa-{{ $item->status == 1 ? 'ban' : 'check' }}"></i> {{ $item->status == 1 ? 'Desactivar' : 'Activar' }}</a>
											@endif
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
									@if(isset($item->photos->sortBy('ordering')->first()->file_path) && !empty($item->photos->sortBy('ordering')->first()->file_path))
										@php($img = 'storage/items/sm/'.$item->photos->sortBy('ordering')->first()->file_path)
									@endif
									<div class="col-6 col-md-3">
										<div class="show-grid-item show-grid-item-favs">
											<div class="item-info relative">
												<a href="{{ route('item.edit', ['alias' => $store->alias, 'item_id' => $item->id]) }}" title="Editar la información de este item">
													<img src="{{ file_exists($img) && !is_dir($img) ? asset($img.'?v='.$item->photos->sortBy('ordering')->first()->version) : asset($noimg) }}" class="img-fluid">
												</a>
												<div>{{ $item->name }}</div>
												@if($item->offer && $item->offer->expiration > date('Y-m-d'))
												<span class=" f12 fw600 w40 a-center text-white absolute t100 l0 bg-danger inline-block">{{ $item->offer->percent }}% OFF</span>
												@endif
											</div>
											<div class="options">
												<a href="{{ route('item.edit', ['alias' => $store->alias, 'item_id' => $item->id]) }}" class="btn btn-sm btn-primary" title="Editar la información de este item"><i class="fa fa-edit"></i></a>
												<a href="{{ route('item.photos', ['alias' => $store->alias, 'item_id' => $item->id]) }}" class="btn btn-sm btn-primary" title="Gestionar las fotos de este item"><i class="fa fa-camera"></i></a>
												@if($item->status == 0 && ($item->photos->count() == 0 || $item->price == 0 || empty($item->detail)))
													<a href="javascript:;" onclick="notify_open('No puedes publicar un item sin foto.')" class="btn btn-sm btn-secondary" title="Activar este item"><i class="fa fa-check"></i></a>
												@else
													<a href="{{ route('item.status', ['item_id' => $item->id]) }}" class="btn btn-sm btn-{{ $item->status == 1 ? 'outline-secondary' : 'secondary' }}" title="{{ $item->status == 1 ? 'Desactivar' : 'Activar' }} este item"><i class="fa fa-{{ $item->status == 1 ? 'ban' : 'check' }}"></i></a>
												@endif
												<a href="javascript:;" onclick="confirm_open_link('¿Estás seguro de que quieres eliminar este item?', '{{ route('item.delete', ['item_id' => $item->id]) }}');" class="btn btn-sm btn-outline-danger" title="Eliminar este item"><i class="fa fa-times"></i></a>
											</div>
										</div>
									</div>
									@php($img='')
								@endforeach
							</div>
						</div>

					@endif

				@else

					<table class="table">
						<tr>
							<td class="padTB50 f17 align-center">
								<p class="marB10"><em>Aún no se cargaron productos y/o servicios</em></p>
								<p><a href="{{ route('item.new', ['alias' => $store->alias]) }}">¿Comenzar ahora?</a></p>
							</td>
						</tr>
					</table>

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