<?php
if (!$logeado || !isset($_GET['id'])) {

	header('Location: index.php');

} else {

	$id = $_GET['id'];
	include("includes/db.php");
	$query = "DELETE FROM Peliculas WHERE id=:id";
	$resultado = $con->prepare($query) ;
	$resultado ->bindvalue(":id",$id);
	$exec = $resultado -> execute();
	header("Location: crud.php");

}

?>