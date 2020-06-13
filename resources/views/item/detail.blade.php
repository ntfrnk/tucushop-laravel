@extends('layouts.app')

{{-- Definición de etiquetas SEO / SEM ::::::::::::::::::::::::::--}}

@section('title', $item->name)

@if($item->tags!=null && $item->tags->count()>0)
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


@section('cdn')
<script src="//assets.pinterest.com/js/pinit.js" defer asinc></script>
<script src="//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v7.0&appId=680360878656194&autoLogAppEvents=1" async defer crossorigin="anonymous"></script>
<script src="//platform.twitter.com/widgets.js" charset="utf-8" defer async></script>
@endsection



@php($imgShop = public_path().'/storage/stores/resized/'.$item->store->shop->image_header)
@if(file_exists($imgShop) && !is_dir($imgShop))
	@php($imgShop = route('home').'/storage/stores/resized/'.$item->store->shop->image_header.'?v='.$item->store->shop->version_header)
@else
	@php($imgShop = route('home').'/storage/stores/resized/no-header.jpg')
@endif

@php($imgLogo = public_path().'/storage/logos/resized/'.$item->store->shop->image_profile)
@if(file_exists($imgLogo) && !is_dir($imgLogo))
	@php($imgLogo = route('home').'/storage/logos/resized/'.$item->store->shop->image_profile.'?v='.$item->store->shop->version_profile)
@else
	@php($imgLogo = route('home').'/storage/logos/resized/no-logo.jpg')
@endif


@section('content')

@if($item->store->shop->status == 1)

	<section class="d-none d-md-block">
		<div class="store-header store-header-item" style="background-image: url({{ asset($imgShop) }});">
			<div class="store-header-cover" style="background: rgba(0,0,0,{{ $item->store->shop->opacity_header!=100 ? '0.'.\UrlFormat::add_zeros($item->store->shop->opacity_header, 2) : 1 }});"></div>
			<div class="container">
				<div class="row">
					<div class="store-header-card" style="background: rgba(255,255,255,0.85); border-radius: 4px;">
						<div class="store-header-card-image">
							<a href="{{ route('store.index', ['alias' => $item->store->alias]) }}">
								<img src="{{ asset($imgLogo) }}" class="img-fluid">
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

