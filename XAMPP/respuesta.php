<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("./includes/inc_config.php"); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Respuesta</title>
</head>
<body>
	<?php include("./includes/inc_cabecera.php"); ?>
	<h1>Contacto</h1>
	<?php

	$nombre = $correo = $nacido = $sexo = $observaciones = $trabajo = "";
	$conocimientos = array();

	if (isset($_POST['nombre'])){ $nombre = $_POST['nombre']; }
	if (isset($_POST['correo'])){ $correo = $_POST['correo']; }
	if (isset($_POST['nacido'])){ $nacido = $_POST['nacido']; }
	if (isset($_POST['hm'])){
		if (strcmp($_POST['hm'], "h")) {
			$sexo = "hombre";
		} else {
			$sexo = "mujer";
		}		
	}

	if (isset($_POST['html'])){ array_push($conocimientos, $_POST['html']); }
	if (isset($_POST['css'])){ array_push($conocimientos, $_POST['css']); }
	if (isset($_POST['js'])){ array_push($conocimientos, $_POST['js']); }
	if (isset($_POST['php'])){ array_push($conocimientos, $_POST['php']); }
	if (isset($_POST['observacion'])){ $observaciones = $_POST['observacion']; }

	if (in_array('html', $conocimientos) && in_array('css', $conocimientos) && in_array('js', $conocimientos) && in_array('php', $conocimientos)) {
		$trabajo = "Full Stack";
	} else if (!in_array('php', $conocimientos) && (in_array('html', $conocimientos) || in_array('css', $conocimientos) || in_array('js', $conocimientos))) {
		$trabajo = "diseñador";
	} else if ((!in_array('html', $conocimientos) && !in_array('css', $conocimientos) && !in_array('js', $conocimientos)) && in_array('php', $conocimientos)){
		$trabajo = "programador";
	} else {
		$trabajo = "nada, porque no vales para nada.";
	}

	if (isset($trabajo)){

		if (strcmp($sexo, "hombre")) {
			$mensaje = "Estimado $nombre";
		} else {
			$mensaje = "Estimada $nombre";
		}

		$mensaje .= ": <br> Tomamos nota de su solicitud de trabajo para $trabajo <br> Enviaremos las novedades al correo $correo que nos ha suministrado. <br> Saludos, <br> Dpto atención cliente";

	}

	mail($dir_correo, "Empleo", $mensaje);

	echo $mensaje;

	include("./includes/inc_pie.php"); ?>
</body>
</html>