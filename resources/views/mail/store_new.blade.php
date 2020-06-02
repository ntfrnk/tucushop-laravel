@extends('mail._layout')

@section('content-mail')

<p>Estimado {{ $user->profile->name}},</p>
<p>Te informamos que «{{ $user->admins->first()->store->name }}» fue creado con éxito en Tucushop.com.</p>
<p>Los datos de tu nuevo negocio son los siguientes:</p>

<div class="nw-box-detail">
<p><b>Nombre:</b><br> {{ $user->admins->first()->store->name }}</p>
<p><b>Usuario:</b><br> {{ '@'.$user->admins->first()->store->alias }} </p>
<p><b>Descripción:</b><br> {{ $user->admins->first()->store->description }}</p>
<p><b>Creado:</b><br> {{ $user->admins->first()->store->created_at }}</p>
</div>

<p>Si tienes alguna duda respecto a este u otros temas de la web, te invitamos a revisar la información disponible en el área de ayuda y soporte de Tucushop.com (https://tucuchop.com/help).</p>
<p>¡Gracias por ser parte de Red Tucushop!</p>

@endsection