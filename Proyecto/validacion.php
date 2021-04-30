<?php
if (!$logeado) {
	header('Location: index.php');
}

$errores = array();

if (count($_POST) <> 6) { // Pongo 6 porque siempre se deberán rellenar 6 campos
	array_push($errores, 'Faltan datos por rellenar');
}

// ----- SI NO HAY VACÍOS -----
if (count($errores) == 0) {

	$accion = $_POST['accion'];
	$titulo = $_POST['titulo'];

	if (isset($_POST['id_pelicula'])) {
		$id_pelicula = $_POST['id_pelicula'];
	}

	if (!$id_tmdb = getIdPelicula($titulo, $token)) {
		array_push($errores, 'No existe ninguna película con ese nombre');
	}

	$fecha_estreno = $_POST['fecha_estreno'];
	$array_generos = array();

	if ($_POST['duracion'] >= 60 && $_POST['duracion'] <= 200) {
		$duracion = $_POST['duracion'];
	} else {
		array_push($errores, 'La duración puede ser menor de 60 minutos o mayor de 200 minutos');
	}

	if ($_POST['activo'] == "s") {
		$activo = 1;
	} else {
		$activo = 0;
	}

	foreach ($_POST['genero'] as $genero => $id) {
		array_push($array_generos, $id);
	}

	$imagen_editada = TRUE;

	if (isset($id_pelicula)) {

		$query = 'SELECT imagen FROM Peliculas WHERE id = ' . $_POST['id_pelicula'];

		foreach ($con->query($query) as $fila) {
			if (strcmp($fila['imagen'], $_POST['imagen'] == 0)) {
				$imagen_editada = FALSE;
				$imagen = $fila['imagen'];
			}
		}

	}

	// ----- VALIDACIONES PARA LA IMAGEN -----
	if ($imagen_editada && isset($_FILES)) {

		$archivo = 'img/' . basename($_FILES['imagen']['name']);
		$extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

		// ----- Validar Extensión -----
		if ($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
			array_push($errores, 'El fichero no es una imagen');
		}

		// ----- Validar si existe -----
		if (file_exists($archivo)) {
			array_push($errores, 'La imagen ya existe');
		}

		// ----- Validar Extensión -----
		if ($_FILES["imagen"]["size"] > 20971520) {
			array_push($errores, 'La imagen no puede pesar más de 20MB');
		}

		// ----- SI LA IMAGEN ES VÁLIDA -----
		if (count($errores) == 0) {
			$imagen = $archivo . '.' . $extension;
		}
	}

	// ----- INSERCIÓN DE DATOS SI TODO ESTÁ BIEN -----
	if (count($errores) == 0) {

		if ($accion == "Editar") {
			$query = 'UPDATE Peliculas SET id_tmdb = ' . $id_tmdb . ',
					titulo = "' . $titulo . '",
					fecha_estreno = "' . $fecha_estreno . '",
					duracion = ' . $duracion . ',
					activo = ' . $activo . ',
					imagen = ' . $imagen . ' WHERE Peliculas.id = ' . $id_pelicula;
		} else {
			$query = 'INSERT INTO Peliculas (id_tmdb, titulo, fech_estreno, duracion, activo, imagen)
						VALUES (' . $id_tmdb . ', "' . $titulo . '", "' . $fecha_estreno . '", ' . $duracion . ', ' . $activo . ', '
						. $imagen . ')';
		}

		if ($con->query($query) === TRUE) {

			if (!isset($id_pelicula)) {
				// ----- COGEMOS LA ÚLTIMA PELÍCULA INSERTADA (CUANDO ES INSERTAR) -----
				$query = "SELECT MAX(id) as id FROM Peliculas";

				foreach ($con->query($query) as $fila) {
					$id_pelicula = $fila["id"];
				}
			}

			// ----- DELETE PARA RESETEAR LOS GÉNEROS DE LA PELÍCULA (QUE NO QUEDEN LOS ANTERIORES) -----
			$query = 'DELETE * FROM Pelis_Generos WHERE pelicula = ' . $id_pelicula;

			if ($con->query($query) === TRUE) {
				// ----- AHORA INSERTAMOS LOS GÉNEROS CORRESPONDIENTES A LA PELÍCULA -----
				foreach ($array_generos as $genero) {
					$query = 'INSERT INTO Pelis_Generos VALUES (' . $id_pelicula . ', ' . $genero . ')';

					if (!$con->query($query) === TRUE) {
						array_push($errores, 'Error al insertar el género ' . $genero);
					}
				}
			}

		} else {
			array_push($errores, 'Error en la Base de Datos');
		}

		if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivo)) {
			array_push($errores, 'No se ha podido subir la imagen');
		}

		// ----- REDIRECCIÓN SI TODO SE HA INSERTADO CORRECTAMENTE (JODER CUÁNTOS IFS) -----
		if (count($errores) == 0) {
			echo '<script>window.location.replace("crud.php");</script>';
		} else {

			foreach ($errores as $error) {
				echo $error;
			}

			if ($accion == 'Editar') {
				echo '<a href="formulario.php?id=' . $id_pelicula . '" class="btn btn-primary">Volver al formulario</a>';
			} else {
				echo '<a href="formulario.php" class="btn btn-primary">Volver al formulario</a>';
			}

		}
	}
}
?>