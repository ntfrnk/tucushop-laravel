<div class="box-item item-offer item">
	<div class="box-item-body">
		<figure class="box-item-image">
			<a href="{{ route('item.detail', ['name' => \UrlFormat::url_limpia($offer->item->name), 'id' => \UrlFormat::add_zeros($offer->item->id)]) }}">
				<img src="{{ asset('storage/items/sm/'.$offer->item->photos->first()->file_path.'?v='.$offer->item->photos->first()->version) }}" class="img-fluid" />
			</a>
		</figure>
		<div class="box-item-details">
			<h3><a href="{{ route('item.detail', ['name' => \UrlFormat::url_limpia($offer->item->name), 'id' => \UrlFormat::add_zeros($offer->item->id)]) }}">{{ $offer->item->name }}</a></h3>
			<p><span class="offer">$ {{ $offer->item->price }}</span><span>/</span>$ {{ $offer->price }}</p>
			<div class="box-item-offer-flag">{{ $offer->percent }}% OFF</div>
		</div>
	</div>
</div>