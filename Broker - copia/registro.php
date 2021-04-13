<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/css_registro.css">
	<title>Registrarse</title>
</head>
<body>
	<div class="header">
		<h2>Registro</h2>
	</div>

	<form method="post" action="registro.php">
		<div class="input-group">
			<label>Usuario</label>
			<input type="text" name="username">
		</div>
		<div class="input-group">
			<label>Contraseña</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirmar Contraseña</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Registrarse</button>
		</div>
		<p>Ya tienes cuenta? <a href="index.php">Iniciar Sesión</a></p>
	</form>
</body>
</html>