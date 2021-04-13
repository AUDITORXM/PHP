<?php
	if (!strpos($_SERVER['HTTP_REFERER'], 'sesiones/')){

		header('location: index.php');
		exit;

	// } else if (!isset($_POST) || empty($_POST)){
	// 	echo '<h2>Ha habido un error, volviendo al Paso 1</h2>';
	// 	sleep(3);
	// 	header('location: index.php');
	// 	exit;
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("./includes/inc_config.php"); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Formulario: Paso 2</title>
</head>
<body>
	<?php include("./includes/inc_cabecera.php"); ?>

	<?php

		if (isset($_POST)){
			if (empty(trim($_POST['nombre'])) || empty(trim($_POST['pass']))){
				echo '<meta http-equiv="refresh" content="0; URL=index.php">';
				exit;
			}

			$_SESSION['nombre'] = $_POST['nombre'];
			$_SESSION['pass'] = $_POST['pass'];
		}

	?>

	<div class="progress">
		<div class="progress-bar bg-success" role="progressbar" style="width: 66%;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100">2/3</div>
	</div>
	<br>
	<h1>Paso 2</h1>
	<form action="resumen.php" method="post">
		<div class="form-group">
			<label for="direccion" class="form-label">Dirección:</label>
			<input type="text" class="form-control" name="direccion" id="direccion" required="true">
		</div>
		<div class="form-group">
			<label for="postal" class="form-label">Código Postal:</label>
			<input type="text" class="form-control" name="postal" id="postal" required="true">
		</div>
		<div class="buttons text-center">
			<button type="button" class="btn btn-secondary" value="Atras" onclick="history.back()">Atrás</button>
			<button type="reset" class="btn btn-secondary" value="Borrar">Borrar</button>
			<button type="submit" class="btn btn-primary" value="Enviar">Siguiente</button>
		</div>
	</form>

	<?php include("./includes/inc_pie.php"); ?>
</body>
</html>