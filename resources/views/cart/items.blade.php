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

			<div class="marT50 marB100 row">

                @php($total_price=0)

                @if($items!=0)

                    <div class="col-md-8">
                        <table class="table f17 fw500">
                            <thead class="">
                                <tr>
                                    <th colspan="2" class="f15">Producto o servicio</th>
                                    <th class="f15 a-center">Unidades</th>
                                    <th class="f15 a-center">Precio</th>
                                    <th class="f15 a-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    @php($total_price += $item['price'] * $item['cant'])
                                    <tr>
                                        <td class="va-middle">
                                            <a href="{{ route('item.detail', ['name' => \UrlFormat::url_limpia($item['name']), 'id' => $item['id']]) }}">
                                                <img src="{{ asset('storage/items/sm/'.$item['image']) }}" class="thumb">
                                            </a>
                                        </td>
                                        <td class="va-middle fw500">
                                            <div class="ellipsis w95">
                                                <a href="{{ route('item.detail', ['name' => \UrlFormat::url_limpia($item['name']), 'id' => $item['id']]) }}">
                                                    {{ $item['name'] }}
                                                </a><br>
                                                <a href="javascript:;" onclick="remove_cart({{ $item['id'] }})" class="btn btn-link text-danger btn-sm" title="Quitar este item del carrito">
                                                    <i class="fa fa-times"></i> Eliminar del carrito
                                                </a>
                                            </div>
                                        </td>
                                        <td class="va-middle a-center fw500">
                                            <button class="btn btn-outline-secondary btn-sm b f22 lh16 cant-subtract" onclick="cart_decrease({{ $item['id'] }})" type="button">-</button>
                                            <span id="count-{{ $item['id'] }}" style="width: 30px" class="inline-block">{{ $item['cant'] }}</span>
                                            <button class="btn btn-outline-secondary btn-sm b f22 lh16 cant-add" onclick="cart_increase({{ $item['id'] }})" type="button">+</button>
                                        </td>
                                        <td class="va-middle a-center">${{ $item['price'] }}</td>
                                        <td class="va-middle a-center">${{ $item['price'] * $item['cant'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="col-md-4">

                        <div class="card">

                            <div class="card-body a-center">

                                <p class="f16 fw600 marB0">Monto total (*)</p>
                                <p class="f46 fw500">${{ $total_price }}</p>

                                @if($items!=0)
                                    <a href="{{ route('sale.shipping') }}" class="btn btn-success col-12 marB10">
                                        Continuar con la compra
                                    </a>
                                    <a href="{{ route('cart.clean') }}" class="btn btn-link fw500 text-danger marR10 col-12">
                                        Vaciar carrito
                                    </a>
                                @endif

                                <p class="f14"><hr>(*) Este monto no incluye costos de envío.</p>

                            </div>

                        </div>

                    </div>

                @else

                    <div class="col-md-12">
                        <div class="padTB80 em f20 a-center">
                            <p class="mar0">El carrito de compras está vacío.</p>
                            <p class="mar0 f16 fw600"><a href="{{ route('home') }}">¿Quienes buscar algo para comprar?</a></p>
                        </div>
                    </div>

                @endif

			</div>

		</div>

	</section>

	<div class="clear"></div>

@endsection