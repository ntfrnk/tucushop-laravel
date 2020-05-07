@extends('store.out')

@section('admin')



	<div class="marB20">
		<a href="{{ route('store.list') }}" class="btn btn-light f-right"><i class="fa fa-angle-double-left marR5"></i> Volver al listado de negocios</a>
		<h1>Nuevo negocio</h1>
		<hr>
	</div>

	<div>
		<div class="justify-content-center w100">
			<div class="col-md-12 padLR0">
				<form method="POST" action="{{ route('store.save') }}">
				
					<div class="marB20">
						@if(session('message'))
							<div class="card-header bold a-center text-success">{{ session('message') }}</div>
						@endif
						<div class="pad30">
		
							@csrf
		
							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
		
								<div class="col-md-6">
									<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off">
		
									@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
		
							<div class="form-group row">
								<label for="type_id" class="col-md-4 col-form-label text-md-right">{{ __('Actividad') }}</label>
		
								<div class="col-md-6">
									<select id="type_id" name="type_id" type="text" class="form-control @error('type_id') is-invalid @enderror" required>
										@foreach($types as $type)
											<option value="{{ $type->id }}">{{ $type->type }}</option>
										@endforeach
									</select>
		
									@error('type_id')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
		
							<div class="form-group row">
								<label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
		
								<div class="col-md-6">
									<textarea id="description" rows="3" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="off">{{ old('description') }}</textarea>
		
									@error('description')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
		
							<div class="form-group row">
								<label for="alias" class="col-md-4 col-form-label text-md-right">{{ __('Alias o Nickname') }}</label>
		
								<div class="col-md-6 input-group">
									<div class="input-group-prepend">
										<span class="input-group-text bold">@</span>
									</div>
									<input type="text" id="alias" class="form-control @error('alias') is-invalid @enderror" name="alias" value="{{ old('alias') }}" required autocomplete="off">
		
									@error('alias')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
		
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										{{ __('Guardar cambios') }}
									</button>
									<a href="{{ route('store.list') }}" class="btn btn-outline-primary marL5">Cancelar</a>
								</div>
							</div>
		
						</div>
					</div>
		
				</form>
			</div>
		</div>
	</div>

@endsection