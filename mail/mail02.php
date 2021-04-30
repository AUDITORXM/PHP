<?php
	use PHPMailer\PHPMailer\PHPMailer;
	require '../../vendor/autoload.php';
	$mensaje = 'Hola que tal';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 2;
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = 'kblancocampandegui@gmail.com';
	$mail->Password = '***';
	$mail->setFrom('kblancocampandegui@gmail.com', 'Kevin Blanco');
	$mail->addReplyTo('kblancocampandegui@gmail.com', 'Kevin Blanco');
	$mail->addAddress('kblancocampandegui@gmail.com', 'Kevin Blanco');
	// $mail->addAddress('albertomozodocente@gmail.com', 'Alberto Mozo');
	$mail->Subject = 'Prueba Mail02';
	$mail->msgHTML($mensaje);
	$mail->Body = '
	<html>
		<head>
			<title>Correo enviado mediante la orden mail</title>
		</head>
		<body>
			<p>Confirmamos su solicitud</p>
		</body>
	</html>
	';

	//$mail->addAttachment('test.txt');
	if (!$mail->send()) {
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Mail enviado con éxito.';
	}
?>
