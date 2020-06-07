@extends('mail._layout')

@section('content-mail')

<p>Estimad{{$info->gender}} {{$info->message->store->admins->first()->user->profile->name}},</p>
<p>Te informamos que te respondieron por una consulta sobre el artículo <em><b>{{ $info->message->item->name }}</b></em>. Para leer y responder a dicha consulta por favor dirígete a:</p>
<p><b>Mis negocios / {{ $info->message->store->name }} / Centro de mensajes.</b></p>
<p>Si tienes alguna duda respecto a este u otros temas de la web, te invitamos a revisar la información disponible en el área de ayuda y soporte de <b>Tucushop.com</b>.</p>
<p>¡Gracias por ser parte de <b>Red Tucushop</b>!</p>

<p><br>--<br>Equipo Tucushop</p>

@endsection