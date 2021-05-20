<?php
include('db.php');
include('api.php');

$datos_peliculas = getPeliculas($token);

$id = $titulo = $sinopsis = $array_generos = $imagen = $precio = array();
$generos = '';
// SKU, NAME, DESCRIPTION, CATEGORIES, IMAGES, SALE/REGULAR PRICE

foreach ($datos_peliculas->results as $resultado) {

	// POR TEMAS DE LONGITUD EN EL TÍTULO NO PUEDO AÑADIR TODAS LAS PELÍCULAS
	if (strlen($resultado->title) <= 22) {

		array_push($id, $resultado->id);

		array_push($titulo, $resultado->title);

		array_push($sinopsis, $resultado->overview);

		$result_generos = getGeneros($resultado->genre_ids, $token);
		array_push($array_generos, $result_generos[0]);

		// POR TEMAS DE LONGITUD NO PUEDO AÑADIR TODAS LAS CATEGORÍAS - GÉNEROS
		// foreach ($result_generos as $genero_seleccionado) {
		// 	array_push($array_generos, $genero_seleccionado);
		// 	$generos .= $genero_seleccionado . ', ';
		// }

		// $generos = rtrim($generos, ', ');
		// array_push($array_generos, $generos);

		array_push($imagen, getImagenPelicula($resultado->poster_path));
		array_push($precio, rand(1, 10));

	}
}

$visible = 'visible';
$tax = 'taxable';
$stock = $backorders = $sold = $review = '1';

for ($i = 0; $i < count($id); $i++) {

	$num = $i+1;
	$stmt = $con->prepare('INSERT INTO Pelis_Woo (ID, SKU, Name, Description, Categories, Images, `Regular Price`, `Sale Price`, `Visibility in catalog`, `Tax status`, `In stock`, `Backorders allowed`, `Sold individually`, `Allow customer reviews`)
		VALUES ("' .
		($i+1) . '", "' .
		$id[$i] . '", "' .
		$titulo[$i] . '", "' .
		$sinopsis[$i] . '", "' .
		$array_generos[$i] . '", "' .
		$imagen[$i] . '", "' .
		$precio[$i] . '", "' .
		$precio[$i] . '", "visible", "taxable", "1", "1", "1", "1")');

	// var_dump($stmt);
	if (!$stmt->execute()) {

		$error = TRUE;
		print_r($stmt->errorInfo());

	}

}

if (!isset($error)) {
	echo "Películas introducidas con éxito";
}?>