<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

	@include('layouts.parts.head')

</head>


<body>
	<div id="app">

		@include('layouts.parts.header')

		<main>
			@yield('content')
		</main>

	</div>

	@include('layouts.parts.footer')

	@include('layouts.parts.scripts')

</body>
</html>
