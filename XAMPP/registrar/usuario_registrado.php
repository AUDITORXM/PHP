<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../../vendor/autoload.php';
include('db.php');
include('includes/inc_config.php');
include('includes/inc_cabecera.php');

if ($_SERVER['REQUEST_METHOD'] == "POST"){

	// ----- Validar vacíos -----
	$vacio = "";

	foreach ($_POST as $campo => $valor) {
		if (isset($campo)){
			$vacio = "Falta por rellenar '" . $campo . "'";
		}
	}

	if (empty($vacio)){

		echo $vacio;

	} else {

		$correo = $_POST["correo"];
		$pass1 = $_POST["password_1"];
		$pass2 = $_POST["password_2"];
		$nombre = $_POST["nombre"];
		$apellido = $_POST["apellido"];
		$usuario = $_POST["usuario"];
		$fecha_nac = date("Y-m-d", strtotime($_POST["fecha_nac"]));
		$telefono = $_POST["telefono"];
		$genero = $_POST["genero"];
		$fecha = date("Y-m-d");
		$errores = array();

		// ----- Validar correo -----
		if (filter_var($correo, FILTER_VALIDATE_EMAIL) === false) {
			array_push($errores, "El correo no es un correo válido");
		}

		// ----- Validar si usuario existe -----
		$query = "SELECT * FROM usuarios WHERE Correo = '" . $correo . "'";

		if ($resultado = $conn->query($query)){
			while ($obj = $resultado->fetch_assoc()) {
				array_push($errores, "Usuario ya existe");
			}
			$resultado->close();
		}

		// ----- Validar contraseñas -----
		if ($pass1 != $pass2){
			array_push($errores, "Las contraseñas introducidas son diferentes");
		}

		// ----- Validar nombre -----
		if (preg_match('~[0-9]+~', $nombre)) {
			array_push($errores, "El nombre no puede tener números");
		}

		// ----- Validar apellido -----
		if (preg_match('~[0-9]+~', $apellido)) {
			array_push($errores, "El apellido no puede tener números");
		}

		// ----- Validar fecha de nacimiento -----
		if ($fecha_nac >= $fecha) {
			array_push($errores, "La fecha de nacimiento no puede ser igual o mayor al actual");
		}

		// ----- Validar teléfono -----
		if (filter_var($telefono, FILTER_SANITIZE_NUMBER_INT) === false || strlen($telefono) != 9) {
			array_push($errores, "El teléfono es incorrecto");
		}

		if (count($errores) == 0) {

			$pass1 = md5($pass1);

			$token = bin2hex(random_bytes(32));

			$query = "INSERT INTO usuarios (Nombre, Apellido, Usuario, Correo, Password, Fecha_nac, Telefono, Genero, Token, Fecha_Token) VALUES ('" . $nombre . "', '" . $apellido . "', '" . $usuario . "', '" . $correo . "', '" . $pass1 .
				"', '" . $fecha_nac . "', '" . $telefono . "', '" . $genero . "', '" . $token . "', '" . date("Y-m-d") . "')";

			if ($conn->query($query) === TRUE) {
				echo "<h1>Usuario creado con éxito</h1><p>Por favor, compruebe su correo para activar la cuenta</p>";

				$query = "SELECT ID FROM usuarios WHERE Correo = '" . $correo . "' AND Password = '" . $pass1 . "'";

				$resultado = $conn->query($query);

				if ($resultado = $conn->query($query)){
					while ($obj = $resultado->fetch_assoc()) {
						$id = $obj["ID"];
					}
					$resultado->close();
				}

				mandarCorreo($correo, $nombre, $apellido, $token, $id);
			} else {
				echo "Error:" . $query . "<br>" . $conn->error;
			}

		} else {

			foreach ($errores as $error) {
				echo "ERROR: " . $error . " <br>";
			}

			echo "<button class='btn btn-success' onclick=" . "location.href = 'index.php';" . ">Crear otra cuenta</button>";

		}
	}
}

function mandarCorreo($correo, $nombre, $apellido, $token, $id){

	$url = "http://212.142.193.210:16001/kevin/registro/usuario_confirmado.php?token=" . $token . "&id=" . $id;

	$mail = new PHPMailer;
	$mail->isSMTP();
	// $mail->SMTPDebug = 2;
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = 'kblancocampandegui@gmail.com';
	$mail->Password = '***';
	$mail->setFrom('kblancocampandegui@gmail.com', 'Kevin Blanco');
	$mail->addAddress($correo, $nombre . " " . $apellido);
	$mail->Subject = 'Activar Cuenta';
	$mensaje = "<h1>Estimad@ " . $nombre . ",</h1><br><p>Por favor, acceda al siguiente enlace para activar su cuenta: </p>
				<a href='". $url . "'>" . $url . "</a>";
	$mail->msgHTML($mensaje);
	// $mail->Body = $mensaje;

	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo . "<br>
		<button class='btn btn-success' onclick=" . "location.href = 'index.php';" . ">Crear otra cuenta</button>";
	}

}

include('includes/inc_pie.php')
?>
