<div class="box-item{{ $item->offer ? ' item-offer' : '' }} col-md-3">
	<div class="box-item-body">
		<figure class="box-item-image">
			<a href="{{ route('item.detail', ['name' => \UrlFormat::url_limpia($item->name), 'id' => \UrlFormat::add_zeros($item->id)]) }}">
				<img src="{{ asset('storage/items/sm/'.$item->photos->first()->file_path.'?v='.$item->photos->first()->version) }}" class="img-fluid" />
			</a>
		</figure>
		<div class="box-item-details">
			<h3><a href="{{ route('item.detail', ['name' => \UrlFormat::url_limpia($item->name), 'id' => \UrlFormat::add_zeros($item->id)]) }}">{{ $item->name }}</a></h3>
			@if($item->offer)
				<p><span class="offer">$ {{ $item->price }}</span><span>/</span>$ {{ $item->offer->price }}</p>
				<div class="box-item-offer-flag">{{ $item->offer->percent }}% OFF</div>
			@else 
				<p>$ {{ $item->price }}</p>
			@endif
		</div>
	</div>
</div>