@extends('layouts.app')

{{-- Definición de etiquetas SEO / SEM ::::::::::::::::::::::::::--}}

@section('title', $item->name)

@if($item->tags->count()>0)
	@foreach($item->tags as $tag)
		@php($item_keyword[]=$tag->keyword->keyword)
	@endforeach
	@php($keywords = $item_keyword ? implode(", ", $item_keyword) : '')
@else 
	@php($keywords = '')
@endif

@section('meta-title', $item->name)
@section('meta-description', $item->detail)
@section('meta-keywords', $keywords)
@section('meta-image', asset('storage/items/lg/'.$item->photos->first()->file_path.'?v='.$item->photos->first()->version))
@section('meta-url', Request::url())

{{-- Fin de definición de etiquetas SEO / SEM :::::::::::::::::::--}}


@section('content')

@if($item->store->plan->eshop==1)

	<section>
		<div class="store-header store-header-item" style="background-image: url({{ asset('storage/stores/resized/'.$item->store->shop->image_header) }});">
			<div class="store-header-cover" style="background: rgba(0,0,0,{{ $item->store->shop->opacity_header!=100 ? '0.'.\UrlFormat::add_zeros($item->store->shop->opacity_header, 2) : 1 }});"></div>
			<div class="container">
				<div class="row">
					<div class="store-header-card" style="background: rgba(255,255,255,0.85); border-radius: 4px;">
						<div class="store-header-card-image">
							<a href="{{ route('store.index', ['alias' => $item->store->alias]) }}">
								<img src="{{ asset('storage/logos/resized/'.$item->store->shop->image_profile) }}" class="img-fluid">
							</a>
						</div>
						<div class="store-header-card-name">
							<h3 class="mar0 f22">{{ $item->store->name }}</h3>
							<p class="mar0 f14 bold">{{ '@'.$item->store->alias }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endif

<div class="clear"></div>

<section class="relative{{ $item->store->plan->eshop!=1 ? ' marT50' : '' }}">

	<div class="container">

		<div class="row product-item-showing">

			@if($item_disabled != 0)
			
				{{-- Muestro las fotos --}}
				<div class="col-md-6">
					<div id="item-photos" class="carousel slide" data-ride="carousel">
						@if($item->photos->count() != 1)
							<ol class="carousel-indicators">
								@php($i=0)
								@foreach($item->photos->sortBy('ordering') as $photo)
									<li data-target="#item-photos" data-slide-to="{{ $i }}"{{ $i==0 ? ' class="active"' : '' }}></li>
									@php($i++)
								@endforeach
							</ol>
						@endif
						<div class="carousel-inner">
							@php($i=0)
							@foreach($item->photos->sortBy('ordering') as $photo)
								<div class="carousel-item{{ $i==0 ? ' active' : '' }}">
									<img src="{{ asset('storage/items/lg/'.$photo->file_path.'?v='.$photo->version) }}" class="img-fluid">
								</div>
								@php($i++)
							@endforeach
						</div>
						@if($item->photos->count() != 1)
							<a class="carousel-control-prev" href="#item-photos" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#item-photos" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						@endif
					</div>

				</div>


				{{-- Detalle del item --}}

				<div class="col-md-6">

					<div class="marB30">
						<a href="javascript:;" onclick="add_wishlist({{ $item->id }}{{ \Auth::user() ? ', 1' : '' }})" class="inline-block float-right heart-on marL30" title="Agregar a favoritos">
							<span class="f30 {{ \Auth::user() && $item->likes->contains('user_id', \Auth::user()->id) ? 'fa' : 'far' }} fa-heart"></span>
						</a>
						<h1 class="lh34 f30">{{ $item->name }}</h1>
						<h3 class="f13 texto marB10">
							By: 
							@if($item->store->plan->eshop==1)
								<strong><a href="{{ route('store.index', ['alias' => $item->store->alias]) }}">{{ $item->store->name }}</a></strong>
							@else
								<strong>{{ $item->store->name }}</strong>
							@endif
						</h3>

						@if($item->offer)
							<div class="precio-item">
								<span class="old">$ {{ $item->price }}</span>&nbsp;<span class="new">$ {{ $item->offer->price }}</span>
								<span class="f14 badge badge-danger inline-block marB20">{{ $item->offer->percent }}% OFF</span>
							</div>
						@else
							<div class="color-gray precio-item">$ {{ $item->price }}</div>
						@endif

						<p class="item-details padT15 padB0">
							{{ $item->detail }}
						</p>

					</div>

					<div class="row marT20 marB30">
						<div class="col-md-6">
							<a href="{{ route('item.purchase', ['item_id' => \UrlFormat::add_zeros($item->id)]) }}" class="btn btn-primary w-100">
								<i class="fa fa-shopping-bag marR5"></i> 
								Comprar
							</a>
						</div>
						<div class="col-md-6">
							<a href="javascript:;" class="w-100 btn-cart btn btn-{{ \Auth::user() && \Help::inCart($item->id) ? 'secondary' : 'outline-primary' }}" onclick="add_cart({{ $item->id }}{{ \Auth::user() ? ', 1' : '' }})">
								<i class="fa fa-shopping-cart marR5"></i> 
								<span class="cart-text">
									{{ \Auth::user() && \Help::inCart($item->id) ? 'Quitar del carrito' : 'Agregar al carrito' }}
								</span>
							</a>
						</div>
					</div>

					<div class="row">
						<h3 class="col-md-12 marB20 f22">Características</h3>
						@foreach($item->features as $feature)
							<div class="col-md-4 marB15 f13 padB10" style="border-bottom: dashed 1px #CCC;">
								<b>{{ $feature->feature->feature }}: </b><br><span class="f15">{{ $feature->content }}</span>
							</div>
						@endforeach
					</div>

					<div class="f15 texto marT10">
						@foreach($item->tags as $tag)
							<a href="search/{{ $tag->keyword->keyword }}/" class="inline-block marR15">
								#{{ mb_strtolower($tag->keyword->keyword) }}
							</a>
						@endforeach
					</div>

					<div class="bordbot marT10 marB20"></div>

					<div class="add-to-cart marB10">
						<a href="javascript:;" class="bot bot-primario" onclick="askquestion(4)">
							<span><i class="fa fa-question-circle" aria-hidden="true"></i> &nbsp; Hacer una pregunta</span>
						</a>
						<a href="javascript:;" class="bot bot-secundario-link marL10" onclick="denunciar('4')">
							<span><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp; Informar un problema</span>
						</a>

					</div>

				</div>

			@else

				<div class="col-md-12 padTB70 a-center f20 em">
					
					<p><i class="f50 fa fa-exclamation-triangle principal"></i></p>
					<p>El artículo que estás buscando se encuentra inhabilitado.</p>

				</div>

			@endif

		</div>

	</div>

</section>

<div class="clear"></div>

<section>

	<div class="container">
	
		{{-- Encabezado de sugeridos --}}
		<div class="carousel-heading row">
			<div class="col-md-2 carousel-icon">
				<i class="fa fa-tag" aria-hidden="true"></i>
			</div>
			<div class="col-md-8 carousel-title">
				<h3>Items relacionados</h3>
				<p>Productos y servicios similares a lo que estás viendo</p>
			</div>
			<div class="col-md-2 carousel-navigation">
				<button type="button" class="suggested carousel-prev btn btn-light" carousel-id="carousel-1"><</button>
				<button type="button" class="suggested carousel-next btn btn-light" carousel-id="carousel-1">></button>
			</div>
		</div>

	</div>

</section>

<section class="marT0">

	<div class="container">

		{{-- Cuerpo de sugeridos --}}

		<div id="suggested" class="box-item-list owl-carousel owl-theme">

			@foreach($items_sugested as $item)

				@include('item.includes.item_carousel')

			@endforeach

		</div>


		{{-- Encabezado de random --}}
		<div class="carousel-heading row marT10">
			<div class="col-md-2 carousel-icon">
				<i class="fa fa-tag" aria-hidden="true"></i>
			</div>
			<div class="col-md-8 carousel-title">
				<h3>También te puede interesar</h3>
				<p>Te sugerimos otros productos y servicios disponibles en la web</p>
			</div>
			<div class="col-md-2 carousel-navigation">
				<button type="button" class="random carousel-prev btn btn-light" carousel-id="random"><</button>
				<button type="button" class="random carousel-next btn btn-light" carousel-id="random">></button>
			</div>
		</div>

		{{-- Cuerpo de random items --}}

		<div id="random" class="box-item-list owl-carousel owl-theme marB500">

			@foreach($items_random as $item)

				@include('item.includes.item_random')

			@endforeach

		</div>

	</div>

</section>

<div class="clear"></div>

@endsection