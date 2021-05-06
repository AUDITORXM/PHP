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
				echo "<a href='mostrarPeli.php?id=" . $fila['id'] . "'><img src='" . $fila['imagen'] . "' class='rounded mx-auto d-block w-25' alt='Imagen_Carrusel_" . $fila['titulo'] . "'></a>";
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

<div class="row row-cols-1 row-cols-md-2 g-4">
<?php
	$query = 'SELECT Peliculas.id, titulo, duracion, imagen, group_concat(Generos.nombre) as generos
			FROM Peliculas
			INNER JOIN Pelis_Generos ON Pelis_Generos.pelicula = Peliculas.id
			INNER JOIN Generos ON Pelis_Generos.genero = Generos.id
			WHERE activo = 1
			GROUP BY Peliculas.id, Peliculas.titulo
			ORDER BY Peliculas.Fecha_estreno DESC';

	foreach($con->query($query) as $fila) {

		// ----- COMO AL HACER EL GROUP_CONCAT EN LA CONSULTA DEVUELVE LOS GÉNEROS SIN ESPACIOS, AÑADO LOS ESPACIOS CON EL IMPLODE -----
		$fila['generos'] = explode(",", $fila['generos']);
		$fila['generos'] = implode(", ", $fila['generos']);

		echo "<div class='card rounded mx-auto d-block' style='width: 18rem;'>";
		echo	"<a href='mostrarPeli.php?id=" . $fila['id'] . "'>
					<img src='" . $fila['imagen'] . "' class='card-img-top' alt='Imagen " . $fila['titulo'] . "'>
				</a>";
		echo	"<div class='card-body'>";
		echo		"<h5 class='card-title'>" . $fila['titulo'] . "</h5>";
		echo	"</div>";
		echo	"<ul class='list-group list-group-flush'>";
		echo		"<li class='list-group-item'>" . $fila['duracion'] . " minutos</li>";
		echo		"<li class='list-group-item'>" . $fila['generos'] . "</li>";
		echo 	"</ul>";
		echo	"<div class='card-body'>";
		echo		"<a href='mostrarPeli.php?id=" . $fila['id'] . "' class='card-link'>Consultar Horario >></a>";
		echo	"</div>";
		echo "</div>";

	}
?>
</div>

<?php include('includes/inc_pie.php');?>