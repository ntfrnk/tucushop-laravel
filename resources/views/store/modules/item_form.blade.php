@extends('store.index')

@if(session('resp')=='scroll')
    @section('actionsjs')
        <script type="text/javascript" defer>$(function(){ window.scroll(0, 250) });</script>
    @endsection
@endif

@section('section.admin', isset($item) ? 'Editar item' : 'Nuevo item')
@section('back.admin')
    <a href="{{ route('items', ['alias' => $store->alias]) }}">Volver al listado</a>
@endsection

@if(isset($item))
    @php($img = 'storage/items/sm/'.\PhotoItem::first($item->id))
    @php($noimg = 'storage/items/sm/no-image-min.jpg')
@endif

@section('admin')

<div class="row justify-content-center">
    <div class="col-md-12 mainbar">
        
    	<div class="card padB20">
        	<div class="card-body pad30">

                <div class="f16 marB30">
                    <h1 class="f30 marB15">{{ isset($item) ? 'Editar item' : 'Nuevo item' }}</h1>
                    <hr>
                </div>

                {{-- Inicio del formulario --}}
                
                <form method="POST" action="{{ isset($item) ? route('item.update') : route('item.save') }}">

                    @csrf

                    <input type="hidden" name="item_id" value="{{ isset($item) ? $item->id : '' }}">
                    <input type="hidden" name="store_id" value="{{ $store->id }}">

                    <div class="row{{ isset($item) ? '' : ' justify-content-center' }}">
                        
                        @if(isset($item))
                            <div class="col-md-4">
                                <img src="{{ file_exists($img) && !is_dir($img) ? asset($img) : asset($noimg) }}" class="img-fluid">
                                <div class="form-group form-group-alt marT15 absolute b60 l25">
                                    <a href="{{ route('item.photos', ['alias' => $store->alias, 'item_id' => $item->id]) }}" class="btn btn-sm btn-light">
                                        <i class="fa fa-camera marR5"></i>Gestionar fotos
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-8">

                            <div class="form-group form-group-alt">

                                <label for="name">{{ __('Nombre') }}</label>

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($item) ? $item->name : '' }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group form-group-alt">

                                <label for="detail">{{ __('Detalle') }}</label>

                                <textarea id="detail" rows="3" class="form-control @error('detail') is-invalid @enderror" name="detail" autocomplete="off">{{ isset($item) ? $item->detail : '' }}</textarea>

                                @error('detail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group form-group-alt">

                                <label for="price">{{ __('Precio') }}</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bold">$</span>
                                    </div>

                                    <input type="text" id="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ isset($item) ? $item->price : '' }}" autocomplete="price">
                                </div>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group form-group-alt">
                                <button type="submit" id="save-form" class="btn btn-primary">
                                    <i class="fa fa-save marR5"></i>{{ isset($item) ? 'Guardar cambios' : 'Guardar nuevo item' }}
                                </button>
                            </div>

                        </div>

                    </div>

                </form>

                {{-- Fin del formulario --}}

                <hr>

                {{-- Características --}}
                
                @if(isset($item))

                    <div class="">

                        <div class="form-group form-group-alt row">

                            <div class="col-md-6">

                                <div class="marT30">
                                    <h3 class="f22 marB0">Características</h3>
                                    <hr>
                                </div>

                                <form action="{{ route('item.feature.add') }}" method="POST">

                                    <label for="feature_id">Añadir una característica: </label>
                                    <div class="input-group marT0">
                                        @csrf

                                        <select class="form-control" name="feature_id" id="feature_id">
                                            @foreach($features as $feature)
                                                <option value="{{ $feature->id }}">{{ $feature->feature }}</option>
                                            @endforeach
                                            <option value="more">Otra característica</option>
                                        </select>

                                        <input type="text" id="content" class="form-control" name="content" required>
                                        <input type="hidden" name="item_id" id="item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="alias" id="alias" value="{{ $store->alias }}">

                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Agregar</button>
                                        </div>
                                    </div>

                                </form>

                                <div class="marT15">

                                    @foreach($item->features as $feature)
                                    <div class="badge badge-light f13 marB5 marR5">
                                        
                                            {{ $feature->feature->feature }}:
                                        
                                            <span class="fw400 inline-block">{{ $feature->content }}</span>

                                            <a href="{{ route('item.feature.delete', ['item_id' => $item->id, 'feature_id' => $feature->feature_id, 'alias' => $store->alias]) }}" class="inline-block marL10">
                                                <i class="fa fa-times"></i>
                                            </a>
                                    </div>
                                    @endforeach

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="marT30">
                                    <h3 class="f22 marB0">Etiquetas / Hashtags</h3>
                                    <hr>
                                </div>
                                
                                <form action="{{ route('item.tag.add') }}" method="POST">
                                    @csrf
                                    
                                    <label for="keyword">Añadir una etiqueta:</label>
                                    
                                    <div class="input-group marT0">
                                        
                                        <input type="text" id="keyword" class="form-control" name="keyword">

                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="alias" value="{{ $store->alias }}">

                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Agregar</button>
                                        </div>

                                    </div>
                                </form>

                                <div class="input-group marT10">

                                    <div class="">
                                        @foreach($item->tags as $tag)
                                        <div class="inline-block badge badge-light pad5 marT5 marR5 f13">
                                            #{{ $tag->keyword->keyword }}
                                            <a href="{{ route('item.tag.delete', ['item_id' => $item->id, 'keyword_id' => $tag->keyword_id, 'alias' => $store->alias]) }}" class="inline-block marL10">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                @endif

			</div>
		</div>
        
    </div>
</div>

@endsection