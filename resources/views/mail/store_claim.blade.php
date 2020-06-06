@extends('mail._layout')

@section('content-mail')

<p>Estimad{{$info->gender}} {{$info->report->item->store->admins->first()->user->profile->name}},</p>
<p>Te informamos que uno de los artículos que publicaste en «{{$info->report->item->store->name}}» fue denunciado por un usuario de <b>Tucushop.com</b></p>

<p>El detalle de la denuncia es el siguiente:</p>

<div class="nw-box-detail">
<p><b>Artículo:</b><br> {{$info->report->item->name}} (<a href="{{ route('item.detail', ['name' => UrlFormat::url_limpia($info->report->item->name), 'item_id' => $info->report->item->id]) }}">Ver artículo</a>)</p>
<p><b>Tipo de denuncia:</b><br> {{$info->report->reason}}</p>
<p><b>Detalle:</b><br> {{$info->report->content}}</p>
<p><b>Fecha:</b><br> {{$info->report->created_at}}</p>
</div>

<p>Te rogamos revisar la publicación denunciada y realizar las correcciones pertinentes, para evitar la futura suspensión de tu cuenta.</p>
<p>(Además te informamos que a raíz de esta denuncia, un auditor de <b>Tucushop.com</b> revisará el contenido de tu publicación y la misma quedará en observación por el tiempo que el mismo consiere prudente).</p>

<p>¡Gracias por ser parte de <b>Tucushop.com</b>!</p>

<p><br>--<br>Equipo Tucushop</p>

@endsection