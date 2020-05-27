<div class="box-item{{ $item_suggest->offer ? ' item-offer' : '' }} item">
	<div class="box-item-body">
		<figure class="box-item-image">
			<a href="{{ route('item.detail', ['name' => \UrlFormat::url_limpia($item_suggest->name), 'id' => \UrlFormat::add_zeros($item_suggest->id)]) }}">
				<img src="{{ asset('storage/items/sm/'.$item_suggest->photos->sortBy('ordering')->first()->file_path.'?v='.$item_suggest->photos->sortBy('ordering')->first()->version) }}" class="img-fluid" />
			</a>
		</figure>
		<div class="box-item-details">
			<h3 class="ellipsis"><a href="{{ route('item.detail', ['name' => \UrlFormat::url_limpia($item_suggest->name), 'id' => \UrlFormat::add_zeros($item_suggest->id)]) }}">{{ $item_suggest->name }}</a></h3>
			@if($item_suggest->offer)
				<p><span class="offer">$ {{ $item_suggest->price }}</span><span>/</span>$ {{ $item_suggest->offer->price }}</p>
				<div class="box-item-offer-flag">{{ $item_suggest->offer->percent }}% OFF</div>
			@else 
				<p>$ {{ $item_suggest->price }}</p>
			@endif
		</div>
	</div>
</div>