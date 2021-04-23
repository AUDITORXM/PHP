<?php
include('includes/inc_config.php');
include('includes/inc_cabecera.php');
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	foreach ($_POST as $campo) {

		if (($campo == "correo" && (!$isset($campo) || empty($campo))) ||
			($campo == "nombre" && (!$isset($campo) || empty($campo))) ||
			($campo == "genero" && (!$isset($campo) || empty($campo)))) {

			echo "<script>alert('Falta por rellenar " . $campo . "')</script>";
			$vacio = TRUE;

		}

	}

	if (!isset($vacio)) {



	}

} else {

	$mensaje = "";

}

?>

<form name="form" action="" method="POST">
	<div class="mb-3">
		<label class="form-label" for="correo">Correo:</label>
		<input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correo;?>" required>
	</div>
	<div class="mb-3">
		<label class="form-label" for="nombre">Nombre:</label>
		<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre;?>" required>
	</div>
	<div class="input-group mb-3">
		<label class="input-group-text" for="genero">Géneros Favoritos:</label>
		<select class="form-select" multiple name="genero" id="genero" required>
			<?php
				$query = 'SELECT DISTINCT Genero FROM Peliculas';
				foreach($con->query($query) as $fila) {
					echo "<option value='" . $fila['Genero'] . "'>" . $fila['Genero'] . "</option>";
				}
			?>
		</select>
	</div>
	<div class="mb-3">
		<label class="form-label" for="experiencia">Tu experiencia en el sitio:</label>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="muymala" id="muymala">
			<label class="form-check-label" for="muymala">Muy Mala</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="mala" id="mala">
			<label class="form-check-label" for="mala">Mala</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="regular" id="regular">
			<label class="form-check-label" for="regular">Regular</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="buena" id="buena">
			<label class="form-check-label" for="buena">Buena</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="muybuena" id="muybuena">
			<label class="form-check-label" for="muybuena">Muy Buena</label>
		</div>
	</div>
	<div class="mb-3">
		<label class="form-label" for="notificaciones">Recibir notificaciones de:</label>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" id="estrenos" value="estrenos">
			<label class="form-check-label" for="estrenos">Estrenos</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" id="promociones" value="promociones">
			<label class="form-check-label" for="promociones">Promociones</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" id="noticias" value="noticias">
			<label class="form-check-label" for="noticias">Noticias</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" id="preventas" value="preventas">
			<label class="form-check-label" for="preventas">Preventas</label>
		</div>
	</div>
	<div class="form-floating">
		<label for="comentarios">Comentarios</label>
		<textarea class="form-control" placeholder="Comentarios" id="comentarios"></textarea>
	</div>

	<br>

	<div class="input-group mb-3">
		<button type="submit" class="btn btn-success">Enviar</button>
	</div>
</form>

<p><?php echo $mensaje;?></p>

<?php include('includes/inc_pie.php');?>