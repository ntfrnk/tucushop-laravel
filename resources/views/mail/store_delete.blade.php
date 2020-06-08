@extends('mail._layout')

@section('content-mail')

<p>Estimad{{$info->gender}} {{$info->store->admins->first()->user->profile->name}},</p>
<p>Te informamos que el negocio «{{$info->store->name}}» fue eliminado correctamente en <b>Tucushop.com</b>, junto a toda la información relativa al mismo.</p>
<p>Si tienes alguna duda respecto a este u otros temas de la web, te invitamos a revisar la información disponible en el área de ayuda y soporte de <b>Tucushop.com</b>.</p>
<p>Esperamos que pronto puedas volver a vender en nuestra web.</p>
<p>¡Gracias por ser parte de <b>Tucushop.com</b>!</p>

<p><br>--<br>Equipo Tucushop</p>

@endsection