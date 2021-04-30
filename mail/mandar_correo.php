<?php
	use PHPMailer\PHPMailer\PHPMailer;
	require '../../vendor/autoload.php';

	// if ($_SERVER['REQUEST_METHOD'] == $_POST){
	if (isset($_POST)){
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
		$mail->addAddress($_POST['email'], $_POST['nombre']);
		// $mail->addAddress('albertomozodocente@gmail.com', 'Alberto Mozo');
		$mail->Subject = 'Respuesta Formulario';
		// $mensaje = 'Hola que tal';
		// $mail->msgHTML($mensaje);
		$mail->Body = 'Estimad@ ' . $_POST['nombre'] . ', hemos recibido su solicitud de información, muchas gracias.';

		//$mail->addAttachment('test.txt');
		if (!$mail->send()) {
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Mail enviado con éxito.';
		}
	} else {
		header("Location: index.php");
	}

?>