<section class="relative{{ $item->store->shop->status != 1 ? ' item-container' : '' }}">

	<div class="container">

		<div class="row product-item-showing relative padB100">

			@if($item_disabled != 0)
			
				{{-- Muestro las fotos --}}
				<div class="col-md-6 item-col-photos">

					<div id="item-detail" class="owl-carousel owl-theme">

						@php($i=0)
						@foreach($item->photos->sortBy('ordering') as $photo)
							<div class="item item-detail-photo">
								<img src="{{ asset('storage/items/lg/'.$photo->file_path.'?v='.$photo->version) }}" class="img-fluid" idph="{{ $i }}">
							</div>
							@php($i++)
						@endforeach

					</div>

					<div class="n-photo">
						<div>
							<span>Foto </span>
							<span class="n-actual">1</span> de 
							<span class="n-total">{{ $item->photos->count() }}</span>
						</div>
					</div>


				</div>


				{{-- Detalle del item --}}

				<div class="col-md-6 item-col-detail">

					<div class="marB20">
						<a href="javascript:;" onclick="add_wishlist({{ $item->id }}{{ \Auth::user() ? ', 1' : '' }})" class="inline-block float-right heart-on marL30" title="Agregar a favoritos">
							<span class="f30 {{ \Auth::user() && $item->likes->contains('user_id', \Auth::user()->id) ? 'fa' : 'far' }} fa-heart"></span>
						</a>
						<h1 class="lh34 f30">{{ $item->name }}</h1>
						<h3 class="f13 texto marB10">
							By: 
							@if($item->store->shop->status == 1)
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

					<div class="row marT0 marB20">
						<div class="col-md-12">
							<a class="fb-share-button" 
								data-href="{{ Request::url() }}" 
								data-layout="button">
							</a>
							<a href="http://pinterest.com/pin/create/button/?url={{ urlencode(Request::url()) }}&amp;media={{ urlencode(route('home').'/storage/items/lg/'.$item->photos->first()->file_path) }}" class="btn btn-primary btn-sm btn-pt f18">
								<i class="fab fa-pinterest"></i>
							</a>
							<a href="whatsapp://send?text={{ urlencode($item->name.': '.Request::url()) }}" class="badge badge-success text-white btn-wp">
								<i class="fab fa-whatsapp f13 block f-left"></i> <span class="inline-block f11 fw600 lh10">Enviar</span>
							</a>
							<a href="https://twitter.com/intent/tweet?text={{ urlencode($item->name) }}&url={{ urlencode(Request::url()) }}" class="badge badge-info text-white btn-wp">
								<i class="fab fa-twitter f13 block f-left"></i> <span class="inline-block f11 fw600 lh10">Twittear</span>
							</a>
						</div>
					</div>

					<hr>

					{{-- <div class="row marT20 marB30">
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
					</div> --}}

					@if($item->tags && $item->features->count() != 0)
						<div class="row item-features">
							<div class="col-md-12">
								<h3 class="marB20 f22">Características</h3>
								@foreach($item->features as $feature)
									<span class="item-feature marB5 f14 padB0 marR5 inline-block">
										<b>{{ $feature->feature->feature }}: </b> <span class="f14">{{ $feature->content }}</span>
									</span>
								@endforeach
							</div>
						</div>
						<hr>
					@endif
					
					@if($item->tags && $item->tags->count() != 0)
						<div class="f15 texto marT10">
							@if($item->tags!=null && $item->tags->count()>0)
								@foreach($item->tags as $tag)
									<a href="{{ route('search.results',['keyword' => $tag->keyword->keyword]) }}" class="inline-block marR15">
										#{{ mb_strtolower($tag->keyword->keyword) }}
									</a>
								@endforeach
							@endif
						</div>
						<hr>
					@endif

					<div class="row padT10 btn-question">
						<div class="col-md-12">
							<a href="javascript:;" class="btn btn-primary item-question" id="message">
								<span><i class="fa fa-question-circle" aria-hidden="true"></i> &nbsp; Hacer una pregunta al vendedor</span>
							</a>
						</div>
					</div>

				</div>

			@else

				<div class="col-md-12 padTB70 a-center f20 em">
					
					<p><i class="f50 fa fa-exclamation-triangle principal"></i></p>
					<p>El artículo que estás buscando se encuentra inhabilitado.</p>

				</div>

			@endif

			<div class="card-footer detail-footer col-12 absolute l0 b0 w100 a-center">
				<a href="javascript:;" class="text-danger" id="problem">
					<span><i class="fa fa-exclamation-triangle marR5"></i>Informar un problema con este artículo</span>
				</a><span class="d-none d-md-inline-block">&nbsp; &nbsp; | &nbsp; &nbsp;</span><span class="d-block d-md-none"></span>
				<a href="javascript:;" class="text-danger reporting">
					<span><i class="fa fa-bug marR5"></i>Reportar un error con la página</span>
				</a>
			</div>

		</div>

	</div>

</section>

<div class="clear"></div>

<section>

	<div class="container">
	
		{{-- Encabezado de sugeridos --}}
		<div class="carousel-heading row">
			<div class="col-2 col-md-2 carousel-icon">
				<i class="fa fa-tag" aria-hidden="true"></i>
			</div>
			<div class="col-10 col-md-8 carousel-title">
				<h3>Items relacionados</h3>
				<p class="d-none d-md-block">Productos y servicios similares a lo que estás viendo</p>
			</div>
			<div class="col-md-2 carousel-navigation d-none d-md-block">
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

			@foreach($items_sugested as $item_suggest)

				@include('item.includes.item_carousel')

			@endforeach

		</div>


		{{-- Encabezado de random --}}
		<div class="carousel-heading row marT10">
			<div class="col-2 col-md-2 carousel-icon">
				<i class="fa fa-tag" aria-hidden="true"></i>
			</div>
			<div class="col-10 col-md-8 carousel-title">
				<h3>T<span class="d-none d-md-block">ambién t</span>e puede interesar</h3>
				<p class="d-none d-md-block">Te sugerimos otros productos y servicios disponibles en la web</p>
			</div>
			<div class="col-md-2 carousel-navigation d-none d-md-block">
				<button type="button" class="random carousel-prev btn btn-light" carousel-id="random"><</button>
				<button type="button" class="random carousel-next btn btn-light" carousel-id="random">></button>
			</div>
		</div>

		{{-- Cuerpo de random items --}}

		<div id="random" class="box-item-list owl-carousel owl-theme marB500">

			@foreach($items_random as $item_rand)

				@include('item.includes.item_random')

			@endforeach

		</div>

	</div>

</section>

<div class="clear"></div>

