@extends('mail._layout')

@section('content-mail')

<p>Un usuario reportó un error o bug en Tucushop.com</p>

<p>Estos son los detalles:</p>

<div class="nw-box-detail">
    <p><b>Nombre:</b><br> {{ $info->bug->name }}</p>
    <p><b>URL:</b><br> <a href="{{ $info->bug->url }}">{{ $info->bug->url }}</a></p>
    <p><b>Lugar:</b><br> {{ $info->bug->whereis }}</p>
    <p><b>Descripción:</b><br> {{ $info->bug->content }}</p>
    <p><b>Fecha y hora:</b><br> {{ $info->bug->created_at }}</p>
</div>

@endsection