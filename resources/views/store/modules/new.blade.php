@extends('store.out')

@section('admin')

<section>

	<div class="row">

		<div class="col-md-12">
			<div class="carousel-heading row marT10">
				<div class="col-md-2 carousel-icon">
					<i class="fa fa-tag" aria-hidden="true"></i>
				</div>
				<div class="col-md-7 carousel-title">
					<h3>Creando un nuevo negocio</h3>
					<p class="">Crea y administra tu negocio para vender tus productos y servicios.</p>
				</div>
				<div class="col-md-3 padT20 padR0">
					<a href="{{ route('store.list') }}" class="btn btn-light f-right"><i class="fa fa-angle-double-left marR5"></i> Volver al listado de negocios</a>
				</div>
			</div>
		</div>

	</div>

	<div>
		<div class="justify-content-center w100">
			<div class="col-md-12 padLR0">
				<form method="POST" action="{{ route('store.save') }}">
				
					<div class="marB20">
						@if(session('message'))
							<div class="card-header bold a-center text-success">{{ session('message') }}</div>
						@endif
						<div class="padT50 pad30">
		
							@csrf
		
							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre del negocio') }}</label>
		
								<div class="col-md-6">
									<input id="name" type="text" minlength="6" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off">
									<span class="invalid-feedback name b">@error('name') {{$message}} @enderror</span>
								</div>
							</div>
		
							<div class="form-group row">
								<label for="type_id" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de actividad') }}</label>
		
								<div class="col-md-6">
									<select id="type_id" name="type_id" type="text" class="form-control @error('type_id') is-invalid @enderror" required>
										@foreach($types as $type)
											<option value="{{ $type->id }}">{{ $type->type }}</option>
										@endforeach
									</select>
									<span class="invalid-feedback type_id b">@error('type_id') {{$message}} @enderror</span>
								</div>
							</div>
		
							<div class="form-group row">
								<label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Breve descripción') }}</label>
		
								<div class="col-md-6">
									<textarea id="description" rows="3" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="off" required>{{ old('description') }}</textarea>
									<span class="invalid-feedback description b">@error('description') {{$message}} @enderror</span>
								</div>
							</div>
		
							<div class="form-group row">
								<label for="alias" class="col-md-4 col-form-label text-md-right">{{ __('Dirección web') }}</label>
		
								<div class="col-md-6 input-group">
									<div class="input-group-prepend">
										<span class="input-group-text bold">https://tucushop.com/</span>
									</div>
									<input type="text" id="alias" class="form-control @error('alias') is-invalid @enderror" name="alias" value="{{ old('alias') }}" required autocomplete="off">
									<span class="invalid-feedback alias b">@error('alias') {{str_replace('El alias ya está en uso.', 'Esta dirección ya está siendo usada por otro negocio.', $message)}} @enderror</span>
								</div>
							</div>
		
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" rel="submit" class="btn btn-primary">
										{{ __('Crear negocio') }}
									</button>
									<a href="{{ route('store.list') }}" class="btn btn-link marL5">Cancelar</a>
								</div>
							</div>
		
						</div>
					</div>
		
				</form>
			</div>
		</div>
	</div>

</section>

@endsection