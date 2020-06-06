@extends('mail._layout')

@section('content-mail')

<p>Un artículo fue denunciado en Tucushop.com</p>
<p>Estos son los detalles:</p>

<div class="nw-box-detail">
    <p><b>Artículo:</b><br> {{$info->report->item->name}} (<a href="{{ route('item.detail', ['name' => UrlFormat::url_limpia($info->report->item->name), 'item_id' => $info->report->item->id]) }}">Ver artículo</a>)</p>
    <p><b>Tipo de denuncia:</b><br> {{$info->report->reason}}</p>
    <p><b>Detalle:</b><br> {{$info->report->content}}</p>
    <p><b>Fecha:</b><br> {{$info->report->created_at}}</p>
</div>

@endsection