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

{{-- Imagenes --}}

@if($user->profile->photo)
	@php($img = 'storage/users/resized/'.$user->profile->photo)
@endif

@php($noimg = 'storage/users/resized/no-logo.jpg')

@section('admin')

<span id="photo_url" class="none">storage/users/original/{{ $user->profile->photo }}</span>

<div class="row">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body padT30 padB30 padLR30">

				<div class="f17">
					<h1 class="f30 marB15">Recortar foto de perfil</h1>
					<hr>
				</div>

				<div class="row">

					<div class="col-md-6">
						<div class="crop-container" style="border: solid 1px #CCC; background: #CCC">
		                    <img src="" class="recorte" />
		                </div>
					</div>

					<div class="col-md-6 marT20">
						<p class="d-none d-md-block">Mueve con el mouse la foto, para seleccionar el área que deseas mostrar. Para agrandar o achicar el área de recorte puedes girar la rueda del mouse sobre la foto, o deslizar el control que está debajo de la foto.</p>
						<p class="d-block d-md-none">Mueve la foto para seleccionar el área que deseas recortar. Para agrandar o achicar el área de recorte usa dos dedos.</p>
						<a href="javascript:;" class="show-result-profile btn btn-primary spn" spn-text="Recortando la imagen...">Recortar foto</a>
						<form id="crop-data-profile" action="{{ route('user.photo.cropper') }}" method="post">
							@csrf
							<input type="hidden" name="image" id="image" value="storage/users/original/{{ $user->profile->photo }}">
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