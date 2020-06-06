@extends('mail._layout')

@section('content-mail')

<p>¡Se registró un nuevo negocio en Tucushop.com!</p>
<p>Estos son sus datos:</p>

<div class="nw-box-detail">
    <p><b>Nombre:</b> {{ $info->store->name }}</p>
    <p><b>Usuario:</b> {{ '@'.$info->store->alias }} </p>
    <p><b>Descripción:</b> {{ $info->store->description }}</p>
    <p><b>Creado:</b> {{ $info->store->created_at }}</p>
    </div>

@endsection