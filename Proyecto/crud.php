<?php
include('includes/inc_config.php');
include('includes/inc_cabecera.php');
include('includes/db.php');

if (!$logeado) {
	header('Location: index.php');
}?>

<script>
	function redireccion(id, activo){
		window.location.replace("crud.php?id=" + id + "&activo=" + activo);
	}
</script>

<?php
if (isset($_GET['id']) && isset($_GET['activo'])) {

	$stmt = $con->prepare('SELECT activo FROM Peliculas WHERE id = ' . $_GET['id']);

	// ----- COMPROBAR QUE EL ID EXISTE -----
	if ($stmt->execute()) {

		$fila = $stmt->fetch(PDO::FETCH_ASSOC);

		if (!empty($fila)) {

			if ($fila['activo'] == 1) {
				$stmt = $con->prepare('UPDATE Peliculas SET activo = 0 WHERE id = ' . $_GET['id']);
			} else {
				$stmt = $con->prepare('UPDATE Peliculas SET activo = 1 WHERE id = ' . $_GET['id']);
			}

			$stmt->execute();

			header('Location: crud.php');

		}

	} else {
		echo '<script>alert("Error al cambiar el Estado");</script>';
	}
}
?>
<br><h2 class="bg-success text-center">Listado de Películas</h2><br>

<a class="btn btn-success" href="formulario.php">Insertar nueva película</a>

<br><br>

<table class="table table-striped table-hover align-middle text-center">
	<tr>
		<th>ID</th>
		<th>Título</th>
		<th>Género(s)</th>
		<th>Fecha de Estreno</th>
		<th>Duración</th>
		<th>Activo</th>
		<!-- <th>Nombre de la Imagen</th> -->
		<th>Editar</th>
		<th>Borrar</th>
	</tr>

<?php

$query = 'SELECT Peliculas.*, group_concat(Generos.nombre) as generos
			FROM Peliculas
			INNER JOIN Pelis_Generos ON Pelis_Generos.pelicula = Peliculas.id
			INNER JOIN Generos ON Pelis_Generos.genero = Generos.id
			GROUP BY Peliculas.id, Peliculas.titulo';

foreach($con->query($query) as $fila) {

	// ----- COMO AL HACER EL GROUP_CONCAT EN LA CONSULTA DEVUELVE LOS GÉNEROS SIN ESPACIOS, AÑADO LOS ESPACIOS CON EL IMPLODE -----
	$fila['generos'] = explode(",", $fila['generos']);
	$fila['generos'] = implode(", ", $fila['generos']);

	echo '<tr>';

	// ----- METO EL RESULTADO DE LA CONSULTA EN LA TABLA -----
	echo '<td>' . $fila['id'] . '</td>
		<td>' .  $fila['titulo'] . '</td>
		<td>' .$fila['generos'] . '</td>
		<td>' .$fila['fecha_estreno'] . '</td>
		<td>' . $fila['duracion'] . '</td>';

	if ($fila['activo'] == 1) {?>
		<td>
			<div class="form-check form-switch">
				<label><input type="checkbox" onclick="redireccion(<?php echo $fila['id'];?>, 1)" class="form-check-input" value="<?php echo $fila['activo'];?>" checked></input></label>
			</div>
		</td>
	<?php
	} else {?>
		<td>
			<div class="form-check form-switch">
				<label><input type="checkbox" onclick="redireccion(<?php echo $fila['id'];?>, 0)" class="form-check-input" value="<?php echo $fila['activo'];?>"></input></label>
			</div>
		</td>
	<?php
	}

	echo '<td><a class="btn btn-primary" href="formulario.php?id='.$fila['id'].'">Editar</a></td>';

	echo '<td><a class="btn btn-danger" href="eliminarPeli.php?id='.$fila['id'].'" onclick="return confirm(\'¿Está seguro que desea eliminar la película con ID ' . $fila['id'] . ' y nombre ' . $fila['titulo'] . '?\')">Eliminar</a></td>';

	echo '</tr>';
}

echo '</table>';

include('includes/inc_pie.php');?>