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
        
        	<div class="card marB20">
                @if(session('message'))
                    <div class="card-header bold a-center text-success">{{ session('message') }}</div>
                @endif
            	<div class="card-body card-body-pad">

                    <div class="card-body-title">
                        <h1>Foto de perfil</h1>
                        <hr>
                    </div>

                    <div class="form-group row justify-content-center">

                        <div class="col-10 a-center">
                            
                            <img src="{{ asset($img) }}" class="img-fluid rounded-circle marB10" />
                            <button type="button" id="photo-upload" class="btn btn-outline-secondary btn-sm marT10 marR5">{{ isset($noimg) ? 'Subir' : 'Cambiar' }} foto</button>
                            @if(!isset($noimg))
                                <a href="{{ route('user.photo.crop') }}" class="btn btn-outline-secondary btn-sm marT10"><i class="fa fa-crop"></i> Recortar foto</a>
                            @endif

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
        <input type="hidden" name="vmovil" value="1">
        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept=".jpg,.jpeg,.png" />
    </form>
</div>

@endsection