<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("includes/inc_config.php") ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Bocadillería: Bocadillos</title>
</head>
<body>

	<?php

		include ('./db.php');

		$query = "SELECT * FROM BOCADILLOS";

		if ($resultado = $conn->query($query)){
			while ($row = $resultado->fetch_assoc()) {
				$bocadillos[$row["ID"]]["NOMBRE"] = $row["NOMBRE"];
				$bocadillos[$row["ID"]]["IMAGEN"] = $row["IMAGEN"];
			}
			$resultado->close();
		}

		$doc_html = "";

		foreach ($bocadillos as $bocadillo_id => $valores) {
			// $doc_html .= '<div class="card mb-3">
			// 	<img src="./img/' . $valores["IMAGEN"] . '" class="card-img-top" alt="Imagen Bocadillo">
			// 	<div class="card-body">
			// 		<h5 class="card-title">' . $valores["NOMBRE"] . '</h5>
			// 		<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
			// 		<button type="button" class="btn btn-success">Comprar</button>
			// 		</div></div>';

			$doc_html .= '<div class="row g-0">
				<div class="col-md-4">
					<img src="./img/' . $valores["IMAGEN"] . '" class="w-75 p-3" alt="Imagen Bocadillo">
				</div>
				<div class="col-md-8">
					<div class="card-body">
						<h5 class="card-title">' . $valores["NOMBRE"] . '</h5>
						<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
						<button type="button" class="btn btn-success">Comprar</button>
					</div>
				</div>
			</div>';

		}

	?>

	<div class="container">
		<?php include("includes/inc_cabecera.php");
		echo $doc_html?>
		<!-- <div class="card mb-3">
			<img src="" class="card-img-top" alt="Imagen Bocadillo">
			<div class="card-body">
				<h5 class="card-title">Bocata</h5>
				<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
				<button type="button" class="btn btn-success">Success</button>
			</div>
		</div> -->
	</div>

	<?php include("includes/inc_pie.php") ?>
</body>
</html>