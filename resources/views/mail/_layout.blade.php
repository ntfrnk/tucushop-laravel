<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>{{ $info->subject }}</title>
		<style>
			b{font-weight:500;color:#333}.nw-contenedor{background:#E5E5E5;width:auto;padding:40px 0 40px;}.nw-cabecera{padding:10px 40px 30px}.nw-cabecera img{width:300px}.nw-cuerpo{border-top:solid 5px #d90046;border-bottom:solid 5px #d90046;margin:0px auto;width:600px;padding:40px 0 0;background:#fff}.nw-texto{color:#676767;margin:0 50px 50px}.nw-texto p{font-family:Raleway;font-size:16px;line-height:22px;margin-bottom:16px}.nw-texto p blockquote{font-family:Raleway;font-size:16px;line-height:22px;margin-bottom:16px}.nw-texto a{color:rgba(70,180,176,1)}.nw-texto a:hover{color:#555}.nw-footer{background:#AAA;color:#FFF;font-family:Raleway;font-size:13px;padding:40px 40px;margin: 0 0 0;line-height:20px}.nw-footer a{margin:0px auto 40px;width:600px;color:#000;text-decoration:underline}.nw-footer a:hover{text-decoration:underline}.nw-box-detail{background:#f4f4f4;border:solid 1px #ccc;padding:20px;margin:10px 0}.nw-code{padding:25px 0;text-align:center;background:#F4F4F4;border:solid 1px #CCC;color:#777;font-size:40px !important;font-family:"Courier New";line-height:30px;margin:0px;}
		</style>
	</head>
	
	<body>
		<div class="nw-contenedor">

			<div class="nw-cuerpo">

				<div class="nw-cabecera">
					<a href="{{ route('home') }}">
						<img src="{{ asset(route('home').'/images/logo-mail.png') }}" />
					</a>
				</div>
				
				<div class="nw-texto">
					
					@yield('content-mail')

				</div>

				<div class="nw-footer">
					Este e-mail fue generado automáticamente desde la web de <b>Red Tucushop</b>. 
					Si tenes alguna duda o necesitas ayuda puedes comunicarte con nosotros en 
					<a href="{{ route('home') }}">www.tucushop.com</a>.
				</div>

			</div>

		</div>
	</body>
</html>