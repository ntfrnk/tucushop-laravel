@extends('mail._layout')

@section('content-mail')

<p>Estimad{{$info->gender}} {{$info->message->user->profile->name}},</p>
<p>Te informamos que tu consulta por el artículo <em><b>{{ $info->message->item->name }}</b></em> fue respondida. Para acceder a dicha respuesta por favor dirígete a tu área de usuario, en la sección «Centro de mensajes».</p>
<p>Si tienes alguna duda respecto a este u otros temas de la web, te invitamos a revisar la información disponible en el área de ayuda y soporte de <b>Tucushop.com</b>.</p>
<p>¡Gracias por ser parte de <b>Red Tucushop</b>!</p>

<p><br>--<br>Equipo Tucushop</p>

@endsection