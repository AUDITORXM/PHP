<!DOCTYPE html>
<html>
<head>
	<?php include('includes/inc_config.php') ?>
	<title>Registrarse</title>
</head>
<body>
	<?php include('includes/inc_cabecera.php') ?>
	<div class="header">
		<h2>Formulario de Registro</h2>
	</div>

	<form method="post" action="usuario_registrado.php">
		<div class="mb-3">
			<label class="form-label" for="correo">Correo:</label>
			<input type="email" class="form-control" id="correo" name="correo" required>
		</div>
		<div class="mb-3">
			<label class="form-label" for="password_1">Contraseña:</label>
			<input type="password" class="form-control" id="password_1" name="password_1" required>
		</div>
		<div class="mb-3">
			<label class="form-label" for="password_2">Confirmar Contraseña:</label>
			<input type="password" class="form-control" id="password_2" name="password_2" required>
		</div>
		<div class="mb-3">
			<label class="form-label" for="nombre">Nombre:</label>
			<input type="text" class="form-control" id="nombre" name="nombre" required>
		</div>
		<div class="mb-3">
			<label class="form-label" for="apellido">Apellido:</label>
			<input type="text" class="form-control" id="apellido" name="apellido" required>
		</div>
		<div class="mb-3">
			<label class="form-label" for="usuario">Nombre de Usuario:</label>
			<input type="text" class="form-control" id="usuario" name="usuario" required>
		</div>
		<div class="mb-3">
			<label class="form-label" for="fecha_nac">Fecha de Nacimiento:</label>
			<input type="date" class="form-control" id="fecha_nac" name="fecha_nac" required>
		</div>
		<div class="mb-3">
			<label class="form-label" for="telefono">Teléfono:</label>
			<input type="number" class="form-control" id="telefono" name="telefono" placeholder="Formato: 123456789" required>
		</div>
		<div class="input-group mb-3">
			<label class="input-group-text" for="genero">Género</label>
			<select class="form-select" id="genero" name="genero">
				<option value="H" selected>Hombre</option>
				<option value="M">Mujer</option>
				<option value="U">No Binario</option>
			</select>
		</div>
		<div class="input-group mb-3">
			<button type="submit" class="btn btn-success">Crear cuenta</button>
		</div>
	</form>

	<?php include('includes/inc_pie.php') ?>
</body>
</html>