@endsection



@section('modals')

{{-- Hacer una pregunta al vendedor ---------------------------- --}}

<div class="pop-container" id="m-message">
    <div class="pop-box">
        <div class="pop-head">{{ config('app.name', 'Laravel') }}</div>
        <a href="javascript:;" class="pop-close pop-btn-close" onclick="pop_close()"><i class="fa fa-times"></i></a>
        <div class="pop-html">
            <div id="modal-message">
    
                <div class="padB30">
        
                    <div class="pop-header">
                        <h3>Hacer una pregunta al vendedor</h3>
                    </div>

                    <div class="form-message">

                        <form id="send-message" action="{{ route('item.message') }}" method="POST">
                            
                            @csrf

							<input type="hidden" name="item_id" value="{{ $item->id }}">
							
							<div class="form-group row">
								<label class="col-md-3 col-form-label text-md-right">{{ __('Artículo') }}</label>
                                <div class="col-md-8 a-left padT5">
									<span class="fw500 f18">{{ $item->name }}</span>
								</div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">{{ __('Escribe tu consulta') }}</label>
                                <div class="col-md-8">
                                    <textarea name="content" rows="4" class="form-control" required autocomplete="off"></textarea>
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label text-md-right">&nbsp;</label>
                                <div class="col-md-8 a-left">
                                    <button type="submit" class="btn btn-primary" rel="submit">Enviar consulta</button>
                                    <button type="button" class="btn btn-link" onclick="pop_close();">Cancelar</button>
                                </div>
                            </div>

                        </form>

                    </div>

                    <div class="resp-message none">
                        <div class="f18 alert alert-success padT25">
                            <p>Tu consulta fue enviada correctamente al vendedor.<br>Encontrarás la respuesta a tu consulta en tu área de mensajes.</p>
                            <p class="b">¡Muchas gracias por ser parte de Tucushop!</p>
                        </div>
                        <p class="marT20"><button type="button" class="btn btn-primary w25 refresh">Cerrar esta ventana</button></p>
                    </div>
        
                </div>
        
            </div>

        </div>

    </div>
</div>


{{-- Informar un problema con un producto ---------------------------- --}}

<div class="pop-container" id="m-problem">
    <div class="pop-box">
        <div class="pop-head">{{ config('app.name', 'Laravel') }}</div>
        <a href="javascript:;" class="pop-close pop-btn-close" onclick="pop_close()"><i class="fa fa-times"></i></a>
        <div class="pop-html">
            <div id="modal-problem">
    
                <div class="padB30">
        
                    <div class="pop-header">
                        <h3>Informar un problema con este artículo</h3>
                    </div>

                    <div class="form-problem">

                        <form id="send-problem" action="{{ route('feedback.problem') }}" method="POST">
                            
                            @csrf

                            <input type="hidden" name="item_id" value="{{ $item->id }}">

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">{{ __('Cuál es el problema?') }}</label>
                                <div class="col-md-8">
                                    <select name="reason" class="form-control">
                                        <option value="Info engañosa">La información publicada es engañosa</option>
                                        <option value="Precio falso">El precio del artículo no es real</option>
                                        <option value="Fotos falsas">Las fotos no pertenecen al artículo publicado</option>
                                        <option value="Sin stock">El artículo está publicado pero no hay stock</option>
                                        <option value="Otro">Otro problema (decribir el detalle más abajo)</option>
									</select>
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">{{ __('Escribe los detalles del problema que encontraste') }}</label>
                                <div class="col-md-8">
									<textarea name="content" rows="4" class="form-control" required autocomplete="off"></textarea>
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label text-md-right">&nbsp;</label>
                                <div class="col-md-8 a-left">
                                    <button type="submit" class="btn btn-primary" rel="submit">Enviar informe</button>
                                    <button type="button" class="btn btn-link" onclick="pop_close();">Cancelar</button>
                                </div>
                            </div>

                        </form>

                    </div>

                    <div class="resp-problem none">
                        <div class="f18 alert alert-success padT25">
                            <p>El problema fue reportado exitosamente.<br>Vamos a tomar cartas en el asunto para evitar que estas cosas ocurran.</p>
                            <p class="b">¡Muchas gracias por ayudarnos a mejorar!</p>
                        </div>
                        <p class="marT20"><button type="button" class="btn btn-primary w25 refresh">Cerrar esta ventana</button></p>
                    </div>
        
                </div>
        
            </div>

        </div>

    </div>
</div>

@endsection