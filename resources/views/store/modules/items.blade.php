@extends('store.index')

@section('section.admin', 'Items')

@section('admin')

<div class="row justify-content-center">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body padT30 padB30 padLR30">
				<div class="marB30 row">
					<div class="input-group col-md-6">
						<input type="text" class="form-control" placeholder="Buscar un item" aria-label="Recipient's username" aria-describedby="button-addon2">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i> &nbsp;Buscar</button>
						</div>
					</div>
					<div class="f-right align-right col-md-6">
						<a href="{{ route('store.item.new', ['alias' => $store->alias]) }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Agregar un nuevo item</a>
					</div>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="w65">Nombre del item</th>
							<th class="w35 a-right">Opciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($items as $item)
						<tr>
							<td>{{ $item->name }}</td>
							<td class="a-right">
								<a href="" class="btn btn-sm btn-outline-secondary"><i class="fa fa-camera"></i></a>
								<a href="{{ route('store.item.edit', ['alias' => $store->alias, 'item_id' => $item->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
								<a href="" class="btn btn-sm btn-outline-secondary"><i class="fa fa-star"></i></a>
								<a href="" class="btn btn-sm btn-outline-secondary"><i class="fa fa-tag"></i></a>
								<a href="" class="btn btn-sm btn-outline-secondary"><i class="fa fa-ban"></i></a>
								<a href="" class="btn btn-sm btn-outline-secondary"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
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
	
</div>

@endsection