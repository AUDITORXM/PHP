<?php
include('includes/inc_config.php');
include('includes/inc_cabecera.php');
include('includes/db.php');
include('includes/api.php');

if (!isset($_GET['id'])) {

	header("Location: index.php");

} else {

	$titulo = $sinopsis = $actores = $director = $clasificacion = $duracion = $generos = $fecha_estreno = "";
	$array_actores = $array_generos = array();

	$query = "SELECT Peliculas.*, Generos.nombre AS genero
				FROM Peliculas, Pelis_Generos, Generos
				WHERE Peliculas.id = Pelis_Generos.pelicula AND Generos.id = Pelis_Generos.genero AND Peliculas.id =" . $_GET['id'] .
				" GROUP BY Peliculas.id";

	foreach ($con->query($query) as $fila) {

		$titulo = $fila['titulo'];
		$sinopsis = getSinopsis($fila['id_tmdb'], $token);
		$fecha_estreno = $fila['fecha_estreno'];
		$duracion = $fila['duracion'];
		$imagen = $fila['imagen'];
		array_push($array_generos, $fila['genero']);
		$array_actores = getActores($fila['id_tmdb'], $token);
		$director = getDirector($fila['id_tmdb'], $token);

	}

	foreach ($array_generos as $genero) {

		$generos .= $genero . ", ";

	}

	foreach ($array_actores as $actor) {

		$actores .= $actor . ", ";

	}

	$generos = rtrim($generos, ", ");
	$actores = rtrim($actores, ", ");

}
?>

<div class="card mb-3 rounded mx-auto d-block" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="img/<?php echo $imagen;?>" class="img-fluid" alt="Imagen Película">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <p class="card-text"><strong>Título:</strong> <?php echo $titulo?></p>
		<p class="card-text"><strong>Sinopsis:</strong> <?php echo $sinopsis?></p>
		<p class="card-text"><strong>Actores:</strong> <?php echo $actores?></p>
		<p class="card-text"><strong>Director:</strong> <?php echo $director?></p>
		<p class="card-text"><strong>Géneros:</strong> <?php echo $generos?></p>
		<p class="card-text"><strong>Fecha de Estreno:</strong> <?php echo $fecha_estreno?></p>
        <p class="card-text"><small class="text-muted">Duración: <?php echo $duracion?> minutos</small></p>
      </div>
    </div>
  </div>
</div>

<?php include('includes/inc_pie.php');?>