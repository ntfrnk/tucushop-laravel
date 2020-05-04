<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

	@include('layouts.includes.head')

</head>


<body>
	<div id="app">

		@include('layouts.includes.header')

		<main>
			@yield('content')
		</main>

	</div>

	@include('layouts.includes.footer')
	@include('layouts.includes.data')
	@include('layouts.includes.scripts')

</body>
</html>
