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
					<h3>¿Cómo quieres pagar tu compra?</h3>
                    <p class="">Por favor selecciona el medio de pago que más te convenga.</p>
				</div>
			</div>

			{{-- Medios de envío --}}

			<div class="row marT40">

				<div class="col-md-8">

					<form method="POST" id="payment-save" action="{{ route('sale.shipping.save') }}">

						@csrf

						<input type="hidden" name="amount" value="{{ $sale['amount'] }}">

						<div class="card">

							<div class="card-body">

								<ul class="list-group list-group-flush">

									@if($sale['deliveryType'] == "no")
									
										<li class="list-group-item">
											<label class="block" for="cash-onsite">
												<input type="radio" name="paymethod" class="marT10 marR20 f-left inline-block method-option" id="cash-onsite" checked value="cash-onsite"> 
												<div class="f-left">
													<span class="f19">Efectivo en el local</span>
													<span class="fw400 f16 block">Deberás abonar el monto completo cuando te entreguen el paquete.</span>
												</div>
											</label>
										</li>

									@else

										<li class="list-group-item">
											<label class="block" for="cash-delivery">
												<input type="radio" name="paymethod" class="marT10 marR20 f-left inline-block method-option" id="cash-delivery" checked value="cash-delivery"> 
												<div class="f-left">
													<span class="f19">Efectivo contra entrega</span>
													<span class="fw400 f16 block">Deberás abonar el monto completo cuando te entreguen el paquete.</span>
												</div>
											</label>
										</li>

									@endif

									<li class="list-group-item">
										<label class="block" for="mercado-pago">
											<input type="radio" name="paymethod" class="marT10 marR20 f-left inline-block method-option" id="mercado-pago" value="mercado-pago"> 
											<div class="f-left">
												<span class="f19">Medios electrónicos (Mercado Pago)</span>
												<span class="fw400 f16 block">Podrás pagar con tarjetas, operaciones bancarias, Rapipago y Pago Fácil.</span>
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
								<h3>Información de pago</h3>
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
								<div class="a-right col-4 f20">$ <span class="sale">{{ $sale['amount'] }}</span></div>
							</div>
							<hr>
							<div class="f16 fw600 marB0 row">
								<div class="a-left col-8 padT5">Costo de envío:</div>
								<div class="a-right col-4 f20">$ <span class="delivery">{{ $sale['deliveryPrice'] }}</span></div>
							</div>
							<hr>
							<p class="f16 fw600 marB0">TOTAL:</p>
							<p class="f40 fw500">$<span class="total">{{ $sale['amount'] + $sale['deliveryPrice'] }}</span></p>

							<a href="javascript:;" onclick="$('#shipping-save').submit();" class="btn btn-success col-12 marB10 loading">
								Continuar con la compra
							</a>
							<a href="{{ route('cart.clean') }}" class="btn btn-link fw500 text-danger marR10 col-12">
								Vaciar carrito
							</a>

						</div>

					</div>

				</div>

			</div>

		</div>

	</section>

	<div class="clear"></div>

@endsection