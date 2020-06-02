<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<style>
			.nw-cabecera {padding: 30px 40px; background: #d90046;}
			.nw-cabecera img {width: 300px;}
			.nw-contenedor {width: 800px; padding: 0; margin: 0;}
			.nw-texto {color: #676767; margin: 0 50px;}
			.nw-texto p {font-family: Raleway; font-size: 16px; line-height: 22px; margin-bottom: 16px;}
			.nw-texto p blockquote {font-family: Raleway; font-size: 16px; line-height: 22px; margin-bottom: 16px;}
			.nw-texto a {color: rgba(70, 180, 176, 1);}
			.nw-texto a:hover {color: #555;}
			.nw-cuerpo {padding: 60px 20px;}
			.nw-footer {background: #222; color: #999; font-family: Raleway; font-size: 13px; padding: 40px 40px; line-height: 20px;}
			.nw-footer a {color: rgba(70, 180, 176, 1); text-decoration: none;}
			.nw-footer a:hover {text-decoration: underline;}
			.nw-box-detail {background: #F4F4F4; border: solid 1px #CCC; padding: 20px; margin: 10px 0;}
		</style>
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