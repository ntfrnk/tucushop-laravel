@extends('layouts.app')

@section('content')

	{{-- PRODUCTOS DESTACADOS --}}

	<section style="clear: both;">

		<div class="container">
		
			{{-- Encabezado --}}

			<div class="carousel-heading row d-none d-md-block">
				<div class="col-md-2 carousel-icon">
					<i class="fa fa-tag" aria-hidden="true"></i>
				</div>
				<div class="col-md-10 carousel-title">
					<h3>Resultados de tu búsqueda</h3>
				<p class="">Se encontraron <span class="fw600">{{ $items->total() }}</span> coincidencias para <span class="fw600">«{{ $search }}»</span>.</p>
				</div>
			</div>

			<div class="card-body-title d-block d-md-none marT30">
				<h1>Resultados de tu búsqueda</h1>
				<hr>
			</div>

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

			<div class="marT60 marB80 a-center">
				<hr>
				<div class="inline-block marAuto">
					{{ $items->links() }}
				</div>
			</div>

		</div>

	</section>

	<div class="clear"></div>

@endsection