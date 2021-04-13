<?php
	$para = 'kblancocampandegui@gmail.com';
	$titulo = 'Prueba Mail 01';
    // Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

	// Cabeceras adicionales
	$cabeceras .= 'From: kblancocampandegui@gmail.com \r\n';
	$cabeceras .= 'X-Mailer: PHP' . phpversion() . "\r\n";
	// $correofrom puede estar definido en el include config.php
	// Mensaje en código HTML
	$mensaje = '
	<html>
		<head>
			<title>Correo enviado mediante la orden mail</title>
		</head>
		<body>
			<p>Confirmamos su solicitud</p>
		</body>
	</html>
	';
?>