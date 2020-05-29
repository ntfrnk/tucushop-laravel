@extends('user.in')

@section('section.admin', 'Leer mensaje')
@section('back.admin')
    <a href="{{ route('user.messages') }}">Volver al listado de mensajes</a>
@endsection

@section('admin')

<div class="row justify-content-center">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body pad30">

				<div class="f20 lh30">
                    <div class="f16 fw500">
                        <span class="b">Destinatario:</span> 
                        <a href="{{ route('store.index', ['alias' => $message->store->alias]) }}" target="_blank">{{ $message->store->name }}</a>
                    </div>
                    <div class="f16 fw500 lh20">
                        <span class="b">Artículo consultado:</span>
                        <a href="{{ route('item.detail', ['name' => UrlFormat::url_limpia($message->item->name), 'id' => $message->item->id]) }}" target="_blank">{{ $message->item->name }}</a>
                    </div>
                </div>

                <hr>

                <div class="f16 fw500">
                    <span class="b">Consulta:</span>
                </div>
                <div class="f19 marT5 lh26">
                    <div>{{ $message->content }}</div>
                    <div class="f13 text-muted marT5">Enviada {{ FormatTime::LongTimeFilter($message->created_at) }}</div>
                </div>

                <hr>

                @if($message->answers && $message->answers->count() != 0)

                    <div class="f16 fw500">
                        <span class="b">Respuestas:</span>
                    </div>

                    @foreach($message->answers as $answer)

                        <div class="f15 marT5 marB10">
                            <span class="b">
                                @if($answer->sended_by == 'store')
                                    <a href="{{ route('store.index', ['alias' => $answer->store->alias]) }}">
                                        {{  $answer->store->name }}
                                    </a>:
                                @else                                
                                    {{  $answer->user->profile->name }} {{  $answer->user->profile->lastname }}:
                                @endif
                            </span>&nbsp; 
                            {{ $answer->content }} &nbsp;
                            <span class="f13 text-muted i fw500">({{ FormatTime::LongTimeFilter($answer->created_at) }})</span>
                        </div>

                    @endforeach

                    <div class="marT25 message-resp-form">

                        <form action="{{ route('message.answer') }}" method="post">
                            @csrf

                            <input type="hidden" name="store_id" value="{{ $message->store->id }}">
                            <input type="hidden" name="message_id" value="{{ $message->id }}">
                            <input type="hidden" name="sended_by" value="user">

                            <div class="f16 fw500 marB10">
                                <span class="b">Escribe una respuesta:</span>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea id="content" rows="3" class="form-control @error('content') is-invalid @enderror" name="content" autocomplete="off" required>{{ old('content') }}</textarea>
                                    <span class="invalid-feedback content b">@error('content') {{$message}} @enderror</span>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <button type="submit" rel="submit" class="btn btn-primary">
                                        {{ __('Enviar respuesta') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>

                @else

                    <div class="f16 em marT5">
                        Aún no te respondieron esta consulta
                    </div>

                @endif

			</div>
		</div>
	</div>
</div>
	
</div>

@endsection