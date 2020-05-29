@extends('user.in')

@section('section.admin', 'Info general')

@section('admin')

<div class="row justify-content-center">
    <div class="col-md-12 mainbar">
        <form method="POST" action="{{ route('user.update') }}">
        
        	<div class="card marB20">
                @if(session('message'))
                    <div class="card-header bold a-center text-success">{{ session('message') }}</div>
                @endif
            	<div class="card-body pad30">

                    <div class="f17 marB30">
                        <h1 class="f30 marB15">Información personal</h1>
                        <hr>
                    </div>

                    @csrf

                    <div class="form-group row form-row">
                        <label for="name" class="col-md-3 col-form-label">{{ __('Nombres') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->profile->name ? $user->profile->name : old('name') }}" required autocomplete="off">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="alias" class="col-md-3 col-form-label">{{ __('Apellidos') }}</label>

                        <div class="col-md-6 input-group">
							<input type="text" id="lastname" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user->profile->lastname ? $user->profile->lastname : old('lastname') }}" required autocomplete="off">

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="birthday" class="col-md-3 col-form-label">{{ __('Fecha de nacimiento') }}</label>

                        <div class="col-md-6 input-group">
							<input type="date" id="birthday" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ $user->profile->birthday ? $user->profile->birthday : old('birthday') }}" autocomplete="off">

                            @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="gender" class="col-md-3 col-form-label">{{ __('Sexo') }}</label>

                        <div class="col-md-6 input-group">
                            
                            <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender">
                                <option value="Masculino"{{ $user->profile->gender == 'Masculino' ? ' selected' : '' }}>Masculino</option>
                                <option value="Femenino"{{ $user->profile->gender =='Femenino' ? ' selected' : '' }}>Femenino</option>
                            </select>

                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row form-row">
                        <label for="dni" class="col-md-3 col-form-label">{{ __('DNI Nº') }}</label>

                        <div class="col-md-6">

                            <input type="number" id="dni" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ $user->profile->dni ? $user->profile->dni : '' }}" autocomplete="off">
                            <span class="f13 text-muted i">(*) Requerido para realizar compras o ventas.</span>

                            @error('dni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row form-row-btn">
                        <div class="col-md-6 offset-md-3 padL5">
                            <button type="submit" rel="submit" class="btn btn-primary">
                                {{ __('Guardar cambios') }}
                            </button>
                            <a href="{{ route('user.home') }}" class="btn btn-link marL5">Cancelar</a>
                        </div>
                    </div>

				</div>
			</div>

        </form>
    </div>
</div>

@endsection