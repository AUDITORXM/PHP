<?php
include('includes/inc_config.php');
include('includes/inc_cabecera.php');
include('includes/db.php');

if (!$logeado) {
	header('Location: index.php');
}

$titulo = $fecha_estreno = $duracion = $imagen = $accion = "";
$generos = array();

if (isset($_GET['id'])) {

	$errores = array();

	// ----- VALIDAR QUE EL ID EN EL GET EXISTE EN LA BBDD -----
	$stmt = $con->prepare('SELECT * FROM Peliculas WHERE id = ' . $_GET['id']);
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

<h2 class="bg-success text-center">Insertar Película</h2>

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
			<option value="s">Sí</option>
			<option value="n">No</option>
		</select>
	</div>
	<div class="mb-3">
		<label for="generos" class="form-label">Género(s):</label>
		<?php
			if ($accion == 'Editar') {
				$query = 'SELECT Generos.*
							FROM Peliculas, Pelis_Generos, Generos
							WHERE Peliculas.id = Pelis_Generos.pelicula AND Generos.id = Pelis_Generos.genero AND Peliculas.id = ' . $id_pelicula;
			} else {
				$query = 'SELECT * FROM Generos';
			}

			foreach ($con->query($query) as $fila) {

				echo '<div class="form-check form-check-inline">';
				echo 	'<input class="form-check-input" type="checkbox" name="genero[]" id="check_' . $fila['id'] . '" value="'
						. $fila['id'] . '">';
				echo 	'<label class="form-check-label" for="genero">' . $fila['nombre'] . '</label>';
				echo '</div>';

			}
		?>
	</div>
	<div class="mb-3">
		<label for="imagen" class="form-label">Imagen:</label>
		<input type="file" class="form-control" name="imagen" id="imagen" value="<?php echo $imagen;?>">
	</div>
	<p class="invisible" name="accion" id="accion"><?php echo $accion;?></p>
	<p class="invisible" name="id_pelicula" id="id_pelicula"><?php echo $id_pelicula;?></p>
	<button type="submit" class="btn btn-primary">Aceptar</button>
</form>

<?php include('includes/inc_pie.php');?>