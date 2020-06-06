@extends('mail._layout')

@section('content-mail')

<p>Se eliminó un negocio en Tucushop.com</p>
<p>Estos son los datos:</p>

<div class="nw-box-detail">
    <p><b>Nombre:</b> {{ $info->store->name }}</p>
    <p><b>Usuario:</b> {{ '@'.$info->store->alias }} </p>
    <p><b>Descripción:</b> {{ $info->store->description }}</p>
    <p><b>Creado:</b> {{ $info->store->created_at }}</p>
    <p><b>Eliminado:</b> {{ date('d-m-Y') }}</p>
</div>

@endsection