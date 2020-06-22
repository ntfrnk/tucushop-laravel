@extends('user.in')

@section('section.admin', 'Info general')

@section('admin')

<div class="row justify-content-center">
    <div class="col-md-12 mainbar">
        <form method="POST" action="{{ route('user.contact.update') }}">
        
        	<div class="card marB20">
                @if(session('message'))
                    <div class="card-header bold a-center text-success">{{ session('message') }}</div>
                @endif
            	<div class="card-body card-body-pad">

                    <div class="card-body-title">
                        <h1>Datos de contacto</h1>
                        <hr>
                    </div>

                    @csrf

                    <div class="form-group row form-row">
                        <label for="phone" class="col-lg-3 col-form-label">{{ __('Celular') }}</label>

                        <div class="col-lg-5">
                            <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->addresses->first()->phone ?? old('phone') }}" autocomplete="off">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="address" class="col-lg-3 col-form-label">{{ __('Dirección') }}</label>

                        <div class="col-lg-5 input-group">
                            <input type="text" id="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $user->addresses->first()->address ?? old('address') }}" autocomplete="off">

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="city" class="col-lg-3 col-form-label">{{ __('Localidad') }}</label>

                        <div class="col-lg-5 input-group">
                            <input type="text" id="city" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $user->addresses->first()->city ?? old('city') }}" autocomplete="off">

                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
					</div>
					
					<div class="form-group row form-row">
                        <label for="cp" class="col-lg-3 col-form-label">{{ __('Código postal') }}</label>

                        <div class="col-lg-5 input-group">
                            <input type="text" id="postalcode" class="form-control @error('postalcode') is-invalid @enderror" name="postalcode" value="{{ $user->addresses->first()->postalcode ?? old('postalcode') }}" autocomplete="off">

                            @error('postalcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
					</div>

                    <div class="form-group row form-row-btn">
                        <div class="col-lg-5 offset-lg-3">
                            <button type="submit" rel="submit" class="btn btn-primary btn-important">
                                {{ __('Guardar cambios') }}
                            </button>
                            <a href="{{ route('user.home') }}" class="btn btn-link btn-important">Cancelar</a>
                        </div>
                    </div>

				</div>
			</div>

        </form>
    </div>
</div>

@endsection