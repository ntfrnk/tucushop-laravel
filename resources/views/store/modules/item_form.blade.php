@extends('store.index')

@section('section.admin', isset($item) ? 'Editar item' : 'Nuevo item')
@section('back.admin')
    <a href="{{ route('items', ['alias' => $store->alias]) }}">Volver al listado</a>
@endsection

@if(isset($item))
    @php($img = 'storage/items/sm/'.$item->photos->first()->file_path)
    @php($noimg = 'storage/items/sm/no-image-min.jpg')
@endif

@section('admin')

<div class="row justify-content-center">
    <div class="col-md-12 mainbar">
        
    	<div class="card padB20">
        	<div class="card-body pad30">

                {{-- Inicio del formulario --}}
                
                <form method="POST" id="form-item" action="{{ isset($item) ? route('item.update') : route('item.save') }}">

                    @csrf

                    <div class="f16 marB30">
                        <h1 class="f30 marB15">{{ isset($item) ? 'Editar item' : 'Nuevo item' }}</h1>
                        <hr>
                    </div>

                    <input type="hidden" name="item_id" value="{{ isset($item) ? $item->id : '' }}">
                    <input type="hidden" name="store_id" value="{{ $store->id }}">

                    <div class="row{{ isset($item) ? '' : ' justify-content-center' }}">
                        
                        @if(isset($item))
                            <div class="col-md-4">
                                <img src="{{ file_exists($img) && !is_dir($img) ? asset('storage/items/sm/'.$item->photos->first()->file_path.'?v='.$item->photos->first()->version) : asset($noimg) }}" class="img-fluid">
                                <div class="form-group form-group-alt marT15 absolute b10 l25">
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

                            @if(!isset($item))
                                <div class="form-group form-group-alt">
                                    <button type="submit" id="save-form" class="btn btn-primary">
                                        <i class="fa fa-save marR5"></i>{{ isset($item) ? 'Guardar cambios' : 'Guardar nuevo item' }}
                                    </button>
                                    <a href="{{ route('items', ['alias' => $store->alias]) }}" class="btn btn-outline-primary marL5">Cancelar</a>
                                </div>
                            @endif

                        </div>

                    </div>

                </form>


                {{-- Características --}}
                
                @if(isset($item))

                    <div class="">

                        <div class="form-group form-group-alt row marB30">

                            <div class="col-md-6">

                                <div class="marT30">
                                    <h3 class="f22 marB0">Características</h3>
                                    <hr>
                                </div>

                                <label for="feature_id">Añadir una característica: </label>
                                <div class="input-group marT0">

                                    <input type="text" id="feature_name" class="form-control" placeholder="Ej: Color" autocomplete="off">

                                    <input type="text" id="feature_content" class="form-control" placeholder="Ej: Verde" autocomplete="off">
                                    <input type="hidden" id="item_id" value="{{ $item->id }}">

                                    <input type="hidden" id="feature_data" />

                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary z1" id="add-feature" type="button">Agregar</button>
                                    </div>

                                </div>

                                <div class="marT15" id="show-features">

                                    @foreach($item->features as $feature)
                                        <div class="badge badge-light f13 marB5 marR5" id="feature-{{ $item->id }}-{{ $feature->feature->id }}">
                                            {{ $feature->feature->feature }}: <span class="fw400 inline-block">{{ $feature->content }}</span>
                                            <a href="javascript:;" onclick="featureDelete({{ $item->id }}, {{ $feature->feature->id }})" class="inline-block marL10">
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
                                    
                                <label for="keyword">Palabras separadas por comas:</label>
                                
                                <div class="marT0 input-group">
                                    
                                    <input type="text" id="keyword" class="form-control" placeholder="Ej: vestido, noche, fiesta" autocomplete="off">

                                    {{-- El input id="item_id" está en el formulario de características (features) --}}

                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary z1" type="button" id="add-tags">Agregar</button>
                                    </div>

                                </div>

                                <div class="input-group marT10">

                                    <div id="show-tags">
                                        @foreach($item->tags as $tag)
                                        <div class="inline-block badge badge-light pad5 marT5 marR5 f13" id="tag-{{ $item->id }}-{{ $tag->keyword->id }}">
                                            #{{ trim($tag->keyword->keyword) }}
                                            <a href="javascript:;" onclick="tagDelete({{ $item->id }}, {{ $tag->keyword->id }})" class="inline-block marL10">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>

                            </div>

                        </div>

                        @if(isset($item))

                            <hr>

                            <div class="form-group form-group-alt marT10">
                                <div class="f-right align-right">
                                    <a href="{{ route('item.status', ['item_id' => $item->id, 'editing' => 1]) }}" class="marL10 btn btn-link {{ $item->status == 1 ? 'text-secondary' : 'text-primary' }}"><i class="fa fa-{{ $item->status == 1 ? 'ban' : 'check' }}"></i>&nbsp; {{ $item->status == 1 ? 'Deshabilitar' : 'Habilitar' }}</a>
                                    <a href="javascript:;" onclick="confirm_open_link('¿Estás seguro de que quieres eliminar este item?', '{{ route('item.delete', ['item_id' => $item->id]) }}');" class="marL10 btn btn-link text-danger"><i class="fa fa-times"></i>&nbsp; Eliminar</a>
                                </div>
                                <button type="button" id="save-form-item" class="btn btn-primary">
                                    <i class="fa fa-save marR5"></i>{{ isset($item) ? 'Guardar cambios' : 'Guardar nuevo item' }}
                                </button>
                                <a href="{{ route('items', ['alias' => $store->alias]) }}" class="btn btn-outline-primary marL5">Cancelar</a>
                            </div>
                        @endif

                    </div>

                @endif

			</div>
		</div>
        
    </div>
</div>

@endsection