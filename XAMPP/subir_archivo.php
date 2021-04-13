<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("./includes/inc_config.php"); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Subir Archivos</title>
</head>
<body>
	<?php include("./includes/inc_cabecera.php"); ?>
	<h1>Subir Archivos</h1>

	<?php

		$errorTamano = $errorTipo = $verForm = '';
		$errorArchivo = array(
			0 => 'Archivo subido con éxito.',
			1 => 'Tamaño del archivo excede el tamaño permitido.',
			2 => 'Tamaño del archivo excede el tamaño permitido.',
			3 => 'El archivo no se subió por completo.',
			4 => 'No se subió ningún archivo.',
			6 => 'Archivo temporal no existe.',
			7 => 'Fallo al escribir al disco.',
			8 => 'Extensión PHP impidió la subida del archivo.',
		);

		if ($_SERVER['REQUEST_METHOD'] == 'POST'){

			$dir_subida = 'C:\XAMPP\htdocs\ficheros';
			$tipos_fichero = [
				"application/pdf", //PDF
				"application/msword", //DOC
				"application/vnd.openxmlformatsofficedocument.wordprocessingml.document", //DOCX
				"application/vnd.oasis.opendocument.text", //ODT
				"application/vnd.oasis.opendocument.formula", //ODF
				"image/png", //PNG
				"image/jpeg" //JPG
			];

			if (!in_array($_FILES['fichero_usuario']['type'], $tipos_fichero)){
				$errorTipo = 'El tipo de fichero no es válido';
			}

			if ($_FILES['fichero_usuario']['size'] > 20971520){
				$errorTamano = 'El archivo es demasiado grande';
			}

			print_r($errorTipo);
			print_r($errorTamano);

			if ($errorTipo == '' && $errorTamano == ''){

				if (!is_dir($dir_subida)){
					mkdir($dir_subida);
				}

				foreach ($lista_nombres as $ip => $nombre) {

					if ($_SERVER['REMOTE_ADDR'] == $ip) {

						$_FILES['fichero_usuario']['name'] = $nombre . '_' . $_FILES['fichero_usuario']['name'];

					}

				}

				$_FILES['fichero_usuario']['name'] = str_replace('.', '_' . time() . '.', $_FILES['fichero_usuario']['name']);

				$dir_subida .= basename($_FILES['fichero_usuario']['name']); // "./img/Penguins.jpg"

				// var_dump($_FILES); array(5) { ["name"]=> string(12) "Penguins.jpg" ["type"]=> string(10) "image/jpeg" ["tmp_name"]=> string(24) "C:\xampp\tmp\php64AD.tmp" ["error"]=> int(0) ["size"]=> int(777835) } }

				$mensajeError = '';

				if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $dir_subida)) {

					echo "El fichero es válido y se subió con éxito.";

				} else {

					if ($_FILES['fichero_usuario']['error'] > 0){

						foreach ($errorArchivo as $numError => $valorError) {

							if ($_FILES['fichero_usuario']['error'] == $numError){

								$mensajeError = 'ERROR: ' . $valorError;

							}
						}
					}
				}

			} else {

				$verForm = 'S';

			}

		} else {

			$verForm = 'S';

		}

		if ($verForm == 'S'){ ?>

	<form enctype="multipart/form-data" action="" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="20971520" /> <!-- 20 MB en Bytes -->
		<label for="fichero_usuario">Enviar este fichero:</label>
		<input name="fichero_usuario" type="file" id="fichero_usuario" />
		<br>
		<?php echo $mensajeError; ?>
		<br>
		<input type="submit" value="Enviar fichero" />
	</form>

		<?php } ?>

	<?php include("./includes/inc_pie.php"); ?>
</body>
</html>