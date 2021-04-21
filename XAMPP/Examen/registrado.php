<?php
include('includes/inc_config.php');
include('includes/inc_cabecera.php');

if (isset($_GET['token']) && (isset($_GET['id']))){

	include('conexion.php');
	$id = $token = "";

	// $query = "SELECT LAST_INSERT_ID()"; Devuelve 0
	$query = "SELECT MAX(ID) as ID FROM usuarios";

	foreach($mbd->query($query) as $fila){
		if (isset($fila)){
			$id = $fila['ID'];
		}
	}

	$query = "SELECT Token FROM usuarios WHERE ID = " . $id;

	foreach($mbd->query($query) as $fila){
		if (isset($fila)){
			$token = $fila['Token'];
		}
	}

	if (strcmp($token, $_GET['token']) == 0 && strcmp($id, $_GET['id']) == 0){

		$query = "UPDATE usuarios SET Estado = 1 WHERE ID = " . $_GET['id'];
		$resultado = $mbd->prepare($query);

		if ($exec = $resultado -> execute()){
			$estado = TRUE;
		}

		if (isset($estado) && $estado){
			echo "<p>La cuenta se ha validado satisfactoriamente, muchas gracias.</p>";
		} else {
			echo "Ha habido algún error, inténtelo más tarde.";
		}
	} else {
		echo "Error con el identificador, reinténtelo más tarde.";
	}

} else {
	header("location: index.php");
}?>

<button class="btn btn-success" onclick="location.href = 'index.php';">Ver usuarios</button>

<?php include('includes/inc_pie.php');?>