<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

	header('Location: index.html');

} else {

	$nombre = $_POST['nombre'];
	$suministrador = $_POST['suministrador'];
	$precio = $_POST['precio'];
	$descripcion = $_POST['descripcion'];
	$enlace = $_POST['enlace'];

	if (!validaciones($nombre, $suministrador, $precio, $descripcion, $enlace)) {

		echo "Ha habido un error con los datos, inténtelo de nuevo";
		echo '<a class="btn btn-primary" href="index.php">Volver al formulario</a>';

	} else {

		$datos = array(
			"fields" => array(
				"Nombre" => $nombre,
				"Suministrador" => $suministrador,
				"Precio" => intval($precio),
				"Descripcion" => $descripcion,
				"Link" => $enlace
			)
		);

		$json = json_encode($datos);

		$ch = curl_init("https://api.airtable.com/v0/appvadnWof1bng7rZ/Productos?api_key=key0Ao33ailCbl1Us");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json'
		));

		$resultado = curl_exec($ch);

		if($resultado === FALSE) {
			echo 'Curl error: ' . curl_error($ch);
		} else {
			echo 'Operación completada exitosamente';
			echo '<br><a class="btn btn-primary" href="index.php">Introducir otro Producto</a><br>';
			echo '<a class="btn btn-secondary" href="https://auditorxmproductos.appgyverapp.com">Ver los Productos</a>';
		}

		curl_close($ch);

	}

}

function validaciones($nombre, $suministrador, $precio, $descripcion, $enlace) {

	$campos = array($nombre, $suministrador, $precio, $descripcion, $enlace);
	$valido = TRUE;

	foreach ($campos as $campo) {
		// Si el campo es sólo un espacio en blanco
		if (ctype_space($campo)) {
			$valido = FALSE;
		}
	}

	// Validamos el nombre y suministrador
	if (!filter_var($nombre, FILTER_SANITIZE_STRING) || !filter_var($suministrador, FILTER_SANITIZE_STRING) || !filter_var($descripcion, FILTER_SANITIZE_STRING)) {
		$valido = FALSE;
	}

	if (!filter_var($precio, FILTER_SANITIZE_NUMBER_INT) || !filter_var($precio, FILTER_SANITIZE_NUMBER_FLOAT)) {
		$valido = FALSE;
	}
	
	if (!filter_var($enlace, FILTER_SANITIZE_URL)) {
		$valido = FALSE;
	}

	return $valido;

}

?>