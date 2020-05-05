@extends('store.list')

@section('section.admin', 'Home')
@section('back.admin')
@endsection

@php($noimg = 'storage/logos/resized/no-logo.jpg')

@section('admin')

<div class="row mainbar">

	<div class="col-md-12 marB20">
		<a href="{{ route('store.new') }}" class="btn btn-primary f-right">Crear un nuevo negocio</a>
		<h1>Negocios que administras</h1>
		<hr>
	</div>

	@foreach($stores as $store)

		@php($img = 'storage/logos/resized/'.$store->shop->image_profile)

		<div class="col-md-4 box-admin">
			<div class="box-admin-container">
				<div class="card-body clearfix">
					<div class="row">
						<div class="col-md-4 offset-md-4">
							<a href="{{ route('store.home', ['alias' => $store->alias]) }}">
								<img src="{{ file_exists($img) && !is_dir($img) ? asset($img) : asset($noimg) }}" class="img-fluid rounded-circle">
							</a>
						</div>
					</div>
					<div class="align-center marT10">
						<h3 class="mar0 f20"><a href="{{ route('store.home', ['alias' => $store->alias]) }}">{{ $store->name }}</a></h3>
						<p class="marT10 marB0 f13 bold {{ $store->status == 1 ? 'text-primary' : 'text-danger' }}">
							<a href="{{ route('store.home', ['alias' => $store->alias]) }}" class="btn btn-secondary btn-sm">Administrar negocio</a>
						</p>
					</div>
				</div>
			</div>
		</div>

		@php($img=null)

	@endforeach

</div>

@endsection