@extends('store.index')

@section('section.admin', 'Info general')

@section('admin')

<div class="row justify-content-center">
    <div class="col-md-12 mainbar">
        <form method="POST" action="{{ route('register') }}">
        
        	<div class="card marB20">
            	<div class="card-body padTB50">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $store->name ? $store->name : '' }}" required autocomplete="name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Actividad') }}</label>

                        <div class="col-md-6">
                            <select id="type" type="text" class="form-control @error('type') is-invalid @enderror" required>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}"{{ $type->id == $store->type_id ? ' selected' : '' }}>{{ $type->type }}</option>
                                @endforeach
                            </select>

                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                        <div class="col-md-6">
                            <textarea id="description" rows="3" class="form-control @error('description') is-invalid @enderror" description="description" autocomplete="off">{{ $store->description ? $store->description : '' }}</textarea>

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
							<input type="text" id="alias" class="form-control @error('alias') is-invalid @enderror" name="alias" value="{{ $store->alias ? $store->alias : '' }}" required autocomplete="alias">

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
                        </div>
                    </div>

				</div>
			</div>

        </form>
    </div>
</div>

@endsection