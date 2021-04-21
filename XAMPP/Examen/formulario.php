<?php
include('includes/inc_config.php');
include('includes/inc_cabecera.php');
?>

<form name="form" action="grabar.php" method="POST">
	<?php 
	if (isset($id)) {?>
		<input type="hidden" name="id" value="<?php echo $id;?>">
	<?php 
	}?>

	<div class="mb-3">
		<label class="form-label" for="correo">Correo:</label>
		<input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correo;?>" required>
	</div>
	<div class="mb-3">
		<label class="form-label" for="password_1">Contraseña:</label>
		<input type="password" class="form-control" id="password" name="password" value="<?php echo $password;?>" required>
	</div>
	<div class="mb-3">
		<label class="form-label" for="nombre">Nombre:</label>
		<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre;?>" required>
	</div>
	<div class="mb-3">
		<label class="form-label" for="apellido">Apellido:</label>
		<input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $apellido;?>" required>
	</div>
	<div class="mb-3">
		<label class="form-label" for="usuario">Nombre de Usuario:</label>
		<input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario;?>" required>
	</div>
	<div class="mb-3">
		<label class="form-label" for="fecha_nac">Fecha de Nacimiento:</label>
		<input type="date" class="form-control" id="fecha_nac" name="fecha_nac" value="<?php echo $fecha_nac;?>" required>
	</div>
	<div class="mb-3">
		<label class="form-label" for="telefono">Teléfono:</label>
		<input type="number" class="form-control" id="telefono" name="telefono" placeholder="Formato: 123456789" value="<?php echo $telefono;?>" required>
	</div>
	<div class="input-group mb-3">
		<label class="input-group-text" for="genero">Género</label>
		<select class="form-select" id="genero" name="genero">
			<option value="H" selected>Hombre</option>
			<option value="M">Mujer</option>
			<option value="U">No Binario</option>
		</select>
	</div>

	<br>

	<div class="input-group mb-3">
		<button type="submit" class="btn btn-success" value="<?php echo $accion;?>"><?php echo $accion;?></button>
	</div>

	<input type="hidden" name="accion" value="<?php echo $accion;?>">
</form>

<?php include('includes/inc_pie.php');?>