@extends('store.in')

@section('section.admin', 'Recortar foto')

@section('back.admin')
    <a href="{{ route('item.photos', ['alias' => $store->alias, 'item_id' => $item->id]) }}">Volver a fotos</a>
@endsection

@section('scripts')
	<script src="{{ asset('scripts/tshop.stores.js') }}" defer></script>
	<script src="{{ asset('plugins/croppie/croppie.min.js') }}" defer></script>
	<script src="{{ asset('plugins/croppie/croppie-custom.js') }}" defer></script>
@endsection

@section('styles')
	<link href="{{ asset('plugins/croppie/croppie.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/croppie/croppie-custom.css') }}" rel="stylesheet">
@endsection

@section('admin')

<span id="photo_url" class="none">{{ route('home').'/storage/items/original/'.$photo->file_path }}</span>

<div class="row">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body card-body-min">

				<div class="card-body-title">
				    <h1>Recortar foto</h1>
				    <hr>
				</div>

				<div class="row marT20">

					<div class="col-md-6">
						<div class="crop-container" style="border: solid 1px #CCC; background: #CCC">
		                    <img src="" class="recorte" />
		                </div>
					</div>

					<div class="col-md-6">
						<p class="d-none d-md-block">Mueve con el mouse la foto, para seleccionar el área que deseas mostrar. Para agrandar o achicar el área de recorte puedes girar la rueda del mouse sobre la foto.</p>
						<p class="d-block d-md-none">Mueve la foto para seleccionar el área que deseas recortar. Para agrandar o achicar el área de recorte usa dos dedos.</p>
						<a href="javascript:;" class="show-result btn btn-primary btn-important loading">Recortar foto</a>
						<a href="{{ route('item.photos', ['alias' => $store->alias, 'item_id' => $item->id]) }}" class="btn btn-link btn-important">Cancelar</a>
						<form id="crop-data" action="{{ route('item.photo.cropper') }}" method="post">
							@csrf
							<input type="hidden" name="image" value="storage/items/original/{{ $photo->file_path }}">
							<input type="hidden" name="store_id" value="{{ $store->id }}">
							<input type="hidden" name="item_id" value="{{ $item->id }}">
							<input type="hidden" name="photo_id" value="{{ $photo->id }}">
							<input type="hidden" id="x" name="x">
							<input type="hidden" id="y" name="y">
							<input type="hidden" id="w" name="w">
							<input type="hidden" id="h" name="h">
						</form>
					</div>

				</div>

			</div>
		</div>
	</div>
</div>

@endsection