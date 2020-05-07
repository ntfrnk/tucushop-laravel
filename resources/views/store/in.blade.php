@extends('layouts.app')

{{-- Definición de etiquetas SEO / SEM ::::::::::::::::::::::::::--}}

@section('title', $store->name.' - Administración')
@section('meta-url', Request::url())

{{-- Fin de definición de etiquetas SEO / SEM :::::::::::::::::::--}}

{{-- Cargo los scripts necesarios --}}
@section('scripts')
<script src="{{ asset('scripts/tshop.stores.js') }}" type="text/javascript" defer></script>
@endsection


@section('content')

{{-- @include('store.includes.header') --}}

<div class="clear"></div>

<section class="store-admin">

	<div class="container">

		<div class="row clearfix">

			@include('store.includes.breadcrumb')

			@include('store.includes.sidebar')

			<div class="col-md-9">

				@yield('admin')

			</div>

		</div>

	</div>

</section>

<div class="clear"></div>

@endsection