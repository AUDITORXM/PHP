<?php
	if (!strpos($_SERVER['HTTP_REFERER'], 'sesiones/sesion1.php')){

		header('location: index.php');
		exit;

	} else if (!isset($_POST) || empty($_POST)){
		echo '<h2>Ha habido un error, volviendo al Paso 1</h2>';
		sleep(3);
		header('location: index.php');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("./includes/inc_config.php"); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Formulario: Resumen</title>
</head>
<body>
	<?php include("./includes/inc_cabecera.php"); ?>

	<?php

		if (isset($_POST)){
			if (empty(trim($_POST['direccion'])) || empty(trim($_POST['postal']))){
				echo '<meta http-equiv="refresh" content="0; URL=index.php">';
				exit;
			}

			$_SESSION['direccion'] = $_POST['direccion'];
			$_SESSION['postal'] = $_POST['postal'];
		}

	?>

	<div class="progress">
		<div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">3/3</div>
	</div>
	<br>
	<h1>Resumen de los Datos</h1>

	<?php
		echo '<p>IP: ' . $_SESSION['IP'] . '</p>';
		echo '<p>Nombre: ' . $_SESSION['nombre'] . '</p>';
		echo '<p>Contraseña: ' . $_SESSION['pass'] . '</p>';
		echo '<p>Dirección: ' . $_SESSION['direccion'] . '</p>';
		echo '<p>Código Postal: ' . $_SESSION['postal'] . '</p>';
	?>

	<div class="buttons text-center">
		<button type="button" class="btn btn-secondary" value="Atras" onclick="location.href='index.php';">Cambiar Datos</button>
		<button type="button" class="btn btn-primary" id="confirmar" value="confirmar">Confirmar</button>
	</div>

	<?php include("./includes/inc_pie.php"); ?>
</body>
</html>