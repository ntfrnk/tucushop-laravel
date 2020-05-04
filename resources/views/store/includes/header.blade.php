<section>
	<div class="store-header store-header-admin" style="background-image: url({{ asset('storage/stores/resized/'.$store->shop->image_header) }});">
		<div class="store-header-cover" style="background: rgba(0,0,0,{{ $store->shop->opacity_header!=100 ? '0.'.\UrlFormat::add_zeros($store->shop->opacity_header, 2) : 1 }});"></div>
		<div class="container">
			<div class="row">
				<div class="store-header-card" style="background: rgba(255,255,255,0.85); border-radius: 4px;">
					<div class="store-header-card-image">
						<a href="{{ route('store.home', ['alias' => $store->alias]) }}">
							<img src="{{ asset('storage/logos/resized/'.$store->shop->image_profile) }}" class="img-fluid">
						</a>
					</div>
					<div class="store-header-card-name">
						<h3 class="mar0 f22">{{ $store->name }}</h3>
						<p class="mar0 f14 bold">{{ '@'.$store->alias }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>