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
            	<div class="card-body pad30">

                    <div class="f17 marB30">
                        <h1 class="f30 marB15">Datos de contacto</h1>
                        <hr>
                    </div>

                    @csrf

                    <div class="form-group row form-row">
                        <label for="phone" class="col-md-3 col-form-label">{{ __('Celular') }}</label>

                        <div class="col-md-5">
                            <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->addresses->first()->phone ?? $user->addresses->first()->phone }}" autocomplete="off">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="address" class="col-md-3 col-form-label">{{ __('Dirección') }}</label>

                        <div class="col-md-5 input-group">
                            <input type="text" id="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $user->addresses->first()->address ?? $user->addresses->first()->address }}" autocomplete="off">

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="city" class="col-md-3 col-form-label">{{ __('Localidad') }}</label>

                        <div class="col-md-5 input-group">
                            <input type="text" id="city" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $user->addresses->first()->city ?? $user->addresses->first()->city }}" autocomplete="off">

                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
					</div>
					
					<div class="form-group row form-row">
                        <label for="cp" class="col-md-3 col-form-label">{{ __('Código postal') }}</label>

                        <div class="col-md-5 input-group">
                            <input type="text" id="postalcode" class="form-control @error('postalcode') is-invalid @enderror" name="postalcode" value="{{ $user->addresses->first()->postalcode ?? $user->addresses->first()->postalcode }}" autocomplete="off">

                            @error('postalcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
					</div>

                    <div class="form-group row form-row-btn">
                        <div class="col-md-5 offset-md-3 padL5">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Guardar cambios') }}
                            </button>
                            <a href="{{ route('user.home') }}" class="btn btn-outline-primary marL5">Cancelar</a>
                        </div>
                    </div>

				</div>
			</div>

        </form>
    </div>
</div>

@endsection