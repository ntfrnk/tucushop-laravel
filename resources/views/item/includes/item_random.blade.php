<div class="box-item{{ $item_rand->offer ? ' item-offer' : '' }} item-random item">
	<div class="box-item-body">
		<figure class="box-item-image">
			<a href="{{ route('item.detail', ['name' => \UrlFormat::url_limpia($item_rand->name), 'id' => \UrlFormat::add_zeros($item_rand->id)]) }}">
				<img src="{{ asset('storage/items/sm/'.$item_rand->photos->sortBy('ordering')->first()->file_path.'?v='.$item_rand->photos->sortBy('ordering')->first()->version) }}" class="img-fluid" />
			</a>
		</figure>
		<div class="box-item-details">
			<h3 class="ellipsis"><a href="{{ route('item.detail', ['name' => \UrlFormat::url_limpia($item_rand->name), 'id' => \UrlFormat::add_zeros($item_rand->id)]) }}">{{ $item_rand->name }}</a></h3>
			@if($item_rand->offer)
				<p><span class="offer">$ {{ $item_rand->price }}</span><span>/</span>$ {{ $item_rand->offer->price }}</p>
				<div class="box-item-offer-flag">{{ $item_rand->offer->percent }}% OFF</div>
			@else 
				<p>$ {{ $item_rand->price }}</p>
			@endif
		</div>
	</div>
</div>