<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php include('config.php');?>
	<title>Productos</title>
</head>
<body>

	<div class="container">
		<h1 class="text-center">Introducir nuevo producto</h1>

		<form action="respuesta.php" method="post">
			<div class="mb-3">
				<label for="nombre" class="form-label">Nombre</label>
				<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del producto" required>
			</div>
			<div class="mb-3">
				<label for="suministrador" class="form-label">Suministrador</label>
				<input type="text" class="form-control" name="suministrador" id="suministrador" placeholder="Suministrador del producto" required>
			</div>
			<div class="mb-3">
				<label for="precio" class="form-label">Precio</label>
				<input type="number" class="form-control" name="precio" id="precio" placeholder="Precio del producto" required>
			</div>
			<div class="mb-3">
				<label for="descripcion" class="form-label">Descripción</label>
				<textarea class="form-control" name="descripcion" id="descripcion" placeholder="Descripción del producto" required></textarea>
			</div>
			<div class="mb-3">
				<label for="link" class="form-label">Enlace</label>
				<input type="url" class="form-control" name="enlace" id="enlace" placeholder="Enlace del producto" required>
			</div>
			<button type="submit" class="btn btn-success mb-3">Registrar Producto</button>
		</form>
	</div>

</body>
</html>