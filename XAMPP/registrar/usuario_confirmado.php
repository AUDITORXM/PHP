<?php
include('includes/inc_config.php');
include('includes/inc_cabecera.php');

if (isset($_GET['token']) && (isset($_GET['id']))){

	include('db.php');
	$id = $token = "";

	// $query = "SELECT LAST_INSERT_ID()"; Devuelve 0
	$query = "SELECT MAX(ID) as ID FROM usuarios";

	if ($resultado = $conn->query($query)){
		while ($obj = $resultado->fetch_assoc()) {
			$id = $obj["ID"];
		}
		$resultado->close();
	}

	$query = "SELECT Token FROM usuarios WHERE ID = " . $id;

	if ($resultado = $conn->query($query)){
		while ($obj = $resultado->fetch_assoc()) {
			$token = $obj["Token"];
		}
		$resultado->close();
	}

	if (strcmp($token, $_GET['token']) == 0 && strcmp($id, $_GET['id']) == 0){
		$query = "UPDATE usuarios SET Estado = 1 WHERE ID = " . $_GET['id'];

		if ($conn->query($query) === TRUE) {
			$estado = TRUE;
		}

		if (isset($estado) && $estado){
			echo "<h1>Cuenta Validada</h1><p>La cuenta se ha validado satisfactoriamente, muchas gracias.</p>";
		} else {
			echo "Ha habido algún error, inténtelo más tarde.";
		}
	} else {
		echo "Error con el identificador, reinténtelo más tarde.";
	}

} else {
	header("location: index.php");
}?>

<button class="btn btn-success" onclick="location.href = 'index.php';">Crear otra cuenta</button>

<?php include('includes/inc_pie.php');?>