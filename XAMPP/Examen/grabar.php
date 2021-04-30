<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../../vendor/autoload.php';
// include('usuariosconfig.php');
include('includes/inc_config.php');
include('includes/inc_cabecera.php');

$id=0;
$errores = array();
$accion = $_REQUEST['accion'];

if (isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
}

include("conexion.php");
if ($accion == 'Insertar'){
	$errores = validar($mbd);
}

if (count($errores) == 0) {

	$nombre = $_REQUEST['nombre'];
	$apellido = $_REQUEST['apellido'];
	$usuario = $_REQUEST['usuario'];
	$correo = $_REQUEST['correo'];
	$password = $_REQUEST['password'];
	$fecha_nac = $_REQUEST['fecha_nac'];
	$telefono = $_REQUEST['telefono'];
	$genero = $_REQUEST['genero'];

	// $query = 'INSERT INTO usuarios (Nombre, Apellido, Usuario, Correo, Password, Fecha_nac, Telefono, Genero, Token, Fecha_Token) VALUES (:nombre, :apellidos, :usuario, :correo, :password, :fecha_nac, :telefono, :genero, :token, :fecha_token)';

	try {
		if ($accion == 'Insertar') {
			$query = 'INSERT INTO usuarios (Nombre, Apellido, Usuario, Correo, Password, Fecha_nac, Telefono, Genero, Token, Fecha_Token) VALUES (:nombre, :apellido, :usuario, :correo, :password, :fecha_nac, :telefono, :genero, :token, :fecha_token)';
		} else {
			$query = 'UPDATE usuarios SET Nombre=:nombre, Apellido=:apellido, Usuario=:usuario, Correo=:correo, Password=:password, Fecha_nac=:fecha_nac, Telefono=:telefono, Genero=:genero WHERE id=:id';
		}

		$resultado = $mbd->prepare($query);

		$resultado -> bindValue(":nombre", $nombre);
		$resultado -> bindValue(":apellido", $apellido);
		$resultado -> bindValue(":usuario",$usuario);
		$resultado -> bindValue(":correo", $correo);
		$resultado -> bindValue(":password", md5($password));
		$resultado -> bindValue(":fecha_nac", $fecha_nac);
		$resultado -> bindValue(":telefono", $telefono);
		$resultado -> bindValue(":genero", $genero);

		if ($accion == 'Insertar') {
			$token = bin2hex(random_bytes(32));
			$resultado -> bindValue(":token", $token);
			$resultado -> bindValue(":fecha_token", date("Y-m-d"));   
		} else {
			$resultado ->bindvalue(":id",$id);
		}

		if ($exec = $resultado -> execute() && $accion == 'Insertar'){
			$query = "SELECT MAX(ID) as ID FROM usuarios";

			foreach($mbd->query($query) as $fila){
				if (isset($fila)){
					$id = $fila['ID'];
				}
			}

			mandarCorreo($correo, $nombre, $apellido, $token, $id);
		}

		$mbd = null; // cerrar conexion

	} catch (PDOException $e) {
		print "¡ERROR!: " . $e->getMessage() . "<br/>";
		die();
	}

} else {

	foreach ($errores as $error) {
		echo "<script>alert('ERROR: " . $error . "');</script>";
	}

}

function mandarCorreo($correo, $nombre, $apellido, $token, $id){

	$url = "http://212.142.193.210:16001/kevin/Examen/registrado.php?token=" . $token . "&id=" . $id;

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
	} else {
		echo "<p>Se ha enviado un email a su correo para activar la cuenta</p>";
	}

}

function validar($mbd) {
	$fecha = date("Y-m-d");
	$errores = array();

	// ----- Validar correo -----
	if (filter_var($_REQUEST['correo'], FILTER_VALIDATE_EMAIL) === false) {
		array_push($errores, "El correo no es un correo válido");
	}

	// ----- Validar si usuario existe -----
	$query = "SELECT * FROM usuarios WHERE Correo = '" . $_REQUEST['correo'] . "'";

	foreach($mbd->query($query) as $fila){
		if (isset($fila)){
			array_push($errores, "Usuario ya existe");
		}
	}

	// ----- Validar contraseña -----
	if (empty($_REQUEST['password'])){
		array_push($errores, "La contraseña no puede ser vacía");
	}

	// ----- Validar nombre -----
	if (preg_match('~[0-9]+~', $_REQUEST['nombre'])) {
		array_push($errores, "El nombre no puede tener números");
	}

	// ----- Validar apellido -----
	if (preg_match('~[0-9]+~', $_REQUEST['apellido'])) {
		array_push($errores, "El apellido no puede tener números");
	}

	// ----- Validar fecha de nacimiento -----
	if ($_REQUEST['fecha_nac'] >= $fecha) {
		array_push($errores, "La fecha de nacimiento no puede ser igual o mayor al actual");
	}

	// ----- Validar teléfono -----
	if (filter_var($_REQUEST['telefono'], FILTER_SANITIZE_NUMBER_INT) === false || strlen($_REQUEST['telefono']) != 9) {
		array_push($errores, "El teléfono es incorrecto");
	}

	return $errores;

}
?>

<button class="btn btn-success" onclick="location.href = 'insertar.php';">Volver al formulario</button>
<button class="btn btn-success" onclick="location.href = 'index.php';">Ver usuarios</button>

<?php include('includes/inc_pie.php');?>
