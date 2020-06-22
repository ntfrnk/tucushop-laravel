@extends('layouts.app')

{{-- Definición de etiquetas SEO / SEM ::::::::::::::::::::::::::--}}

@section('title', 'Centro de ayuda ')
@section('meta-url', Request::url())

{{-- Fin de definición de etiquetas SEO / SEM :::::::::::::::::::--}}

{{-- Cargo los scripts necesarios --}}
@section('scripts')

@endsection


@section('content')

<div class="clear"></div>

<section class="store-admin">

	<div class="container">

		<div class="row clearfix">

			@include('help.includes.breadcrumb')

			@include('help.includes.sidebar')

			<div class="col-md-8 col-lg-9">

				@yield('helpview')

			</div>

		</div>

	</div>

</section>

<div class="clear"></div>

@endsection