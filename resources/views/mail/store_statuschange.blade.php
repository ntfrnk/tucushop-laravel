@extends('mail._layout')

@section('content-mail')

<p>Estimad{{$info->gender}} {{$info->store->admins->first()->user->profile->name}},</p>

@if($info->store->status == '1')
    <p>Te informamos que el negocio «{{$info->store->name}}» se habilitó correctamente en <b>Tucushop.com</b>.</p>
    <p>Para gestionar todos los aspectos de tu negocio puedes acceder desde tu cuenta a "Mis negocios" > "{{$info->store->name}}".</p>
@else
    <p>Te informamos que el negocio «{{$info->store->name}}» fue deshabilitado correctamente en <b>Tucushop.com</b>.</p>
    <p>Mientras el negocio permanezca deshabilitado los artículos que publicaste no podrán ser vistos en la web, ni los administradores (excepto vos) podrán acceder al área de gestión hasta que vuelvas a habilitarlo.</p>
@endif

<p>Si tienes alguna duda respecto a este u otros temas de la web, te invitamos a revisar la información disponible en el área de ayuda y soporte de <b>Tucushop.com</b>.</p>
<p>¡Gracias por ser parte de <b>Tucushop.com</b>!</p>

<p><br>--<br>Equipo Tucushop</p>

@endsection