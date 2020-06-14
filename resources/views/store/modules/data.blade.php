@extends('store.in')

@section('section.admin', 'Datos de contacto')

@section('admin')

<div class="row justify-content-center">
    <div class="col-md-12 mainbar">
        <form method="POST" action="{{ route('store.update.data') }}">
        
            @csrf

            <input type="hidden" name="store_id" value="{{ $store->id }}">

			<div class="card">
                
                @if(session('message'))
                    <div class="card-header bold a-center text-success">{{ session('message') }}</div>
                @endif

                <div class="card-body card-body-pad">

                    <div class="card-body-title">
                        <h1>Datos de contacto</h1>
                        <hr>
                    </div>

                    <div class="form-group row form-row">
                        <label for="email" class="col-md-3 col-form-label">{{ __('Correo electrónico') }}</label>
                        <div class="col-md-6 input-group">
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ? old('email') : $store->profile->email }}" autocomplete="off">
                            <span class="invalid-feedback email b">@error('email') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="website" class="col-md-3 col-form-label">{{ __('Sitio Web') }}</label>
                        <div class="col-md-6 input-group">
                        	<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon3">http://</span>
							</div>
                            <input type="text" id="website" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') ? old('website') : $store->profile->website }}" autocomplete="website">
                            <span class="invalid-feedback website b">@error('website') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="phone" class="col-md-3 col-form-label">{{ __('Teléfono fijo') }}</label>
                        <div class="col-md-6 input-group">
                            <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ? old('phone') : $store->profile->phone }}" autocomplete="phone">
                            <span class="invalid-feedback phone b">@error('phone') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="cellphone" class="col-md-3 col-form-label">{{ __('Celular') }}</label>
                        <div class="col-md-6 input-group">
                            <input type="text" id="cellphone" class="form-control @error('cellphone') is-invalid @enderror" name="cellphone" value="{{ old('cellphone') ? old('cellphone') : $store->profile->cellphone }}" autocomplete="cellphone">
                            <span class="invalid-feedback cellphone b">@error('cellphone') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="facebook" class="col-md-3 col-form-label">{{ __('Facebook') }}</label>
                        <div class="col-md-6 input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">facebook.com/</span>
							</div>
                            <input type="text" id="facebook" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ old('facebook') ? old('facebook') : $store->profile->facebook }}" autocomplete="facebook">
                            <span class="invalid-feedback facebook b">@error('facebook') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="instagram" class="col-md-3 col-form-label">{{ __('Instagram') }}</label>
                        <div class="col-md-6 input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">instagram.com/</span>
							</div>
                            <input type="text" id="instagram" class="form-control @error('instagram') is-invalid @enderror" name="instagram" value="{{ old('instagram') ? old('instagram') : $store->profile->instagram }}" autocomplete="instagram">
                            <span class="invalid-feedback instagram b">@error('instagram') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="pinterest" class="col-md-3 col-form-label">{{ __('Pinterest') }}</label>
                        <div class="col-md-6 input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">pinterest.com/</span>
							</div>
                            <input type="text" id="pinterest" class="form-control @error('pinterest') is-invalid @enderror" name="pinterest" value="{{ old('pinterest') ? old('pinterest') : $store->profile->pinterest }}" autocomplete="pinterest">
                            <span class="invalid-feedback pinterest b">@error('pinterest') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="form-group row form-row-btn">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" rel="submit" class="btn btn-primary btn-important">
                                {{ __('Guardar cambios') }}
                            </button>
                            <a href="{{ route('store.home', ['alias' => $store->alias]) }}" class="btn btn-link btn-important">Cancelar</a>
                        </div>
                    </div>
            	</div>
        	</div>

        </form>
    </div>
</div>

@endsection