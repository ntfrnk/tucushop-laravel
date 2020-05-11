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
					<div class="mar0 marT5 f14 bold f-right">
						@if($store->shop->status == 0)
							<span class="text-danger">
								<i class="f16 fa fa-times-circle marR5"></i> 
								Tienda deshabilitada
							</span>
						@else
							<span class="text-success">
								<i class="f16 fa fa-check-circle marR5"></i> 
								Tienda habilitada
							</span>
						@endif
					</div>
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
										<span class="mar0 f14 bold">{{ '@'.$store->alias }}</span>
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
						<div class="marT30"><h3 class="f22 marB0">Configuraciones</h3> <hr></div>
					</div>

					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3 padR0">
								<strong>Pestaña principal:</strong>
							</div>
							<div class="col-md-6">
								<select class="form-control">
									<option>Ofertas</option>
									<option>Todos mis items</option>
									<option>Contacto</option>
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
							<div class="col-md-3">
								<select class="form-control">
									<option>Nombre</option>
									<option>Fecha</option>
									<option>Precio</option>
								</select>
							</div>
							<div class="col-md-3">
								<select class="form-control">
									<option>Ascendente</option>
									<option>Descendente</option>
								</select>
							</div>
						</div>
						<hr>
					</div>
					<div class="marT20 col-md-12">
						<div class="f-right align-right">
							<a href="{{ route('store.shop.status', ['alias' => $store->alias]) }}" class="marL10 btn btn-link {{ $store->shop->status == 1 ? 'text-secondary' : 'text-primary' }}"><i class="fa fa-{{ $store->shop->status == 1 ? 'ban' : 'check' }}"></i>&nbsp; {{ $store->shop->status == 1 ? __('Deshabilitar') : __('Habilitar') }} tienda virtual</a>
						</div>
						<button type="submit" id="save-form" class="btn btn-primary">
							<i class="fa fa-save marR5"></i> Guardar cambios
						</button>
						<a href="{{ route('store.home', ['alias' => $store->alias]) }}" class="btn btn-outline-primary marL5">Cancelar</a>
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