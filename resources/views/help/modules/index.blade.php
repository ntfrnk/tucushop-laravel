@extends('help.in')

@section('section.help', 'Inicio')
@section('back.help')
@endsection

@section('helpview')

<div class="row justify-content-center">
    <div class="col-md-12 mainbar">

		<div class="card marB20">
			<div class="card-body pad30">

				<div class="row marT20">

					@foreach($categories as $category)

						<div class="col-12">
                            <h4 class="f18 fw600">
                                <a href="{{ route('help.category', ['name' => UrlFormat::url_limpia($category->name), 'id' => $category->id]) }}">
                                    {{ $category->name }}
                                </a>
                            </h4>
                            <div class="f15">
                                <ul>
                                    @foreach($category->topics->sortBy('ordering') as $topic)
                                        <li><a class="text-dark" href="{{ route('help.detail', ['title' => UrlFormat::url_limpia($topic->title), 'id' => $topic->id]) }}">{{ $topic->title }}</a></li>
                                    @endforeach
                                <ul>
                            </div>
						</div>

					@endforeach

				</div>

			</div>
		</div>

    </div>
</div>

@endsection