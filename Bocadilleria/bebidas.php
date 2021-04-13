<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("includes/inc_config.php") ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Bocadillería: Bebidas</title>
</head>
<body>

	<?php

		include ('./db.php');

		$query = "SELECT * FROM BEBIDAS";

		if ($resultado = $conn->query($query)){
			while ($row = $resultado->fetch_assoc()) {
				$bebidas[$row["ID"]]["NOMBRE"] = $row["NOMBRE"];
				$bebidas[$row["ID"]]["IMAGEN"] = $row["IMAGEN"];
			}
			$resultado->close();
		}

		$doc_html = "";
		$i = 1;

		foreach ($bebidas as $bebida_id => $valores) {
			// $doc_html .= '<div class="card mb-3">
			// 	<img src="./img/' . $valores["IMAGEN"] . '" class="card-img-top" alt="Imagen Bebida">
			// 	<div class="card-body">
			// 		<h5 class="card-title">' . $valores["NOMBRE"] . '</h5>
			// 		<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
			// 		<button type="button" class="btn btn-success">Comprar</button>
			// 		</div></div>';

			$doc_html .= '<div class="row g-0">
				<div class="col-md-4">
					<img src="./img/' . $valores["IMAGEN"] . '" class="w-75 p-3" alt="Imagen Bebida">
				</div>
				<div class="col-md-8">
					<div class="card-body">
						<h5 class="card-title">' . $valores["NOMBRE"] . '</h5>
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<input type="radio" name="ft' . $i . '" id="fria">
								</div>
							</div>
							<label for="fria">Bebida Fría</label>
						</div>
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<input type="radio" name="ft' . $i . '" id="tiempo">
								</div>
							</div>
							<label for="tiempo">Bebida del Tiempo</label>
						</div>
						<button type="button" class="btn btn-success" id="anadir' . $i .'">+</button>
						<input type="number" class="text-center" min="0" id="cantidad' . $i . '">
						<button type="button" class="btn btn-success" id="quitar' . $i .'">-</button>
						<br>
						<button type="submit" class="btn btn-success" value="comprar' . $i . '">Comprar</button>
					</div>
				</div>
			</div>';

			$i++;

		}

	?>

	<div class="container">
		<?php include("includes/inc_cabecera.php"); ?>

		<form action="server.php" method="post">
			<?php echo $doc_html?>
		</form>

	</div>

	<?php include("includes/inc_pie.php") ?>
</body>
</html>