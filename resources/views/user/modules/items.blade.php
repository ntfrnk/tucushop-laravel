@extends('user.in')

@section('section.admin', 'Items')

@section('admin')

<div class="row justify-content-center">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body card-body-pad">

				<div class="card-body-title">
					<h1>Mis favoritos</h1>
					<hr>
				</div>

				@if($items->count()!=0)

					<div class="show-grid">
						<div class="row">
							@php($noimg = 'storage/items/sm/no-image-min.jpg')
							@foreach($items as $item)
								@if(isset($item->item->photos->sortBy('ordering')->first()->file_path) && !empty($item->item->photos->sortBy('ordering')->first()->file_path))
									@php($img = 'storage/items/sm/'.$item->item->photos->sortBy('ordering')->first()->file_path)
								@endif
								<div class="col-6 col-md-4 col-lg-3">
									<div class="show-grid-item show-grid-item-favs">
										<div class="item-info">
											<a href="{{ route('item.detail', ['name' => UrlFormat::url_limpia($item->item->name), 'item_id' => $item->item->id]) }}" target="_blank" title="Ver el detalle de este item">
												<img src="{{ file_exists($img) && !is_dir($img) ? asset($img.'?v='.$item->item->photos->sortBy('ordering')->first()->version) : asset($noimg) }}" class="img-fluid">
											</a>
											<div>{{ $item->item->name }}</div>
										</div>
										<div class="options">
											<a href="javascript:;" onclick="confirm_open_link('¿Estás seguro de que quieres eliminar este item de tus favoritos?', '{{ route('user.like.delete', ['item_id' => $item->item->id]) }}');" class="btn btn-sm btn-outline-danger btn-opt" title="Eliminar este item"><i class="fa fa-times"></i></a>
										</div>
									</div>
								</div>
								@php($img='')
							@endforeach
						</div>
					</div>

				@else

					<table class="table">
						<tr>
							<td class="padTB50 f17 align-center">
								<p class="marB10"><em>Aún no marcaste algún item como favorito.</em></p>
							</td>
						</tr>
					</table>

				@endif

				<div class="a-center marT30">
					<hr>
					<div class="marAuto inline-block">
						{{ $items->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection