@extends('layouts.app')

@section('content')
<div class="container container-forms">
    <div class="row justify-content-center">
        <div class="col-md-8 cont-forms">
            <div class="card">
                {{-- <div class="card-header">{{ __('Reset Password') }}</div> --}}

                <div class="card-body card-body-forms">

                    <form method="POST" action="{{ route('user.pass.recover') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">&nbsp;</label>

                            <div class="col-md-6">
                                <h3 class="f25 fw600 marT20">Recuperar contraseña</h3>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off" autofocus>
                                <span class="invalid-feedback email b">@error('email'){{ $message }}@enderror</span>
                                <span class="text-muted f13 lh16 block marT10">Te enviaremos un código único a tu casilla de correo para que puedas recuperar el acceso a tu cuenta.</span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-important">
                                    {{ __('Enviar código') }}
                                </button>
                                <a href="{{ route('login') }}" class="btn btn-link btn-important">
                                    {{ __('Cancelar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
