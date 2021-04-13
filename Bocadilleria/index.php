<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("includes/inc_config.php") ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Bocadillería</title>
</head>
<body>
	<div class="container">
		<?php include("includes/inc_cabecera.php") ?>
		<div class="card-group d-flex justify-content-evenly align-items-center">
			<div class="card" style="width: 18rem;">
				<img src="img/index_bocadillos.png" class="card-img-top w-25 rounded mx-auto d-block" alt="Imagen Bocadillos">
				<div class="card-body text-center">
					<a href="bocadillos.php" class="card-link">Comprar Bocadillos</a>
				</div>
			</div>

			<div class="card" style="width: 18rem;">
				<img src="img/index_bebidas.png" class="card-img-top w-25 rounded mx-auto d-block" alt="Imagen Bebidas">
				<div class="card-body text-center">
					<a href="bebidas.php" class="card-link">Comprar Bebidas</a>
				</div>
			</div>
		</div>
	</div>
	<?php include("includes/inc_pie.php") ?>
</body>
</html>