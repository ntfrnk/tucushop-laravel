@extends('layouts.app')

@php($imgShop = public_path().'/storage/stores/resized/'.$store->shop->image_header)
@if(file_exists($imgShop) && !is_dir($imgShop))
	@php($imgShop = route('home').'/storage/stores/resized/'.$store->shop->image_header.'?v='.$store->shop->version_header)
@else
	@php($imgShop = route('home').'/storage/stores/resized/no-header.jpg')
@endif

@php($imgLogo = public_path().'/storage/logos/resized/'.$store->shop->image_profile)
@if(file_exists($imgLogo) && !is_dir($imgLogo))
	@php($imgLogo = route('home').'/storage/logos/resized/'.$store->shop->image_profile.'?v='.$store->shop->version_profile)
@else
	@php($imgLogo = route('home').'/storage/logos/resized/no-logo.jpg')
@endif

@section('content')

<section>
	<div class="store-header store-header-item" style="background-image: url({{ asset($imgShop) }});">
		<div class="store-header-cover" style="background: rgba(0,0,0,{{ $store->shop->opacity_header!=100 ? '0.'.\UrlFormat::add_zeros($store->shop->opacity_header, 2) : 1 }});"></div>
		<div class="container">
			<div class="row">
				<div class="store-header-card" style="background: rgba(255,255,255,0.85); border-radius: 4px;">
					<div class="store-header-card-image">
						<img src="{{ asset($imgLogo) }}" class="img-fluid">
					</div>
					<div class="store-header-card-name">
						<h3 class="mar0 f22">{{ $store->name }}</h3>
						<p class="mar0 f14 bold">{{ '@'.$store->alias }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

{{-- PRODUCTOS Y SERVICIOS --}}

<section class="marT0 relative" style="clear: both;">

	<div class="container">

		<div class="row product-item-showing marB50 padT60 padB40 relative">

			<div class="card-header absolute t0 l0 w100 f16">
				<div class="a-center">
					<a class="fb-share-button" 
						data-href="{{ Request::url() }}" 
						data-layout="button">
					</a>
					<a href="http://pinterest.com/pin/create/button/?url={{ urlencode(Request::url()) }}&amp;media={{ urlencode(route('home').'/storage/logos/resized/'.$store->shop->image_profile) }}" class="btn btn-primary btn-sm btn-pt f18">
						<i class="fab fa-pinterest"></i>
					</a>
					<a href="whatsapp://send?text={{ urlencode($store->name.': '.Request::url()) }}" class="badge badge-success text-white btn-wp">
						<i class="fab fa-whatsapp f13 block f-left"></i> <span class="inline-block f11 fw600 lh10">Enviar</span>
					</a>
					<a href="https://twitter.com/intent/tweet?text={{ urlencode($store->name) }}&url={{ urlencode(Request::url()) }}" class="badge badge-info text-white btn-wp">
						<i class="fab fa-twitter f13 block f-left"></i> <span class="inline-block f11 fw600 lh10">Twittear</span>
					</a>
				</div>
			</div>

			{{-- Cuerpo de productos destacados --}}

			@if($items->count() != 0)

				<div class="col-12">

					<div class="box-item-list row results">
						
						@foreach($items as $item)
						
							@include('item.includes.item_tienda')

						@endforeach

					</div>
					
				</div>

			@else
				<div class="col-12">
					<div class="padTB100 em f20 fw500 a-center">
						Aún no hay productos o servicios en esta tienda.
					</div>
				</div>
			@endif

			<div class="marT20 marB0 a-center col-12">
				<hr>
				<div class="inline-block marAuto">
					{{ $items->links() }}
				</div>
			</div>

			

		</div>

	</div>

</section>

<div class="clear"></div>

@endsection