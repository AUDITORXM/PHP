<?php
include('includes/inc_config.php');
include('includes/inc_cabecera.php');
include('includes/db.php');
$mensajeError = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$correo = $_POST['email'];
	$pass = $_POST['password'];
	$errores = array();
	$coincide = FALSE;

	// ----- Validar correo -----
	if (filter_var($correo, FILTER_VALIDATE_EMAIL) === false) {
		array_push($errores, "El correo no es un correo válido");
	}

	// ----- Validar si el usuario y contraseña son correctos -----
	$query = "SELECT * FROM usuarios WHERE Correo = '" . $correo . "' AND password = '" . md5($pass) . "'";

	foreach ($con->query($query) as $fila) {
		$coincide = TRUE;
	}
	if (!$coincide) {
		array_push($errores, "El usuario no coincide con la contraseña");
	}

	if(count($errores) == 0) {
		$_SESSION['logeado'] = TRUE;
		echo '<script>window.location.replace("index.php");</script>';
	} else {
		foreach ($errores as $error) {
			$mensajeError = $error . "\n";
		};
	}
} else if (isset($_SESSION['logeado']) && $_SESSION['logeado'] == TRUE) {

	session_destroy();
	echo '<script>window.location.replace("index.php");</script>';

}
?>

<h2 class="bg-success text-center">Iniciar Sesión</h2>

<form class="px-4 py-3" action="" method="POST">
	<div class="mb-3">
		<label for="email" class="form-label">Correo:</label>
		<input type="email" class="form-control" name="email" id="email" placeholder="email@ejemplo.com">
	</div>
	<div class="mb-3">
		<label for="password" class="form-label">Contraseña:</label>
		<input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
	</div>
	<button type="submit" class="btn btn-primary">Iniciar Sesión</button>
</form>

<?php echo $mensajeError;?>

<?php include('includes/inc_pie.php');?>