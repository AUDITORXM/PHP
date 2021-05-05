<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../../vendor/autoload.php';

include('includes/inc_config.php');
include('includes/inc_cabecera.php');
include('includes/db.php');

$correo = $nombre = $mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	foreach ($_POST as $campo) {

		if (($campo == "correo" && (!$isset($campo) || empty($campo))) ||
			($campo == "nombre" && (!$isset($campo) || empty($campo))) ||
			($campo == "genero" && (!$isset($campo) || empty($campo))) ||
			($campo == "comentarios" && (!$isset($campo) || empty($campo)))) {

			echo "<script>alert('Falta por rellenar " . $campo . "')</script>";
			$vacio = TRUE;

		}

	}

	if (!isset($vacio)) {

		$correo = $_POST['correo'];
		$nombre = $_POST['nombre'];
		$generos = array();
		foreach ($_POST['genero'] as $genero) {
			array_push($generos, $genero);
		}
		$comentario = $_POST['comentarios'];
		$experiencia = $notificaciones = array();

		if(isset($_POST['experiencia'])) {
			foreach ($_POST['experiencia'] as $check) {
				array_push($experiencia, $check);
			}
		}

		if(isset($_POST['notificaciones'])) {
			foreach ($_POST['notificaciones'] as $check) {
				array_push($notificaciones, $campo);
			}
		}

		mandarCorreo($correo, $nombre, $generos, $experiencia, $notificaciones, $comentario);

	}

} else {

	$mensaje = "";

}

function mandarCorreo($correo, $nombre, $generos, $experiencia, $notificaciones, $comentario) {

	$mail = new PHPMailer;
	$mail->isSMTP();
	// $mail->SMTPDebug = 2;
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = 'kblancocampandegui@gmail.com';
	$mail->Password = 'TrabajoDeCosas';
	$mail->setFrom($correo, $nombre);
	$mail->addAddress('kblancocampandegui@gmail.com', 'Kevin Blanco');
	$mail->Subject = 'Respuesta Formulario';
	$mensaje = '<h1>Feedback del Formulario</h1>
				<p>Género(s) favorito(s):</p>
				<ul>';

	foreach ($generos as $check) {
		$mensaje .= '<li>' . $check . '</li>';
	}

	$mensaje .= '</ul>
				<p>Experiencia en el sitio:';
	foreach ($experiencia as $exp) {
		$mensaje .= $exp;
	}

	$mensaje .= '</p><p>Notificaciones activadas para:</p><ul>';

	foreach ($notificaciones as $check) {
		$mensaje .= '<li>' . $check . '</li>';
	}

	$mensaje .= '</ul><p>Comentario: ' . $comentario . '</p>';

	$mail->msgHTML($mensaje);

	//$mail->addAttachment('test.txt');
	if (!$mail->send()) {
		$mensaje = "Los datos no se han podido enviar, inténtelo más tarde.";
	} else {
		$mensaje = "Datos enviados con éxito.";
	}

}?>

<br><h2 class="bg-success text-center">Contáctanos</h2><br>

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
		<select class="form-select" multiple name="genero[]" id="genero" required>
			<?php
				$query = 'SELECT DISTINCT nombre FROM Generos';
				foreach($con->query($query) as $fila) {
					echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
				}
			?>
		</select>
	</div>
	<div class="mb-3">
		<label class="form-label" for="experiencia">Tu experiencia en el sitio:</label>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="experiencia[]" id="muymala" value="Muy Mala">
			<label class="form-check-label" for="muymala">Muy Mala</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="experiencia[]" id="mala" value="Mala">
			<label class="form-check-label" for="mala">Mala</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="experiencia[]" id="regular" value="Regular">
			<label class="form-check-label" for="regular">Regular</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="experiencia[]" id="buena" value="Buena">
			<label class="form-check-label" for="buena">Buena</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="experiencia[]" id="muybuena" value="Muy Buena">
			<label class="form-check-label" for="muybuena">Muy Buena</label>
		</div>
	</div>
	<div class="mb-3">
		<label class="form-label" for="notificaciones">Recibir notificaciones de:</label>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" name="notificaciones[]" id="estrenos" value="estrenos">
			<label class="form-check-label" for="estrenos">Estrenos</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" name="notificaciones[]" id="promociones" value="promociones">
			<label class="form-check-label" for="promociones">Promociones</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" name="notificaciones[]" id="noticias" value="noticias">
			<label class="form-check-label" for="noticias">Noticias</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" name="notificaciones[]" id="preventas" value="preventas">
			<label class="form-check-label" for="preventas">Preventas</label>
		</div>
	</div>

	<label for="comentarios">Si tiene algún comentario o mejora que desee comunicarnos, por favor, escríbalo aquí:</label>
	<textarea class="form-control" name="comentarios" id="comentarios"></textarea>

	<br>

	<div class="input-group mb-3">
		<button type="submit" class="btn btn-success">Enviar</button>
	</div>
</form>

<p><?php echo $mensaje;?></p>

<?php include('includes/inc_pie.php');?>