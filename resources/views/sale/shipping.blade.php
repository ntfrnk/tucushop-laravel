@extends('layouts.app')

@section('content')

	{{-- PRODUCTOS DESTACADOS --}}

	<section style="clear: both;">

		<div class="container padB100">
		
			{{-- Encabezado --}}

			<div class="carousel-heading row">
				<div class="col-md-2 carousel-icon">
					<i class="fa fa-tag" aria-hidden="true"></i>
				</div>
				<div class="col-md-10 carousel-title">
					<h3>¿Cómo quieres recibir tu compra?</h3>
                    <p class="">Estas son las opciones para que recibas los artículos que compraste.</p>
				</div>
			</div>

			{{-- Medios de envío --}}

			<div class="row marT40">

				<div class="col-md-8">

					<form method="POST" id="shipping-save" action="{{ route('sale.shipping.save') }}">

						@csrf

						<input type="hidden" name="amount" value="{{ $total_price }}">
						<input type="hidden" id="deliveryPrice" name="deliveryPrice" value="">

						<div class="card">

							<div class="card-body">

								<ul class="list-group list-group-flush">

									<li class="list-group-item">
										<label class="block" for="no-delivery">
											<input type="radio" name="delivery" class="marT10 marR20 f-left inline-block delivery-option" rel="0" id="no-delivery" checked value="no"> 
											<div class="f-left">
												<span class="f19">Sin envío</span>
												<span class="fw400 f16 block">Deberás ponerte de acuerdo con el vendedor para acordar la entrega.</span>
											</div>
										</label>
									</li>

									<li class="list-group-item">
										<label class="block" for="normal">
											<input type="radio" name="delivery" class="marT10 marR20 f-left inline-block delivery-option" rel="75" id="normal" value="normal"> 
											<div class="f-left">
												<span class="f19">Envío normal ($75)</span>
												<span class="fw400 f16 block">Llevaremos el producto a tu casa dentro de un lapso de 24 Hs.</span>
											</div>
										</label>
									</li>

									<li class="list-group-item">
										<label class="block" for="exclusive">
											<input type="radio" name="delivery" class="marT10 marR20 f-left inline-block delivery-option" rel="150" id="exclusive" value="exclusive"> 
											<div class="f-left">
												<span class="f19">Envío exclusivo ($150)</span>
												<span class="fw400 f16 block">Recibirás tu compra en un plazo máximo de 4 Hs.</span>
											</div>
										</label>
									</li>

								</ul>

							</div>

						</div>

						<div class="card marT30">

							@if(session('message'))
								<div class="card-header bold a-center text-success">{{ session('message') }}</div>
							@endif

							<div class="card-body pad30">
								<h3>Información de envío</h3>
								<hr>

								<div class="marT30">
				
									<div class="form-group row form-row">
										<label for="phone" class="col-md-3 col-form-label">{{ __('Celular') }}</label>
				
										<div class="col-md-5">
											<input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ \Auth::user()->addresses->first()->phone ? \Auth::user()->addresses->first()->phone : '' }}" autocomplete="off">
				
											@error('phone')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
									</div>
				
									<div class="form-group row form-row">
										<label for="address" class="col-md-3 col-form-label">{{ __('Dirección') }}</label>
				
										<div class="col-md-5 input-group">
											<input type="text" id="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ \Auth::user()->addresses->first()->address ? \Auth::user()->addresses->first()->address : '' }}" autocomplete="off">
				
											@error('address')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
									</div>
				
									<div class="form-group row form-row">
										<label for="city" class="col-md-3 col-form-label">{{ __('Localidad') }}</label>
				
										<div class="col-md-5 input-group">
											<input type="text" id="city" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ \Auth::user()->addresses->first()->city ? \Auth::user()->addresses->first()->city : '' }}" autocomplete="off">
				
											@error('city')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
									</div>
									
									<div class="form-group row form-row">
										<label for="postalcode" class="col-md-3 col-form-label">{{ __('Código postal') }}</label>
				
										<div class="col-md-5 input-group">
											<input type="text" id="postalcode" class="form-control @error('postalcode') is-invalid @enderror" name="postalcode" value="{{ \Auth::user()->addresses->first()->postalcode ? \Auth::user()->addresses->first()->postalcode : '' }}" autocomplete="off">
				
											@error('postalcode')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
									</div>

								</div>

							</div>

						</div>

					</form>

				</div>
				
				<div class="col-md-4">

					<div class="card sticky padT0 t100">

						<div class="card-body a-center">

							<div class="f16 fw600 marB0 row">
								<div class="a-left col-8 padT5">Monto de la compra:</div>
								<div class="a-right col-4 f20">$ <span class="sale">{{ $total_price }}</span></div>
							</div>
							<hr>
							<div class="f16 fw600 marB0 row">
								<div class="a-left col-8 padT5">Costo de envío:</div>
								<div class="a-right col-4 f20">$ <span class="delivery">0</span></div>
							</div>
							<hr>
							<p class="f16 fw600 marB0">TOTAL:</p>
							<p class="f40 fw500">$<span class="total">{{ $total_price }}</span></p>

							@if($items!=0)
								<a href="javascript:;" onclick="$('#shipping-save').submit();" class="btn btn-success col-12 marB10 loading">
									Continuar con la compra
								</a>
								<a href="{{ route('cart.clean') }}" class="btn btn-link fw500 text-danger marR10 col-12">
									Vaciar carrito
								</a>
							@endif

						</div>

					</div>

				</div>

			</div>

		</div>

	</section>

	<div class="clear"></div>

@endsection