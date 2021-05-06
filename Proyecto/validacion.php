<?php
include('includes/inc_config.php');
include('includes/db.php');
include('includes/api.php');

if (!$logeado) {
	header('Location: index.php');
}

$errores = array();

if ($_POST['accion'] == 'Editar') {
	if (count($_POST) < 5) { // Pongo 5 porque siempre se deberán rellenar 5 campos
		array_push($errores, 'Faltan datos por rellenar');
	}
}

// ----- SI NO HAY VACÍOS -----
if (count($errores) == 0) {

	$accion = $_POST['accion'];
	$titulo = $_POST['titulo'];

	// ----- SI NO ESTÁ ID_PELICULA EN POST, ES QUE ESTÁ CREANDO UNA NUEVA PELÍCULA, POR LO QUE HAY QUE BUSCAR LA ID EN LA API -----
	if (isset($_POST['id_pelicula'])) {
		$id_pelicula = $_POST['id_pelicula'];
	} else if (!$id_tmdb = getIdPelicula($titulo, $token)) {
		array_push($errores, 'No existe ninguna película con ese nombre');
	}

	$fecha_estreno = $_POST['fecha_estreno'];
	$array_generos = array();

	if ($_POST['duracion'] >= 60 && $_POST['duracion'] <= 300) {
		$duracion = $_POST['duracion'];
	} else {
		array_push($errores, 'La duración puede no ser menor de 60 minutos o mayor de 200 minutos');
	}

	if ($_POST['activo'] == "s") {
		$activo = 1;
	} else {
		$activo = 0;
	}

	foreach ($_POST['genero'] as $genero => $id) {
		array_push($array_generos, $id);
	}

	if (isset($id_tmdb)) {
		$datos_pelicula = getDatosPelicula($id_tmdb, $token);
		$imagen = getImagenPelicula($datos_pelicula);
	}

	// ----- INSERCIÓN DE DATOS SI TODO ESTÁ BIEN -----
	if (count($errores) == 0) {

		if ($accion == "Editar") {
			$stmt = $con->prepare('UPDATE Peliculas
									SET titulo = "' . $titulo . '",
										fecha_estreno = "' . $fecha_estreno . '",
										duracion = ' . $duracion . ',
										activo = ' . $activo . '
									WHERE id = ' . $id_pelicula);
		} else {
			$stmt = $con->prepare('INSERT INTO Peliculas (id_tmdb, titulo, fecha_estreno, duracion, activo, imagen)
						VALUES (' . $id_tmdb . ', "' . $titulo . '", "' . $fecha_estreno . '", ' . $duracion . ', ' . $activo . ', "'
						. $imagen . '")');
		}

		// if ($con->query($query) === TRUE) {
		if ($stmt -> execute() || $stmt -> rowCount() > 0) {

			if (!isset($id_pelicula)) {
				// ----- COGEMOS LA ÚLTIMA PELÍCULA INSERTADA (CUANDO ES INSERTAR) -----
				$stmt = $con->prepare("SELECT MAX(id) as id FROM Peliculas");
				$stmt -> execute();
				$fila = $stmt->fetch(PDO::FETCH_ASSOC);

				if (!empty($fila)) {
					$id_pelicula = $fila["id"];
				}
			}

			// ----- DELETE PARA RESETEAR LOS GÉNEROS DE LA PELÍCULA (QUE NO QUEDEN LOS ANTERIORES) -----
			$stmt = $con->prepare('DELETE FROM Pelis_Generos WHERE pelicula = ' . $id_pelicula);

			if ($stmt -> execute()) {
				// ----- AHORA INSERTAMOS LOS GÉNEROS CORRESPONDIENTES A LA PELÍCULA -----
				foreach ($array_generos as $genero) {
					$query = 'INSERT INTO Pelis_Generos VALUES (' . $id_pelicula . ', ' . $genero . ')';

					if (!$con->query($query) === TRUE) {
						array_push($errores, 'Error al insertar el género ' . $genero);
					}
				}
			} else {
				array_push($errores, 'Error con la Base de Datos');
				// print_r($con->errorInfo());
			}

		} else {
			array_push($errores, 'Error con la Base de Datos');
			// print_r($con->errorInfo());
		}

		// ----- REDIRECCIÓN SI TODO SE HA INSERTADO CORRECTAMENTE (JODER CUÁNTOS IFS) -----
		if (count($errores) == 0) {
			echo '<script>window.location.replace("crud.php");</script>';
		} else {

			foreach ($errores as $error) {
				print_r($error);
			}

			if ($accion == 'Editar') {
				echo '<br><a href="formulario.php?id=' . $id_pelicula . '" class="btn btn-primary">Volver al formulario</a>';
			} else {
				echo '<br><a href="formulario.php" class="btn btn-primary">Volver al formulario</a>';
			}

		}
	}
}
?>