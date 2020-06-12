@extends('help.in')

@section('section.help', 'Inicio')
@section('back.help')
@endsection

@section('helpview')

<div class="row justify-content-center">
    <div class="col-md-12 mainbar">

		<div class="card marB20">
			<div class="card-body pad30">

                <div class="f17 marB30">
                    <h1 class="f30 marB15">{{ $category->name }}</h1>
                    <hr>
                </div>
				
                <div class="f16 lh26">
                    <ul>
                        @foreach($category->topics->sortBy('ordering') as $topic)
                            <li><a class="text-dark" href="{{ route('help.detail', ['title' => UrlFormat::url_limpia($topic->title), 'id' => $topic->id]) }}">{{ $topic->title }}</a></li>
                        @endforeach
                    <ul>
                </div>

			</div>
		</div>

    </div>
</div>

@endsection