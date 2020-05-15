@extends('layouts.app')

@section('content')

	{{-- PRODUCTOS DESTACADOS --}}

	<section style="clear: both;">

		<div class="container">
		
			{{-- Encabezado --}}

			<div class="carousel-heading row">
				<div class="col-md-2 carousel-icon">
					<i class="fa fa-tag" aria-hidden="true"></i>
				</div>
				<div class="col-md-10 carousel-title">
					<h3>Tu carrito de compras</h3>
                    <p class="">Estos son los productos y servicios que seleccionaste para comprar.</p>
				</div>
			</div>

			<div class="marT50 marB100">

                @if($items!=0)
                    <table class="table f18">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2" class="f16 w45">Producto o servicio</th>
                                <th class="f16 w15 a-center">Unidades</th>
                                <th class="f16 w15 a-center">Precio Unit.</th>
                                <th class="f16 w15 a-center">Precio Total</th>
                                <th class="f16 w10 a-center">Quitar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($total_price=0)
                            @foreach($items as $item)
                                @php($total_price += $item['price'] * $item['cant'])
                                <tr>
                                    <td class="va-middle">
                                        <a href="{{ route('item.detail', ['name' => \UrlFormat::url_limpia($item['name']), 'id' => $item['id']]) }}">
                                            <img src="{{ asset('storage/items/sm/'.$item['image']) }}" class="thumb">
                                        </a>
                                    </td>
                                    <td class="va-middle fw500">
                                        <a href="{{ route('item.detail', ['name' => \UrlFormat::url_limpia($item['name']), 'id' => $item['id']]) }}">
                                            {{ $item['name'] }}
                                        </a>
                                    </td>
                                    <td class="va-middle a-center fw500">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary b f22 lh16 cant-subtract" onclick="cart_decrease({{ $item['id'] }})" type="button">-</button>
                                            </div>
                                            <input type="text" class="form-control a-center f18" id="count-{{ $item['id'] }}" value="{{ $item['cant'] }}" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary b f22 lh16 cant-add" onclick="cart_increase({{ $item['id'] }})" type="button">+</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="va-middle a-center">${{ $item['price'] }}</td>
                                    <td class="va-middle a-center">${{ $item['price'] * $item['cant'] }}</td>
                                    <td class="va-middle a-center">
                                        <a href="javascript:;" onclick="remove_cart({{ $item['id'] }})" class="btn btn-danger" title="Quitar este item del carrito">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="table-active">
                                <td class="va-middle padTB40">&nbsp;</td>
                                <td class="va-middle fw500">&nbsp;</td>
                                <td class="va-middle a-center fw500">&nbsp;</td>
                                <td class="va-middle a-center b">Costo total:</td>
                                <td class="va-middle a-center b f20">${{ $total_price }}</td>
                                <td class="va-middle a-center">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <div class="padTB80 em f20 a-center">
                        <p class="mar0">El carrito de compras está vacío.</p>
                        <p class="mar0 f16 fw600"><a href="{{ route('home') }}">¿Quienes buscar algo para comprar?</a></p>
                    </div>
                @endif

                <div class="marT40 a-right">
                    
                    <hr>

                    @if($items!=0)
                        <a href="{{ route('cart.clean') }}" class="btn btn-lg btn-outline-danger marR10">
                            Vaciar carrito
                        </a>
                        <a href="{{ route('cart.clean') }}" class="btn btn-lg btn-success">
                            Confirmar compra
                        </a>
                    @endif

                </div>

			</div>

		</div>

	</section>

	<div class="clear"></div>

@endsection