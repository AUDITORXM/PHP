<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("./includes/inc_config.php");?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Formulario: Paso 1</title>
</head>
<body>

	<?php include("./includes/inc_cabecera.php"); ?>
	<?php $_SESSION['IP'] = $_SERVER['REMOTE_ADDR']; ?>

	<div class="progress">
		<div class="progress-bar bg-success" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">1/3</div>
	</div>
	<h1>Paso 1</h1>
	<form action="sesion1.php" method="post">
		<div class="form-group">
			<label for="nombre" class="form-label">Nombre:</label>
			<input type="text" class="form-control" name="nombre" id="nombre" required="true">
		</div>
		<div class="form-group">
			<label for="pass" class="form-label">Contraseña:</label>
			<input type="password" class="form-control" name="pass" id="pass" required="true">
		</div>
		<div class="buttons text-center">
			<button type="reset" class="btn btn-secondary" value="Borrar">Borrar</button>
			<button type="submit" class="btn btn-primary" value="Enviar">Siguiente</button>
		</div>
	</form>
	<?php  include("./includes/inc_pie.php"); ?>
</body>
</html>