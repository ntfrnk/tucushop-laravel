@extends('layouts.app')

@section('content')
<div class="container container-forms">
    <div class="row justify-content-center">
        <div class="col-md-8 cont-forms">
            <div class="card">
                {{-- <div class="card-header">{{ __('Reset Password') }}</div> --}}

                <div class="card-body card-body-forms">

                    <form method="POST" action="{{ route('user.pass.validate') }}">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">&nbsp;</label>

                            <div class="col-md-6">
                                <h3 class="f25 fw600 marT20">Valida tu cuenta</h3>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Código de validación') }}</label>

                            <div class="col-md-6">
                                <input id="code" type="number" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" autocomplete="off" autofocus>
                                <span class="invalid-feedback code b">@error('code'){{ $message }}@enderror</span>
                                <span class="text-muted f13 lh16 block marT10">Ingresa aquí el código de validación (seis dígitos) que te enviamos a tu cuenta de correo.</span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" rel="submit" class="btn btn-primary btn-important">
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
