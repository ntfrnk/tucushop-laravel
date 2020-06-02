@extends('mail._layout')

@section('content-mail')

<p>¡Bienvenida {{ $info->user->profile->name }}!</p>
<p>Estamos muy felices de que te sumes a la gran familia de <b>Red Tucushop</b>.</p>
<p>Para comenzar a utilizar nuestros servicios te pedimos confirmar tu cuenta haciendo click en el siguiente enlace:</p>
<p>https://www.tucushop.com/</p>
<p>Quedamos a tu entera disposición, y nuevamente:</p>
<p>¡Gracias por ser parte de Tucushop!</p>

<p><br>--<br>{{ $info->sender }}</p>

@endsection