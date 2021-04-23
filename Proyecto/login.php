<?php
include('includes/inc_config.php');
include('includes/inc_cabecera.php');

$submit = "login";
$submit_text = "Iniciar Sesión";

if (isset($_GET['register']) && $_GET['register'] == 1){

	$registro = TRUE;
	$submit = "register";
	$submit_text = "Registrarse";

}

?>

<div class="dropdown-menu">
	<form class="px-4 py-3" action="server.php" method="POST">
		<div class="mb-3">
			<label for="nombre" class="form-label">Nombre de Usuario:</label>
			<input type="text" class="form-control" id="nombre">
		</div>
		<div class="mb-3">
			<label for="email" class="form-label">Correo:</label>
			<input type="email" class="form-control" id="email" placeholder="email@ejemplo.com">
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">Contraseña:</label>
			<input type="password" class="form-control" id="password" placeholder="Contraseña">
		</div>
		<div class="mb-3">
			<div class="form-check">
			<input type="checkbox" class="form-check-input" id="mantenersesion">
			<label class="form-check-label" for="mantenersesion">Mantener sesión iniciada</label>
			</div>
		</div>
		<button type="submit" class="btn btn-primary" value="<?php echo $submit;?>"><?php echo $submit_text;?></button>
	</form>
	<div class="dropdown-divider"></div>
	<?php
		if (!isset($_GET['register'])) {

	?>
	<a class="dropdown-item" href="register.php?register=1">Eres nuevo? Regístrate aquí</a>
		<?php } ?>
	<!-- <a class="dropdown-item" href="forgotpass.php">Has olvidado la contraseña?</a> -->
</div>

<?php include('includes/inc_pie.php');?>