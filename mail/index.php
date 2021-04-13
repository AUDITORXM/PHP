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

	<h1>Formulario</h1>
	<form action="mandar_correo.php" method="post">
		<div class="form-group">
			<label for="nombre" class="form-label">Nombre:</label>
			<input type="text" class="form-control" name="nombre" id="nombre" required="true">
		</div>
		<div class="form-group">
			<label for="email" class="form-label">Correo:</label>
			<input type="email" class="form-control" name="email" id="email" required="true">
		</div>
		<div class="buttons text-center">
			<button type="reset" class="btn btn-secondary" value="Borrar">Borrar</button>
			<button type="submit" class="btn btn-primary" value="Enviar">Mandar Correo</button>
		</div>
	</form>
	<?php  include("./includes/inc_pie.php"); ?>
</body>
</html>