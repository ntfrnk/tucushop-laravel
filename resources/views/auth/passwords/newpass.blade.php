@extends('layouts.app')

@section('content')
<div class="container container-forms">
    <div class="row justify-content-center">
        <div class="col-md-8 cont-forms">
            <div class="card">
                {{-- <div class="card-header">{{ __('Reset Password') }}</div> --}}

                <div class="card-body card-body-forms">

                    <form method="POST" action="{{ route('user.pass.new') }}">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">&nbsp;</label>

                            <div class="col-md-6">
                                <h3 class="f25 fw600 marT20">Restablece tu contraseña</h3>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nueva contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="off" autofocus>
                                <span class="invalid-feedback password b">@error('password'){{ $message }}@enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Repite la contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="off">
                                <span class="invalid-feedback password_confirmation b">@error('password_confirmation'){{ $message }}@enderror</span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" rel="submit" class="btn btn-primary btn-important">
                                    {{ __('Guardar cambios') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
