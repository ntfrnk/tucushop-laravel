@extends('mail._layout')

@section('content-mail')

<p>Un usuario realizó una consulta en Tucushop.com</p>

<p>Estos son los detalles:</p>

<div class="nw-box-detail">
    <p><b>Nombre:</b><br> {{ $info->question->name }}</p>
    <p><b>Contacto:</b><br> {{ $info->question->contact }}</p>
    <p><b>Consulta:</b><br> {{ $info->question->content }}</p>
    <p><b>Fecha y hora:</b><br> {{ $info->question->created_at }}</p>
</div>

@endsection