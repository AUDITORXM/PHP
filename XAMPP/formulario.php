<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("./includes/inc_config.php"); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Formulario</title>
</head>
<body>
	<?php include("./includes/inc_cabecera.php"); ?>
	<h1>Formulario</h1>

	<?php

		$nombreError = $emailError = $tfnoError = "";
		$nombre = $email = $tfno = "";

		if ($_SERVER['REQUEST_METHOD'] == 'POST'){

			$verformulario = 'NO';
			$nombre = $_POST['nombre'];
			$email = $_POST['email'];

			if (empty($nombre)){
				$nombreError = "Nombre Vacío";
				$verformulario = "SI";
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailError="Email Incorrecto";
				$verformulario='SI';
			}

			$tfno = str_replace("-", "", filter_var($tfno, FILTER_SANITIZE_NUMBER_INT));

			if (strlen($tfno) != 9){
				$tfnoError="Teléfono Incorrecto";
				$verformulario='SI';
			}

		} else {

			$verformulario='SI';

		}

		if ($verformulario=='SI'){ ?>

			<form action="" method="post">
				<div class="form-group">
					<label for="nombre" class="form-label">Nombre:</label>
					<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre;?>">
					<?php echo $nombreError;?>
				</div>
				<div class="form-group">
					<label for="email" class="form-label">Email:</label>
					<input type="email" class="form-control" name="email" id="email" value="<?php echo $email;?>">
					<?php echo $emailError;?>
				</div>
				<div class="form-group">
					<label for="email" class="form-label">Teléfono:</label>
					<input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $tfno;?>">
					<?php echo $tfnoError;?>
				</div>
				<button type="submit" class="btn btn-primary" value="Enviar">Enviar</button>
				<button type="reset" class="btn btn-secondary" value="Borrar">Borrar</button>
			</form>

		<?php
		} else {

			echo "<p>Información enviada correctamente</p>";

		}

	?>

	<?php include("./includes/inc_pie.php"); ?>
</body>
</html>