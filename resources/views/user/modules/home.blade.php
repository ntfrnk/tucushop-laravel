@extends('user.in')

@section('section.admin', 'Home')
@section('back.admin')
@endsection

@if($user->profile->photo && !empty($user->profile->photo))
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

<div class="row justify-content-center">
    <div class="col-md-12 mainbar">

		<div class="card marB20">
			@if(session('message'))
				<div class="card-header bold a-center text-success">{{ session('message') }}</div>
			@endif
			<div class="card-body pad30">

				<div class="row d-none d-md-flex">
					<div class="col-md-2">
						<img src="{{ asset($img) }}" class="img-fluid rounded-circle">
					</div>
					<div class="col-md-10">
						<h1 class="marB0 marT10">{{ $user->profile->name . ' ' . $user->profile->lastname }}</h1>
						<p class="f20 marB0"><span class="fw600">{{ '@'.$user->nickname }}</span> | <small>{{ $user->email }}</small></p>
						<hr>
					</div>
				</div>

				<div class="row marT20">

					<div class="col-md-4 box-admin">
						<div class="box-admin-container">
							<div class="card-body">
								<h4 class="f17 fw600">
									<i class="fa fa-key inline-block marR5 text-primary"></i>
									<a href="{{ route('user.account') }}">Datos de la cuenta</a>
								</h4>
								<p class="f14">Gestiona tus datos de acceso y foto de perfil.</p>
								<p class="marB0"><a href="{{ route('user.account') }}" class="btn btn-primary btn-sm">Administrar</a></p>
							</div>
						</div>
					</div>

					<div class="col-md-4 box-admin">
						<div class="box-admin-container">
							<div class="card-body">
								<h4 class="f17 fw600">
									<i class="fa fa-user inline-block marR5 text-primary"></i>
									<a href="{{ route('user.edit') }}">Información personal</a>
								</h4>
								<p class="f14">Tus datos personales para operar en la página.</p>
								<p class="marB0"><a href="{{ route('user.edit') }}" class="btn btn-primary btn-sm">Administrar</a></p>
							</div>
						</div>
					</div>

					<div class="col-md-4 box-admin">
						<div class="box-admin-container">
							<div class="card-body">
								<h4 class="f17 fw600">
									<i class="fa fa-mobile-alt inline-block marR5 text-primary"></i>
									<a href="{{ route('user.contact') }}">Datos de contacto</a>
								</h4>
								<p class="f14">Información para que las demás personas te contacten.</p>
								<p class="marB0"><a href="{{ route('user.contact') }}" class="btn btn-primary btn-sm">Administrar</a></p>
							</div>
						</div>
					</div>

					<div class="col-md-4 box-admin">
						<div class="box-admin-container">
							<div class="card-body">
								<h4 class="f17 fw600">
									<i class="fa fa-heart inline-block marR5 text-primary"></i>
									<a href="{{ route('user.contact') }}">Mis favoritos</a>
								</h4>
								<p class="f14">Revisa los items de la web que te gustaron.</p>
								<p class="marB0"><a href="{{ route('user.contact') }}" class="btn btn-primary btn-sm">Administrar</a></p>
							</div>
						</div>
					</div>

					<div class="col-md-4 box-admin">
						<div class="box-admin-container">
							<div class="card-body">
								<h4 class="f17 fw600">
									<i class="fa fa-envelope inline-block marR5 text-primary"></i>
									<a href="{{ route('user.contact') }}">Centro de mensajes</a>
								</h4>
								<p class="f14">Mensajes que intercambiaste con los vendedores.</p>
								<p class="marB0"><a href="{{ route('user.contact') }}" class="btn btn-primary btn-sm">Administrar</a></p>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>

    </div>
</div>

@endsection