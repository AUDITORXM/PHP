<?php
include('includes/inc_config.php');

if (!$logeado || !isset($_GET['id'])) {

	header('Location: index.php');

} else {

	// ----- BORRAR FILAS DE LOS GÉNEROS QUE TIENE LA PELÍCULA -----
	$id = $_GET['id'];
	include("includes/db.php");
	$query = 'DELETE FROM Pelis_Generos WHERE pelicula = ' . $id;
	$resultado = $con->prepare($query);
	$exec = $resultado -> execute();

	// ----- BORRAR LA PELÍCULA -----
	$query = "DELETE FROM Peliculas WHERE id=:id";
	$resultado = $con->prepare($query);
	$resultado ->bindvalue(":id",$id);
	$exec = $resultado -> execute();
	header("Location: crud.php");

}
?>