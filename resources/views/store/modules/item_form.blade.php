@extends('store.index')

@section('section.admin', isset($item) ? 'Editar item' : 'Nuevo item')

@section('admin')

<div class="row justify-content-center">
    <div class="col-md-12 mainbar">
        <form method="POST" action="{{ isset($item) ? route('store.item.update') : route('store.item.update') }}">
        
        	<div class="card marB20">
            	<div class="card-body padTB50">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($item) ? $item->name : '' }}" required autocomplete="name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="detail" class="col-md-4 col-form-label text-md-right">{{ __('Detalle') }}</label>

                        <div class="col-md-6">
                            <textarea id="detail" rows="3" class="form-control @error('detail') is-invalid @enderror" detail="detail" autocomplete="off">{{ isset($item) ? $item->detail : '' }}</textarea>

                            @error('detail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alias" class="col-md-4 col-form-label text-md-right">{{ __('Precio') }}</label>

                        <div class="col-md-6 input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bold">$</span>
							</div>
							<input type="text" id="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ isset($item) ? $item->price : '' }}" required autocomplete="price">

                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($item) ? 'Guardar cambios' : 'Guardar nuevo item' }}
                            </button>
                        </div>
                    </div>

				</div>
			</div>

        </form>
    </div>
</div>

@endsection