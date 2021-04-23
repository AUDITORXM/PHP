<?php
include('includes/inc_config.php');
include('includes/inc_cabecera.php');?>

<div id="carrusel_pelis" class="carousel slide" data-bs-ride="carousel">
	<div class="carousel-indicators">
		<button type="button" data-bs-target="#carrusel_pelis" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
		<button type="button" data-bs-target="#carrusel_pelis" data-bs-slide-to="1" aria-label="Slide 2"></button>
		<button type="button" data-bs-target="#carrusel_pelis" data-bs-slide-to="2" aria-label="Slide 3"></button>
		<button type="button" data-bs-target="#carrusel_pelis" data-bs-slide-to="3" aria-label="Slide 4"></button>
	</div>
	<div class="carousel-inner">
		<?php
			include('includes/db.php');

			$query = 'SELECT Nombre, Imagen FROM Peliculas ORDER BY Fecha DESC LIMIT 4';

			foreach($con->query($query) as $fila) {

				echo "<div class='carousel-item active'>";
				echo	"<img src='" . $fila['Imagen'] . "' class='d-block w-100' alt='Imagen_Carrusel_" . $fila['Nombre'] . "'>";
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

<h2 class="mx-auto bg-success">EN CARTELERA</h2>

<form action="" method="post">
	<label for="fechafiltro">Fecha:</label>
	<select name="fechafiltro" id="fechafiltro">

	<?php
		$query = 'SELECT DISTINCT Fecha FROM Peliculas ORDER BY Fecha DESC';

		foreach($con->query($query) as $fila) {

			echo "<option value='" . $fila['Fecha'] . "'>" . $fila['Fecha'] . "</option>";

		}
	?>
	</select>
	<button type="submit" class="btn btn-primary" id="filtrar">Filtrar</button>
</form>

<?php
	$query = 'SELECT Nombre, Imagen FROM Peliculas ORDER BY Fecha DESC';

	foreach($con->query($query) as $fila) {

		echo "<div class='card' style='width: 18rem;'>";
		echo	"<img src='" . $fila['Imagen'] . "' class='card-img-top' alt='Imagen_" . $fila['Nombre'] . "'>";
		echo	"<div class='card-body'>";
		echo		"<h5 class='card-title'>" . $fila['Nombre'] . "</h5>";
		echo	"</div>";
		echo	"<ul class='list-group list-group-flush'>";
		echo		"<li class='list-group-item'>" . $fila['Duracion'] . "</li>";
		echo		"<li class='list-group-item'>" . $fila['Genero'] . "</li>";
		echo 	"</ul>";
		echo	"<div class='card-body'>";
		echo		"<a href='' class='card-link'>Consultar Horario >></a>";
		echo	"</div>";
		echo "</div>";

	}
?>

<h2 class="mx-auto bg-success">NOTICIAS Y NOVEDADES</h2>

<?php include('includes/inc_pie.php');?>