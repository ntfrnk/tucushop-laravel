@extends('layouts.app')

@section('content')

	{{-- SLIDER PRINCIPAL --}}

	<div id="slider-home" class="carousel slide marT0" data-ride="carousel">

		<ol class="carousel-indicators">
			<li data-target="#slider-home" data-slide-to="0" class="active"></li>
			<li data-target="#slider-home" data-slide-to="1"></li>
		</ol>

		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="{{ asset('images/slider/slider-001.jpg') }}" class="img-fluid">
			</div>
			<div class="carousel-item">
				<img src="{{ asset('images/slider/slider-002.jpg') }}" class="img-fluid"/>
			</div>
		</div>

		<a class="carousel-control-prev" href="#slider-home" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#slider-home" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>

	</div>


	{{-- OFERTAS DE LA SEMANA --}}

	<section>

		<div class="container">
		
			{{-- Encabezado --}}
			<div class="carousel-heading row">
				<div class="col-md-2 carousel-icon">
					<i class="fa fa-tag" aria-hidden="true"></i>
				</div>
				<div class="col-md-8 carousel-title">
					<h3>Ofertas de la semana</h3>
					<p>Con estas ofertas te vas a volver loco!</p>
				</div>
				<div class="col-md-2 carousel-navigation">
					<button type="button" class="home-offers carousel-prev btn btn-light" carousel-id="carousel-1"><</button>
					<button type="button" class="home-offers carousel-next btn btn-light" carousel-id="carousel-1">></button>
				</div>
			</div>

			{{-- Cuerpo de ofertas --}}

			<div id="home-offers" class="box-item-list owl-carousel owl-theme">
	
				@foreach($offers as $offer)

					@include('item.includes.item_offer')

				@endforeach

			</div>

		</div>

	</section>

	<div class="clear"></div>


	{{-- BANNER OFERTAS --}}

	<section>
		<div class="featured-banner" style="background-image: url('{{ asset('/images/banner/banner-background-1.jpg') }}');">
			<div class="container">
				<div class="row">
					<div class="featured-banner-caption align-left">
						<h2>Para tu fiesta...</h2>
						<h1>tu mejor look!</h1>
						<a href="collection/tags/fiesta/" class="btn btn-light">
						<span>Ver propuestas</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="clear"></div>


	{{-- PRODUCTOS DESTACADOS --}}

	<section style="clear: both;">

		<div class="container">
		
			{{-- Encabezado --}}

			<div class="carousel-heading row">
				<div class="col-md-2 carousel-icon">
					<i class="fa fa-tag" aria-hidden="true"></i>
				</div>
				<div class="col-md-10 carousel-title">
					<h3>Ofertas de la semana</h3>
					<p>Con estas ofertas te vas a volver loco!</p>
				</div>
			</div>

			{{-- Cuerpo de productos destacados --}}

			<div class="box-item-list row">
				
				@foreach($items_dest as $item)
				
					@include('item.includes.item')

				@endforeach

			</div>

		</div>

	</section>

	<div class="clear"></div>

@endsection