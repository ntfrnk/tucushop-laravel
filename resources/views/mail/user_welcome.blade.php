@extends('mail._layout')

@section('content-mail')

<p>¡Bienvenid{{$info->gender == 'Masculino' ? 'o' : 'a'}} {{ $info->user->profile->name }}!</p>
<p>Estamos muy felices de que te sumes a la gran familia de <b>Red Tucushop</b>.</p>
<p>Para comenzar a utilizar nuestros servicios te pedimos confirmar tu cuenta haciendo click en el siguiente enlace:</p>
<p>
    <a href="https://moda.tucushop.com/account/confirm/{{ $info->user->remember_token }}">
        <small>https://moda.tucushop.com/account/confirm/{{ substr($info->user->remember_token, 0, 16) }}...</small>
    </a>
</p>
<p>Quedamos a tu entera disposición, y nuevamente: ¡Gracias por ser parte de Tucushop!</p>

<p><br>--<br>Equipo Tucushop</p>

@endsection