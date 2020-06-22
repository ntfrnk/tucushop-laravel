<div class="col-md-4 col-lg-3 sidebar">

	<ul>
		@foreach($categories as $category)
			<li>
				<a href="{{ route('help.category', ['name' => UrlFormat::url_limpia($category->name), 'id' => $category->id]) }}">
					<i class="fa fa-angle-right f15"></i> {{ $category->name }}
				</a>
			</li>
		@endforeach

	</ul>

</div>