<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

{{-- CSRF Token --}}

<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Título general de la web --}}

<title>@yield('title') :: {{ config('app.name', 'Laravel') }}</title>

{{-- Tags para SEO --}}

<meta name="title" content="@yield('meta-title')" />
<meta name="keywords" content="@yield('meta-keywords')" />
<meta name="description" content="@yield('meta-description')" />

{{-- Ruta base del sitio --}}

<base href="{{ route('home') }}" />

{{-- Tags sociales --}}

<meta property="fb:app_id" content="541723052872159" />
<meta property="og:url" content="@yield('meta-url')" />
<meta property="og:type" content="article" />
<meta property="og:title" content="@yield('meta-title')" />
<meta property="og:description" content="@yield('meta-description')" />
<meta property="og:image" content="@yield('meta-image')" />

<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="@yield('meta-title')" />
<meta name="twitter:description" content="@yield('meta-description')" />
<meta name="twitter:url" content="@yield('meta-url')" />
<meta name="twitter:image" content="@yield('meta-image')" />

{{-- Estilos para plugins --}}

<link href="{{ asset('plugins/OwlCarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/OwlCarousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/font-awesome/css/all.css') }}" rel="stylesheet">

{{-- Estilos CSS --}}

<link href="{{ asset('styles/app.css') }}" rel="stylesheet">
<link href="{{ asset('styles/tshop.base.css') }}" rel="stylesheet">
<link href="{{ asset('styles/tshop.layouts.css') }}" rel="stylesheet">
<link href="{{ asset('styles/tshop.theme.css') }}" rel="stylesheet">
<link href="{{ asset('styles/tshop.modules.css') }}" rel="stylesheet">
<link href="{{ asset('styles/tshop.responsive.css') }}" rel="stylesheet">
<link href="{{ asset('styles/tshop.helpers.css') }}" rel="stylesheet">

{{-- Icono --}}

<link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" type="image/x-icon">
<link href="{{ asset('images/favicon.png') }}" rel="icon" type="image/x-icon">

{{-- Tipografías Laravel --}}

<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">