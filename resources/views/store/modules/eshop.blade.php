@extends('store.in')

@section('section.admin', $store->status == 1 ? 'Desactivar negocio' : 'Reactivar negocio')

{{-- Imagenes --}}

@if($store->shop->image_header)
	@php($img = 'storage/stores/resized/'.$store->shop->image_header)
@endif

@php($noimg = 'storage/stores/resized/no-header.jpg')

@if($store->shop->image_profile)
	@php($logo = 'storage/logos/resized/'.$store->shop->image_profile)
@endif

@php($nologo = 'storage/logos/resized/no-logo.jpg')

@section('admin')

<span class="none" id="store_id">{{ $store->id }}</span>

<div class="row">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body padT30 padB30 padLR30">

				<div class="f17">
					<h1 class="f30 marB15">Mi tienda virtual</h1>
					<hr>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="relative">
							<img src="{{ isset($img) && file_exists($img) && !is_dir($img) ? asset($img.'?v='.$store->shop->version_header) : asset($noimg) }}" class="img-fluid">
							<div class="absolute t0 l0 w100 h100" id="bg-header" style="background: rgba(0,0,0,0.{{ $store->shop->opacity_header != 0 ? \UrlFormat::add_zeros($store->shop->opacity_header, 2) : 0 }})" title="Desliza el control para aclarar / oscurecer."></div>
							
							<div class="row absolute l0 t40 w100">
								<div class="w50 marAuto pad15" style="background: rgba(255, 255, 255, 0.85); border-radius: 4px;">
									<div class="w25 f-left">
										<img src="{{ isset($logo) && file_exists($logo) && !is_dir($logo) ? asset($logo.'?v='.$store->shop->version_profile) : asset($nologo) }}" class="img-fluid">
									</div>
									<div class="w75 f-right padL20 padT10">
										<h3 class="mar0 f22">{{ $store->name }}</h3>
										<p class="mar0 f14 bold">{{ '@'.$store->alias }}</p>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="marT20 col-md-12">
						<div class="row">
							<div class="col-md-3 padR0">
								<strong title="Desliza el control para aclarar / oscurecer.">Opacidad de la imagen:</strong>
							</div>
							<div class="col-md-8">
								<input type="range" min="0" max="99" class="form-control" id="opacity-range" value="{{ $store->shop->opacity_header != 0 ? $store->shop->opacity_header : 0 }}">
							</div>
							<div class="col-md-1 padL0">
								<input type="text" class="form-control a-center" id="opacity-input" min="0" max="99" value="{{ $store->shop->opacity_header != 0 ? $store->shop->opacity_header : 0 }}" readonly>
							</div>
						</div>
						<hr>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="input-group col-md-6 padR0">
								<button type="button" id="image-profile-upload" class="btn btn-primary marR5">Cambiar foto de perfil</button>
								<a href="{{ route('store.profile.crop', ['alias' => $store->alias]) }}" class="btn btn-secondary">Volver a recortar</a>
							</div>
							<div class="input-group col-md-6">
								<button type="button" id="image-header-upload" class="btn btn-primary marR5">Cambiar foto de cabecera</button>
								<a href="{{ route('store.header.crop', ['alias' => $store->alias]) }}" class="btn btn-secondary">Volver a recortar</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3 padR0">
								<strong>Pestaña principal:</strong>
							</div>
							<div class="col-md-5">
								<select class="form-control">
									<option>Mis ofertas</option>
									<option>Todos los productos</option>
									<option>Quienes somos</option>
									<option>Horarios de atención</option>
									<option>Info de contacto</option>
								</select>
							</div>
						</div>
						<hr>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3 padR0">
								<strong>Orden de productos:</strong>
							</div>
							<div class="col-md-5">
								<select class="form-control">
									<option>Nombre (Creciente)</option>
									<option>Nombre (Decreciente)</option>
									<option>Fecha (Creciente)</option>
									<option>Fecha (Decreciente)</option>
									<option>Precio (Creciente)</option>
									<option>Precio (Decreciente)</option>
								</select>
							</div>
						</div>
						<hr>
					</div>
					<div class="marT20 col-md-12">
						<div class="f-right align-right">
							<a href="" class="marL10 btn btn-link {{ $store->shop->status == 1 ? 'text-secondary' : 'text-primary' }}"><i class="fa fa-{{ $store->shop->status == 1 ? 'ban' : 'check' }}"></i>&nbsp; {{ $store->shop->status == 1 ? __('Deshabilitar') : __('Habilitar') }} tienda virtual</a>
						</div>
						<button type="submit" id="save-form" class="btn btn-primary">
							<i class="fa fa-save marR5"></i> Guardar cambios
						</button>
						<a href="{{ route('items', ['alias' => $store->alias]) }}" class="btn btn-outline-primary marL5">Cancelar</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<form action="{{ route('store.profile.upload') }}" id="form-image-profile" method="POST" enctype="multipart/form-data">
	@csrf
	<span class="none">
		<input type="file" name="profile" id="image-profile" accept=".jpg,.jpeg,.png">
		<input type="text" name="store_id" value="{{ $store->id }}">
	</span>
</form>

<form action="{{ route('store.header.upload') }}" id="form-image-header" method="POST" enctype="multipart/form-data">
	@csrf
	<span class="none">
		<input type="file" name="header" id="image-header" accept=".jpg,.jpeg,.png">
		<input type="text" name="store_id" value="{{ $store->id }}">
	</span>
</form>

@endsection