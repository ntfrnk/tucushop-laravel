@extends('mail._layout')

@section('content-mail')

<p>Estimad{{$info->gender}} {{ $info->user->profile->name }},</p>
<p>Te enviamos este e-mail para que puedas recuperar el acceso a tu cuenta en <b>Tucushop.com</b> Por favor copia el código a continuación, e ingrésalo donde el sistema te lo solicite.</p>
<p>Código de seguridad:</p>
<p class="nw-code">{{ $info->user->recover->code }}</p>
<p>Si tienes alguna duda respecto a este u otros temas de la web, te invitamos a revisar la información disponible en el área de ayuda y soporte de <b>Tucushop.com</b>.</p>
<p>¡Gracias por ser parte de <b>Red Tucushop</b>!</p>

<p><br>--<br>Equipo Tucushop</p>

@endsection