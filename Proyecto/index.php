<?php
include('includes/inc_config.php');
include('includes/inc_cabecera.php');
include('includes/db.php');?>

<div id="carrusel_pelis" class="carousel slide" data-bs-ride="carousel">
	<div class="carousel-indicators">
		<button type="button" data-bs-target="#carrusel_pelis" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
		<button type="button" data-bs-target="#carrusel_pelis" data-bs-slide-to="1" aria-label="Slide 2"></button>
		<button type="button" data-bs-target="#carrusel_pelis" data-bs-slide-to="2" aria-label="Slide 3"></button>
		<button type="button" data-bs-target="#carrusel_pelis" data-bs-slide-to="3" aria-label="Slide 4"></button>
	</div>
	<div class="carousel-inner">
		<?php
			$query = 'SELECT id, titulo, imagen FROM Peliculas WHERE activo = 1 ORDER BY fecha_estreno DESC LIMIT 4';
			$activo = 1;

			foreach($con->query($query) as $fila) {
				if ($activo == 1) {
					echo "<div class='carousel-item active'>";
					$activo = 0;
				} else {
					echo "<div class='carousel-item'>";
				}
				echo "<a href='mostrarPeli.php?id=" . $fila['id'] . "'><img src='img/" . $fila['imagen'] . "' class='rounded mx-auto d-block w-25' alt='Imagen_Carrusel_" . $fila['titulo'] . "'></a>";
				echo "</div>";
			}
		?>
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carrusel_pelis" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Anterior</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carrusel_pelis" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Siguiente</span>
	</button>
</div>

<br><h2 class="bg-success text-center">EN CARTELERA</h2><br>

<!-- <form action="" method="post">
	<label for="fechafiltro">Fecha:</label>
	<select name="fechafiltro" id="fechafiltro"> -->

	<?php
		// $query = 'SELECT DISTINCT fecha_estreno FROM Peliculas GROUP BY fecha_estreno ORDER BY fecha_estreno DESC';

		// foreach($con->query($query) as $fila) {

		// 	echo "<option value='" . $fila['fecha_estreno'] . "'>" . $fila['fecha_estreno'] . "</option>";

		// }
	?>
	<!-- </select>
	<button type="submit" class="btn btn-primary" id="filtrar">Filtrar</button>
</form> -->

<div class="row row-cols-1 row-cols-md-2 g-4">
<?php
	$query = 'SELECT Peliculas.id AS id, titulo, duracion, Generos.nombre AS genero, imagen
				FROM Peliculas, Pelis_Generos, Generos
				WHERE Peliculas.id = Pelis_Generos.pelicula AND Generos.id = Pelis_Generos.genero AND Peliculas.activo = 1
				GROUP BY Peliculas.id
				ORDER BY fecha_estreno DESC';

	foreach($con->query($query) as $fila) {

		echo "<div class='card rounded mx-auto d-block' style='width: 18rem;'>";
		echo	"<a href='mostrarPeli.php?id=" . $fila['id'] . "'><img src='img/" . $fila['imagen'] . "' class='card-img-top' alt='Imagen " . $fila['titulo'] . "'></a>";
		echo	"<div class='card-body'>";
		echo		"<h5 class='card-title'>" . $fila['titulo'] . "</h5>";
		echo	"</div>";
		echo	"<ul class='list-group list-group-flush'>";
		echo		"<li class='list-group-item'>" . $fila['duracion'] . " minutos</li>";
		echo		"<li class='list-group-item'>" . $fila['genero'] . "</li>";
		echo 	"</ul>";
		echo	"<div class='card-body'>";
		echo		"<a href='mostrarPeli.php?id=" . $fila['id'] . "' class='card-link'>Consultar Horario >></a>";
		echo	"</div>";
		echo "</div>";

	}
?>
</div>

<br><h2 class="bg-success text-center">NOTICIAS Y NOVEDADES</h2><br>

<?php include('includes/inc_pie.php');?>