<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link href="{{ asset('styles/tshop.mails.css') }}" rel="stylesheet">
	</head>
	
	<body>
		<div class="nw-contenedor">
			<div class="nw-cabecera">
				<a href="">
					<img src="{{ asset('/images/logo.png') }}" />
				</a>
			</div>
			<div class="nw-cuerpo">
				
				<div class="nw-texto">
					
					@yield('content-mail')

				</div>

			</div>
			<div class="nw-footer">
				Este e-mail fue generado automáticamente desde la web de <b>Red Tucushop</b>. 
                Si tenes alguna duda o necesitas ayuda puedes comunicarte con nosotros en 
                <a href="{{ route('home') }}">www.tucushop.com</a>.
			</div>
		</div>
	</body>
</html>