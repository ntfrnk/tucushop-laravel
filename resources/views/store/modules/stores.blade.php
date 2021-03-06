@extends('store.out')

@section('section.admin', 'Home')
@section('back.admin')
@endsection

@php($noimg = 'storage/logos/resized/no-logo.jpg')

@section('admin')

<section>

	<div class="row">

		<div class="col-md-12 d-none d-md-block">
			<div class="carousel-heading row marT10 marB30">
				<div class="col-md-2 carousel-icon">
					<i class="fa fa-tag" aria-hidden="true"></i>
				</div>
				<div class="col-md-7 carousel-title">
					<h3>Negocios que administras</h3>
					<p>Desde aquí puedes acceder a la administración de tus negocios.</p>
				</div>
				<div class="col-md-3 padT20 padR0">
					<a href="{{ route('store.new') }}" class="btn btn-primary f-right"><i class="fa fa-plus marR5"></i> Crear un nuevo negocio</a>
				</div>
			</div>
		</div>

		<a href="{{ route('store.new') }}" class="btn-new"><i class="fa fa-plus"></i></a>

		<div class="d-block d-md-none col-12 card-body-pad card-body-pad-1">
			<div class="card-body-title">
				<h1>Mis negocios</h1>
				<hr>
			</div>
		</div>

		@if($stores->count() != 0)

			@foreach($stores as $store)

				@php($img = 'storage/logos/resized/'.$store->shop->image_profile)

				<div class="col-6 col-md-4 box-admin">
					<div class="box-admin-container">
						<div class="card-body clearfix">
							<div class="row stores-logo">
								<div class="col-md-4 offset-md-4">
									<a href="{{ route('store.home', ['alias' => $store->alias]) }}">
										<img src="{{ file_exists($img) && !is_dir($img) ? asset($img) : asset($noimg) }}" class="img-fluid rounded-circle">
									</a>
								</div>
							</div>
							<div class="align-center stores-info">
								<h3 class="mar0"><a href="{{ route('store.home', ['alias' => $store->alias]) }}">{{ $store->name }}</a></h3>
								<p class="marT10 marB0 f13 bold {{ $store->status == 1 ? 'text-primary' : 'text-danger' }} d-none d-md-block">
									<a href="{{ route('store.home', ['alias' => $store->alias]) }}" class="btn btn-secondary btn-sm">Administrar negocio</a>
								</p>
							</div>
						</div>
					</div>
				</div>

				@php($img=null)

			@endforeach

		@else
			<div class="col-md-12 marB70">
				<div class="padTB100 em f20 fw500 a-center">
					Aún no estás administrando un negocio.<br>
					<a href="{{ route('store.new') }}" class="f18 fw500">¿Quieres crearlo ahora?</a>
				</div>
			</div>
		@endif

	</div>

</section>

@endsection