@extends('user.in')

@section('scripts')
	<script src="{{ asset('scripts/tshop.stores.js') }}" defer></script>
	<script src="{{ asset('plugins/croppie/croppie.min.js') }}" defer></script>
	<script src="{{ asset('plugins/croppie/croppie-profile.js') }}" defer></script>
@endsection

@section('styles')
	<link href="{{ asset('plugins/croppie/croppie.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/croppie/croppie-custom.css') }}" rel="stylesheet">
@endsection

@section('admin')

<span id="photo_url" class="none">{{ route('home').'/storage/users/original/'.$user->profile->photo.'?v='.$user->profile->version_photo }}</span>

<div class="row">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body card-body-pad">

				<div class="card-body-title">
					<h1>Recortar foto de perfil</h1>
					<hr>
				</div>

				<div class="row">

					<div class="col-md-6 relative">
						<div class="crop-container" style="border: solid 1px #CCC; background: #CCC">
		                    <img src="" class="recorte" id="recorte" />
						</div>
						<div class="row padLR15" role="group">
							<button class="photo-rotate no-br btn btn-sm btn-outline-secondary col-6" data-deg="resta">Girar a la izquierda</button>
							<button class="photo-rotate no-br btn btn-sm btn-outline-secondary col-6" data-deg="suma">Girar a la derecha</button>
						</div>
					</div>

					<div class="col-md-6 marT20">
						<p class="d-none d-md-block">Mueve con el mouse la foto, para seleccionar el área que deseas mostrar. Para agrandar o achicar el área de recorte puedes girar la rueda del mouse sobre la foto, o deslizar el control que está debajo de la foto.</p>
						<p class="d-block d-md-none">Mueve la foto para seleccionar el área que deseas recortar. Para agrandar o achicar el área de recorte usa dos dedos.</p>
						<a href="javascript:;" class="show-result-profile btn btn-primary loading">Recortar foto</a>
						<form id="crop-data-profile" action="{{ route('user.photo.cropper') }}" method="post">
							@csrf
							<input type="hidden" name="image" id="image" value="storage/users/original/{{ $user->profile->photo }}">
							@if($vmovil == 1)
							<input type="hidden" name="vmovil" value="1">
							@endif
							<input type="hidden" id="x" name="x">
							<input type="hidden" id="y" name="y">
							<input type="hidden" id="w" name="w">
							<input type="hidden" id="h" name="h">
							<input type="hidden" id="imgrotate" name="rotate" value="1">
						</form>
					</div>

				</div>

			</div>
		</div>
	</div>
</div>

@endsection