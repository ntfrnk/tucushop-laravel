@extends('store.in')

@section('section.admin', 'Gestión de fotos')

@section('back.admin')
    <a href="{{ route('item.edit', ['alias' => $store->alias, 'item_id' => $item->id]) }}">Volver a la edición del item</a>
@endsection

@php($noimg = 'storage/items/sm/no-image-min.jpg')

@section('admin')

<div class="row justify-content-center">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body card-body-min pad30">

				<div class="f16">
					<div class="f-right">
						<button type="button" id="photo-ordering" class="btn btn-secondary spn none" spn-text="Estamos guardando el nuevo orden...">Guardar orden</button>
						<button type="button" id="photo-upload" class="btn btn-primary spn">Subir una nueva foto</button>
					</div>
				    <h1 class="f30 marB15">Gestionar fotos</h1>
				    <hr>
				</div>
				
				@if($item->photos->count() > 1)
					<div class="f15 marB30">
						<p>Para ordenar las fotos sólo debes arrastrarlas a la posición deseada, y luego confirmar el nuevo orden haciendo click en el botón «Guardar orden».</p>
					</div>
				@endif

				<div class="row marT20" id="{{ $item->photos->count() > 1 ? 'sortable' : '' }}" rel="{{ $item->id }}">

					@if($item->photos->count() != 0)

						@foreach($item->photos->sortBy('ordering') as $photo)
							<div class="col-md-3" id="img_<?=$photo->id?>">
								<div class="show-grid-item">
									<div class="item-info">
										<img src="{{ file_exists('storage/items/sm/'.$photo->file_path) && !is_dir('storage/items/sm/'.$photo->file_path) ? asset('storage/items/sm/'.$photo->file_path.'?v='.$photo->version) : asset($noimg) }}" class="img-fluid">
										<div>{{ $photo->name }}</div>
									</div>
									<div class="options">
										<a href="{{ route('item.photo.crop', ['alias' => $store->alias, 'item_id' => $item->id, 'photo_id' => $photo->id]) }}" class="marR5 btn btn-sm btn-primary" title="Recortar foto"><i class="fa fa-crop-alt"></i></a>
										<a href="javascript:;" onclick="confirm_open_link('¿Estás seguro/a de que quieres eliminar esta foto?', '{{ route('item.photo.delete', ['photo_id' => $photo->id]) }}')" class="btn btn-sm btn-outline-danger" title="Eliminar foto"><i class="fa fa-times"></i></a>
									</div>
								</div>
							</div>
						@endforeach

					@else
						
						<div class="col-md-12 marT30 row">
							<div class="col-md-3">
								<div class="show-grid-item padB10">
									<div class="item-info">
										<img src="{{ asset($noimg) }}" class="img-fluid">
									</div>
								</div>
							</div>
						</div>

					@endif

				</div>

				<div class="none">
					<form id="ordering" action="{{ route('item.photo.order') }}" method="Post">
						@csrf
						<input type="hidden" name="neworder" id="neworder">
						<input type="hidden" name="item_id" value="{{ $item->id }}">
					</form>

					<form action="{{ route('item.photo.upload') }}" id="form-uploader" method="post" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="item_id" value="{{ $item->id }}">
						<input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept=".jpg,.jpeg,.png" />
					</form>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection