@extends('mail._layout')

@section('content-mail')

<p>Estimad{{$info->store->admins->first()->user->profile->gender == 'Masculino' ? 'o' : 'a'}} {{ $info->store->admins->first()->user->profile->name }},</p>
<p>Te informamos que «{{ $info->store->name }}» fue creado con éxito en <b>Tucushop.com</b>.</p>
<p>Los datos de tu nuevo negocio son los siguientes:</p>

<div class="nw-box-detail">
<p><b>Nombre:</b><br> {{ $info->store->name }}</p>
<p><b>Usuario:</b><br> {{ '@'.$info->store->alias }} </p>
<p><b>Descripción:</b><br> {{ $info->store->description }}</p>
<p><b>Creado:</b><br> {{ $info->store->created_at }}</p>
</div>

<p>Si tienes alguna duda respecto a este u otros temas de la web, te invitamos a revisar la información disponible en el área de ayuda y soporte de <b>Tucushop.com</b>.</p>
<p>¡Gracias por ser parte de <b>Red Tucushop</b>!</p>

<p><br>--<br>Equipo Tucushop</p>

@endsection