@extends('layouts.app')

{{-- Definición de etiquetas SEO / SEM ::::::::::::::::::::::::::--}}

@section('title', $user->name.' '.$user->lastname.' - Administración')
@section('meta-url', Request::url())

{{-- Fin de definición de etiquetas SEO / SEM :::::::::::::::::::--}}

{{-- Cargo los scripts necesarios --}}
@section('scripts')
<script src="{{ asset('scripts/tshop.users.js') }}" type="text/javascript" defer></script>
@endsection


@section('content')

<div class="clear"></div>

<section class="store-admin">

	<div class="container">

		<div class="row clearfix">

			@include('user.includes.breadcrumb')

			@include('user.includes.sidebar_home')

			<div class="col-md-8 col-lg-9">

				@yield('admin')

			</div>

		</div>

	</div>

</section>

<div class="clear"></div>

@endsection