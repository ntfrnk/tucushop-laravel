@extends('layouts.app')
@section('title', $user->profile->name.' '.$user->profile->lastname.' - Info de usuario')

@section('content')

	<section class="marTB50">

		<div class="container">

			<div class="row justify-content-center">
				<div class="col-md-2">
					<img src="{{ asset('images/profile.jpg') }}" class="img-fluid">
				</div>
				<div class="col-md-8">
					<h1 class="marB0">{{ $user->profile->name . ' ' . $user->profile->lastname }}</h1>
					<p class="f18 marB0">{{ $user->email }}</p>
					<p class="f16"><span class="badge badge-secondary">Registrado {{ \FormatTime::LongTimeFilter($user->created_at) }}</span></p>
					<p class="f16"><a href="{{ route('user.edit') }}" class="btn btn-primary"><i class="fa fa-edit"></i> Modificar mis datos</a></p>
				</div>
			</div>

		</div>

	</section>

	<div class="clear"></div>

@endsection