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
			<div class="card-body card-body-pad">

				<div class="row d-none d-lg-block">
					<div class="col-md-12">
						<div class="relative">
							<img src="{{ isset($img) && file_exists($img) && !is_dir($img) ? asset($img.'?v='.$store->shop->version_header) : asset($noimg) }}" class="img-fluid">
							<div class="absolute t0 l0 w100 h100 bg-header" style="background: rgba(0,0,0,0.{{ $store->shop->opacity_header != 0 ? \UrlFormat::add_zeros($store->shop->opacity_header, 2) : 0 }})" title="Desliza el control para aclarar / oscurecer."></div>
							
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
								<strong title="Desliza el control para aclarar / oscurecer.">Oscurecer la imagen:</strong>
							</div>
							<div class="col-md-8">
								<input type="range" min="0" max="99" class="darkness opacity-range" value="{{ $store->shop->opacity_header != 0 ? $store->shop->opacity_header : 0 }}">
							</div>
							<div class="col-md-1 padL0">
								<input type="text" class="form-control a-center opacity-input" min="0" max="99" value="{{ $store->shop->opacity_header != 0 ? $store->shop->opacity_header : 0 }}" readonly>
							</div>
						</div>
						<hr>
                    </div>
                    
					<div class="col-md-12">
						<div class="row">
							<div class="input-group col-lg-6 padR0">
								<button type="button" id="image-profile-upload" class="btn btn-primary marR5">Cambiar foto de perfil</button>
								<a href="{{ route('store.profile.crop', ['alias' => $store->alias]) }}" class="btn btn-secondary">Volver a recortar</a>
							</div>
							<div class="input-group col-lg-6">
								<button type="button" id="image-header-upload" class="btn btn-primary marR5">Cambiar foto de cabecera</button>
								<a href="{{ route('store.header.crop', ['alias' => $store->alias]) }}" class="btn btn-secondary">Volver a recortar</a>
							</div>
						</div>
						<hr>
                    </div>
                    
				</div>



				<div class="row d-block d-lg-none">
					<div class="col-md-12">
						<div class="relative">
							<img src="{{ isset($img) && file_exists($img) && !is_dir($img) ? asset($img.'?v='.$store->shop->version_header) : asset($noimg) }}" class="img-fluid">
							<div class="absolute t0 l0 w100 h100 bg-header-movil" style="background: rgba(0,0,0,0.{{ $store->shop->opacity_header != 0 ? \UrlFormat::add_zeros($store->shop->opacity_header, 2) : 0 }})" title="Desliza el control para aclarar / oscurecer."></div>
						</div>
                    </div>
                    
					<div class="marT20 col-md-12">
						<div class="row justify-content-center">
							<div class="col-md-3 padR0">
								<strong title="Desliza el control para aclarar / oscurecer.">Oscurecer la imagen de cabecera:</strong>
							</div>
							<div class="col-md-8 marT10">
								<input type="range" min="0" max="99" class="darkness opacity-range-movil" value="{{ $store->shop->opacity_header != 0 ? $store->shop->opacity_header : 0 }}">
							</div>
						</div>
                    </div>
                    
					<div class="marT15 marB30 col-lg-12">
						<div class="row a-center justify-content-center">
							<div class="marAuto">
								<button type="button" id="image-header-upload-movil" class="btn btn-primary btn-important">Cambiar foto de cabecera</button>
								<a href="{{ route('store.header.crop', ['alias' => $store->alias]) }}" class="btn btn-secondary btn-important marR0">Volver a recortar</a>
							</div>
						</div>
						<hr>
					</div>
					
					<div class="col-md-12">

						<div class="row justify-content-center">
							<div class="a-center marAuto col-md-5">
								<img src="{{ isset($logo) && file_exists($logo) && !is_dir($logo) ? asset($logo.'?v='.$store->shop->version_profile) : asset($nologo) }}" class="img-fluid" style="border: solid 1px #CCC;">
							</div>
						</div>

					</div>

					<div class="col-md-12 marT20">
						<div class="row a-center justify-content-center">
							<div class="marAuto">
								<button type="button" id="image-profile-upload-movil" class="btn btn-primary btn-important">Cambiar foto de perfil</button>
								<a href="{{ route('store.profile.crop', ['alias' => $store->alias]) }}" class="btn btn-secondary btn-important marR0">Volver a recortar</a>
							</div>
						</div>
						<hr>
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