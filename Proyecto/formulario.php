<?php
include('includes/inc_config.php');
include('includes/inc_cabecera.php');
include('includes/db.php');

if (!$logeado) {
	header('Location: index.php');
}

$titulo = $fecha_estreno = $duracion = $imagen = $accion = "";

if (isset($_GET['id'])) {

	$errores = array();

	// ----- VALIDAR QUE EL ID EN EL GET EXISTE EN LA BBDD -----
	$stmt = $con->prepare('SELECT id FROM Peliculas WHERE id = ' . $_GET['id']);
	$stmt -> execute();
	$fila = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!empty($fila)) {

		$id_pelicula = $fila["id"];

	} else {

		array_push($errores, 'Error con el ID de la película seleccionada');

	}

	if (count($errores) == 0) {

		// ----- RECOGEMOS LOS DATOS DE LA PELI PARA RELLENAR LOS CAMPOS AUTOMÁTICAMENTE -----
		$query = 'SELECT * FROM Peliculas WHERE id = ' . $id_pelicula;

		foreach ($con->query($query) as $fila) {

			$titulo = $fila['titulo'];
			$fecha_estreno = $fila['fecha_estreno'];
			$duracion = $fila['duracion'];
			$imagen = $fila['imagen'];

		}

	}

	$accion = 'Editar';

} else {

	$accion = 'Insertar';

}
?>

<h2 class="bg-success text-center"><?php echo $accion?> Película</h2>

<form class="px-4 py-3" action="validacion.php" method="POST" enctype="multipart/form-data">
	<div class="mb-3">
		<label for="titulo" class="form-label">Título:</label>
		<input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $titulo;?>">
	</div>
	<div class="mb-3">
		<label for="fecha_estreno" class="form-label">Fecha de Estreno:</label>
		<input type="date" class="form-control" name="fecha_estreno" id="fecha_estreno" value="<?php echo $fecha_estreno;?>">
	</div>
	<div class="mb-3">
		<label for="duracion" class="form-label">Duración (en minutos):</label>
		<input type="number" class="form-control" name="duracion" id="duracion" value="<?php echo $duracion;?>">
	</div>
	<div class="mb-3">
		<label for="activo" class="form-label">Activo?</label>
		<select name="activo" id="activo">
		<?php
			if ($accion == 'Editar') {
				$query = 'SELECT * FROM Peliculas WHERE id = ' . $id_pelicula;

				foreach ($con->query($query) as $fila) {
					if ($fila['activo'] == 1) {
						echo '<option value="s" selected>Sí</option>';
						echo '<option value="n">No</option>';
					} else {
						echo '<option value="s">Sí</option>';
						echo '<option value="n" selected>No</option>';
					}
				}
			} else {
				echo '<option value="s">Sí</option>';
				echo '<option value="n">No</option>';
			}
		?>

		</select>
	</div>
	<div class="mb-3">
		<label for="generos" class="form-label">Género(s):</label>
		<?php
			if ($accion == 'Editar') {
				$query = 'SELECT Generos.*
							FROM Peliculas, Pelis_Generos, Generos
							WHERE Peliculas.id = Pelis_Generos.pelicula AND Generos.id = Pelis_Generos.genero AND Peliculas.id = ' . $id_pelicula;

				$generos = array();

				foreach ($con->query($query) as $fila) { //Guardamos los IDs de los generos de la peli para ponerle el check por defecto
					array_push($generos, $fila['id']);
				}

			}

			$query = 'SELECT * FROM Generos';

			foreach ($con->query($query) as $fila) {

				echo '<div class="form-check form-check-inline">';
				if (isset($generos) && in_array($fila['id'], $generos)) {
					echo 	'<input class="form-check-input" type="checkbox" checked name="genero[]" id="check_' . $fila['id'] . '" value="' . $fila['id'] . '">';
				} else {
					echo 	'<input class="form-check-input" type="checkbox" name="genero[]" id="check_' . $fila['id'] . '" value="'
						. $fila['id'] . '">';
				}
				echo 	'<label class="form-check-label" for="genero">' . $fila['nombre'] . '</label>';
				echo '</div>';

			}
		?>
	</div>
	<?php
		// if ($accion != 'Editar') {
		// 	echo '<div class="mb-3">';
		// 	echo	'<label for="imagen" class="form-label">Imagen:</label>';
		// 	echo	'<input type="file" class="form-control" name="imagen" id="imagen">';
		// 	echo '</div>';
		// }
	?>
	<input type="hidden" name="accion" id="accion" value="<?php echo $accion;?>">
	<?php
		if (isset($id_pelicula)) {
			echo '<input type="hidden" name="id_pelicula" id="id_pelicula" value="' . $id_pelicula . '">';
		}?>
	<button type="submit" class="btn btn-primary">Aceptar</button>
</form>

<?php include('includes/inc_pie.php');?>