@extends('store.in')

@section('section.admin', isset($item) ? 'Editar item' : 'Nuevo item')
@section('back.admin')
    <a href="{{ route('items', ['alias' => $store->alias]) }}">Volver al listado</a>
@endsection

@if(isset($item))
    @if(isset($item->photos->first()->file_path) && !empty($item->photos->first()->file_path))
        @php($img = 'storage/items/sm/'.$item->photos->first()->file_path)
    @endif
    @php($noimg = 'storage/items/sm/no-image-min.jpg')
@endif

@section('admin')

<div class="row justify-content-center">
    <div class="col-md-12 mainbar">
        
    	<div class="card padB20">

            @if(session('message'))
                <div class="card-header bold a-center text-success">{{ session('message') }}</div>
            @endif

        	<div class="card-body card-body-pad">

                {{-- Inicio del formulario --}}
                
                <form method="POST" id="form-item" action="{{ isset($item) ? route('item.update') : route('item.save') }}">

                    @csrf

                    <div class="marB30">
                        <div class="mar0 marT0 f-right">
                            <div class="f-right align-right">
                                @if(isset($offer) && $offer == 1)
                                    <span>¡Artículo en oferta!</span>
                                @endif
                                <a href="{{ isset($offer) && $offer == 1 ? route('item.offer.delete', ['item_id' => $item->id]) : 'javascript:;' }}" id="{{ isset($offer) && $offer == 1 ? 'delete-offer' : 'new-offer' }}" class="marL10 btn btn-sm fw500 {{ isset($offer) && $offer == 1 ? 'btn-outline-danger' : 'btn-outline-primary' }}">
                                    {{ isset($offer) && $offer ? 'Eliminar oferta' : '¡Poner este artículo en oferta!' }}
                                </a>
                            </div>
                        </div>
                        <h1 class="f30 marB15">{{ isset($item) ? 'Editar item' : 'Nuevo item' }}</h1>
                        <hr>
                    </div>

                    <input type="hidden" name="item_id" value="{{ isset($item) ? $item->id : '' }}">
                    <input type="hidden" name="store_id" value="{{ $store->id }}">

                    <div class="row{{ isset($item) ? '' : ' justify-content-center' }}">
                        
                        @if(isset($item))
                            <div class="col-md-4">
                                <div class="relative">
                                    <img src="{{ isset($img) && file_exists($img) && !is_dir($img) ? asset('storage/items/sm/'.$item->photos->first()->file_path.'?v='.$item->photos->first()->version) : asset($noimg) }}" class="img-fluid">
                                    <div class="form-group form-group-alt marT15 absolute b0 l15">
                                        <a href="{{ route('item.photos', ['alias' => $store->alias, 'item_id' => $item->id]) }}" class="btn btn-sm btn-light">
                                            <i class="fa fa-camera marR5"></i>Gestionar fotos
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-8">

                            <div class="form-group form-group-alt">

                                <label for="name">{{ __('Nombre') }}</label>

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($item) ? $item->name : old('name') }}" required autocomplete="name">
                                <span class="invalid-feedback name b">@error('name'){{ $message }}</strong>@enderror</span>

                            </div>

                            <div class="form-group form-group-alt">

                                <label for="detail">{{ __('Detalle') }}</label>

                                <textarea id="detail" rows="3" class="form-control @error('detail') is-invalid @enderror" name="detail" autocomplete="off">{{ isset($item) ? $item->detail : old('detail') }}</textarea>
                                <span class="invalid-feedback detail b">@error('detail'){{ $message }}@enderror</span>

                            </div>

                            <div class="form-group form-group-alt">

                                <div class="row">

                                    <label for="price" class="{{ isset($offer) && $offer == 1 ? 'col-6' : 'col-12' }}">{{ __('Precio') }}</label>
                                    
                                    @if(isset($offer) && $offer == 1)
                                        <label for="offer-price" class="col-6">Oferta ({{ $item->offer->percent }}% OFF)</label>
                                    @endif
                                
                                </div>

                                <div class="{{ isset($offer) && $offer == 1 ? 'row' : '' }}">

                                    <div class="input-group{{ isset($offer) && $offer == 1 ? ' col-6' : '' }}">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bold">$</span>
                                        </div>
                                        <input type="text" id="price" class="{{ isset($offer) && $offer == 1 ? 'tachado ' : '' }} f20 form-control @error('price') is-invalid @enderror" name="price" value="{{ isset($item) ? $item->price : old('price') }}"{{ isset($offer) && $offer == 1 ? ' readonly' : '' }} autocomplete="off">
                                        <span class="invalid-feedback price b">@error('price'){{ $message }}@enderror</span>
                                    </div>

                                    @if(isset($offer) && $offer == 1)
                                        <div class="input-group col-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bold">$</span>
                                            </div>
                                            <input type="text" class="form-control f20 @error('price') is-invalid @enderror" name="price" value="{{ $item->offer->price }}" readonly autocomplete="off">
                                            <span class="invalid-feedback offer-price b">@error('price'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="f14 text-muted col-12 marT10 em">(*) Para cambiar el precio a un artículo en oferta primero debes eliminar la oferta.</div>
                                    @endif

                                </div>

                            </div>

                            @if(!isset($item))
                                <div class="form-group form-group-alt">
                                    <button type="submit" rel="submit" id="save-form" class="btn btn-primary btn-important">
                                        <i class="fa fa-save marR5"></i>{{ isset($item) ? 'Guardar cambios' : 'Guardar nuevo item' }}
                                    </button>
                                    <a href="{{ route('items', ['alias' => $store->alias]) }}" class="btn btn-outline-primary btn-important">Cancelar</a>
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

                                    @if($item->features && $item->features->count() != 0)
                                        @foreach($item->features as $feature)
                                            <div class="badge badge-light f13 marB5 marR5" id="feature-{{ $item->id }}-{{ $feature->feature->id }}">
                                                {{ $feature->feature->feature }}: <span class="fw400 inline-block">{{ $feature->content }}</span>
                                                <a href="javascript:;" onclick="featureDelete({{ $item->id }}, {{ $feature->feature->id }})" class="inline-block marL10">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif

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
                                        @if($item->tags && $item->tags->count() != 0)
                                            @foreach($item->tags as $tag)
                                            <div class="inline-block badge badge-light pad5 marT5 marR5 f13" id="tag-{{ $item->id }}-{{ $tag->keyword->id }}">
                                                #{{ trim($tag->keyword->keyword) }}
                                                <a href="javascript:;" onclick="tagDelete({{ $item->id }}, {{ $tag->keyword->id }})" class="inline-block marL10">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>

                            </div>

                        </div>

                        @if(isset($item))

                            <hr>

                            <div class="form-group form-group-alt marT10">
                                <div class="f-right align-right">
                                    @if($item->status == 0 && ($item->photos->count() == 0 || $item->price == 0 || empty($item->detail)))
                                        <a href="javascript:;" onclick="notify_open('No puedes {{ __('habilitar') }} un item sin foto.')" class="marR5 btn btn-link text-primary"><i class="fa fa-check"></i> {{ __('Habilitar') }}</a>
                                    @else
                                        <a href="{{ route('item.status', ['item_id' => $item->id, 'editing' => 1]) }}" class="marL10 btn btn-link {{ $item->status == 1 ? 'text-secondary' : 'text-primary' }}"><i class="fa fa-{{ $item->status == 1 ? 'ban' : 'check' }}"></i>&nbsp; {{ $item->status == 1 ? __('Deshabilitar') : __('Habilitar') }}</a>
                                    @endif
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

@section('modals')


@if(isset($item))

{{-- Crear oferta en base al item --------------------------------------- --}}

<div class="pop-container" id="m-offer">
    <div class="pop-box">
        <div class="pop-head">{{ config('app.name', 'Laravel') }}</div>
        <a href="javascript:;" class="pop-close pop-btn-close" onclick="pop_close()"><i class="fa fa-times"></i></a>
        <div class="pop-html">
            <div id="modal-reporting">
    
                <div class="padB30">
        
                    <div class="">
                        <h3>Poner artículo en oferta</h3>
                    </div>

                    <hr>

                    <div class="form-offer marT20">

                        <form id="send-offer" action="{{ route('item.offer') }}" method="POST">
                            
                            @csrf

                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <input type="hidden" id="old-price" value="{{ $item->price }}">
                    
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Artículo') }}</label>
                                <div class="col-md-7 a-left padT5">
                                    <span class="f18">{{ $item->name }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Precio & descuento') }}</label>
                                <div class="col-md-4 input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text fw500">$</span>
                                    </div>
                                    <input type="number" step="10" min="0" max="{{ $item->price }}" name="price" id="offer-price" value="{{ $item->price }}" class="form-control" required autocomplete="off">
                                </div>
                                <div class="col-md-3 input-group">
                                    <input type="number" step="1" min="0" max="99" name="percent" id="offer-percent" value="0" class="form-control" required autocomplete="off">
                                    <div class="input-group-append">
                                        <span class="input-group-text fw500">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Fecha de caducidad') }}</label>
                                <div class="col-md-7">
                                    <input type="date" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d', strtotime('+15 day', strtotime(date('Y-m-d')))) }}" name="expiration" class="form-control" required autocomplete="off">
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label for="" class="col-md-4 col-form-label text-md-right">&nbsp;</label>
                                <div class="col-md-7 a-left">
                                    <button type="submit" class="btn btn-primary" rel="submit">Enviar consulta</button>
                                    <button type="button" class="btn btn-link" onclick="pop_close();">Cancelar</button>
                                </div>
                            </div>

                        </form>

                    </div>
        
                </div>
        
            </div>

        </div>

    </div>
</div>

@endif

@endsection