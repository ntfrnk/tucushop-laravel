@extends('store.in')

@section('section.admin', 'Info general')

@section('admin')

<div class="row justify-content-center">
    <div class="col-md-12 mainbar">
        <form method="POST" action="{{ route('store.update') }}">
            @csrf

            <input type="hidden" name="store_id" value="{{ $store->id }}">
        
        	<div class="card marB20">
                @if(session('message'))
                    <div class="card-header bold a-center text-success">{{ session('message') }}</div>
                @endif
            	<div class="card-body pad30">

                    <div class="f17 marB30">
                        <h1 class="f30 marB15">Información general</h1>
                        <hr>
                    </div>

                    <div class="form-group row form-row">
                        <label for="name" class="col-md-3 col-form-label">{{ __('Nombre') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : $store->name }}" required autocomplete="name">
                            <span class="invalid-feedback name b">@error('name'){{ $message }}@enderror</span>
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="type_id" class="col-md-3 col-form-label">{{ __('Actividad') }}</label>
                        <div class="col-md-6">
                            <select id="type_id" name="type_id" type="text" class="form-control @error('type_id') is-invalid @enderror" required>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}"{{ $type->id == $store->type_id ? ' selected' : '' }}>{{ $type->type }}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback type_id b">@error('type_id'){{ $message }}@enderror</span>
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="description" class="col-md-3 col-form-label">{{ __('Descripción') }}</label>
                        <div class="col-md-6">
                            <textarea id="description" rows="3" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="off">{{ old('description') ? old('description') : $store->description }}</textarea>
                            <span class="invalid-feedback description b">@error('description'){{ $message }}@enderror</span>
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="alias" class="col-md-3 col-form-label">{{ __('Dirección web') }}</label>
                        <div class="col-md-6 input-group">
							<div class="input-group-prepend">
								<span class="input-group-text fw500">https://tucushop.com/</span>
							</div>
							<input type="text" id="alias" class="form-control @error('alias') is-invalid @enderror" name="alias" value="{{ old('alias') ? old('alias') : $store->alias }}" required autocomplete="alias">
                            <span class="invalid-feedback alias b">@error('alias') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="form-group row form-row-btn">
                        <div class="col-md-6 offset-md-3 padL5">
                            <button type="submit" rel="submit" class="btn btn-primary">
                                {{ __('Guardar cambios') }}
                            </button>
                            <a href="{{ route('store.home', ['alias' => $store->alias]) }}" class="btn btn-link marL5">Cancelar</a>
                        </div>
                    </div>

				</div>
			</div>

        </form>
    </div>
</div>

@endsection