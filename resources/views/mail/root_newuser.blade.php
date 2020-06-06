@extends('mail._layout')

@section('content-mail')

<p>¡Se registró un nuevo usuario en Tucushop.com!</p>
<p>Estos son sus datos:</p>

<div class="nw-box-detail">
    <p><b>Id / Nickname:</b> {{ $info->user->id }} / {{ $info->user->nickname }}</p>
    <p><b>Nombre:</b> {{ $info->user->profile->name }} {{ $info->user->profile->lastname }}</p>
    <p><b>Fecha:</b> {{ $info->user->created_at }}</p>
</div>

@endsection