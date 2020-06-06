@extends('mail._layout')

@section('content-mail')

<p>Estimad{{$info->user->profile->gender == 'Masculino' ? 'o' : 'a'}} {{$info->user->profile->name}},</p>
<p>Te informamos que tu contraseña de acceso a <b>Tucushop.com</b> fue modificada con éxito. Desde ahora podrás acceder al sitio con este nuevo dato.</p>
<p>Si tienes alguna duda respecto a este u otros temas de la web, te invitamos a revisar la información disponible en el área de ayuda y soporte de <b>Tucushop.com</b>.</p>
<p>¡Gracias por ser parte de <b>Red Tucushop</b>!</p>

<p><br>--<br>Equipo Tucushop</p>

@endsection