@extends('layouts.app')

@section('content')

<section>
	<div class="store-header store-header-item" style="background-image: url({{ asset('storage/stores/resized/'.$store->shop->image_header) }});">
		<div class="store-header-cover" style="background: rgba(0,0,0,{{ $store->shop->opacity_header!=100 ? '0.'.\UrlFormat::add_zeros($store->shop->opacity_header, 2) : 1 }});"></div>
		<div class="container">
			<div class="row">
				<div class="store-header-card" style="background: rgba(255,255,255,0.85); border-radius: 4px;">
					<div class="store-header-card-image">
						<a href="{{ route('store.index', ['alias' => $store->alias]) }}">
							<img src="{{ asset('storage/logos/resized/'.$store->shop->image_profile) }}" class="img-fluid">
						</a>
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

{{-- PRODUCTOS DESTACADOS --}}

<section class="marT0 relative" style="clear: both;">

	<div class="container">

		<div class="row product-item-showing marB30">

			{{-- Cuerpo de productos destacados --}}

			@if($items->count() != 0)

				<div class="box-item-list row results">
					
					@foreach($items as $item)
					
						@include('item.includes.item')

					@endforeach

				</div>

			@else
				<div class="padTB100 em f20 fw500 a-center">
					Tu búsqueda no arrojó resultados.<br>Quizás tengas suerte usando otras palabras.
				</div>
			@endif

			<div class="marT60 marB0 a-center">
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