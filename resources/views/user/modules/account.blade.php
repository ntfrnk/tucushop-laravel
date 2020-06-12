@extends('user.in')

@section('section.admin', 'Info general')

@if(isset($user->profile->photo) && !empty($user->profile->photo))
    @php($image_file = public_path().'/storage/users/resized/'.$user->profile->photo)
    @if(file_exists($image_file) && !is_dir($image_file))
        @php($img = route('home').'/storage/users/resized/'.$user->profile->photo.'?v='.$user->profile->version_photo)
    @else
        @php($noimg = 1)
        @php($img = route('home').'/storage/users/resized/no-photo.jpg')
    @endif
@else
    @php($noimg = 1)
    @php($img = route('home').'/storage/users/resized/no-photo.jpg')
@endif

@section('admin')

<div class="row">
    <div class="col-md-12 mainbar">
        <form method="POST" action="{{ route('user.account.update') }}">
        
        	<div class="card marB20">
                @if(session('message'))
                    <div class="card-header bold a-center text-success">{{ session('message') }}</div>
                @endif
            	<div class="card-body card-body-pad">

                    <div class="card-body-title">
                        <h1>Datos de la cuenta</h1>
                        <hr>
                    </div>

                    @csrf

                    <div class="row">

                        <div class="col-md-8">

                            <div class="form-group row form-row">
                                <label for="email" class="col-md-4 col-form-label">{{ __('Correo electrónico') }}</label>
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ? $user->email : '' }}" required autocomplete="off">
                                    <span class="invalid-feedback email b">@error('email'){{ $message }}@enderror</span>                                    
                                </div>
                            </div>

                            <div class="form-group row form-row">
                                <label for="nickname" class="col-md-4 col-form-label">{{ __('Nombre de usuario') }}</label>
                                <div class="col-md-8 input-group">
                                    <input type="text" id="nickname" class="form-control @error('nickname') is-invalid @enderror" name="nickname" value="{{ $user->nickname ? $user->nickname : '' }}" required autocomplete="off">
                                    <span class="invalid-feedback nickname b">@error('nickname'){{ $message }}@enderror</span>
                                </div>
                            </div>

                            <div class="form-group row form-row">
                                <label for="password" class="col-md-4 col-form-label">{{ __('Cambiar contraseña') }}</label>
                                <div class="col-md-8">
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off">
                                    <span class="invalid-feedback password b">@error('password'){{ $message }}@enderror</span>
                                    <span class="f13 text-muted i">(*) Rellenar sólo si deseas cambiar de contraseña.</span>
                                </div>
                            </div>

                            <div class="form-group row form-row-btn">
                                <div class="col-md-8 offset-md-4 padL5">
                                    <button type="submit" rel="submit" class="btn btn-primary">
                                        {{ __('Guardar cambios') }}
                                    </button>
                                    <a href="{{ route('user.home') }}" class="btn btn-link marL5">Cancelar</a>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group row">

                                <div class="col-md-10 padL60 a-center">
                                    
                                    <img src="{{ asset($img) }}" class="img-fluid" />
                                    <button type="button" id="photo-upload" class="btn btn-outline-secondary btn-sm marT10">{{ isset($noimg) ? 'Subir' : 'Cambiar' }} foto</button>
                                    @if(!isset($noimg))
                                        <a href="{{ route('user.photo.crop') }}" class="btn btn-outline-secondary btn-sm marT10"><i class="fa fa-crop"></i> Recortar foto</a>
                                    @endif

                                </div>
                            </div>

                        </div>

            	    </div>

				</div>
			</div>

        </form>
    </div>
</div>

<div class="none">
    <form action="{{ route('user.photo.upload') }}" id="form-uploader" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept=".jpg,.jpeg,.png" />
    </form>
</div>

@endsection