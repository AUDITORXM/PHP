<?php
// include('usuariosconfig.php');
$id = $_REQUEST['id'];
include("conexion.php");
$query = "DELETE FROM usuarios WHERE ID=:id";
$resultado = $mbd->prepare($query) ;
$resultado ->bindvalue(":id",$id);
$Exec = $resultado -> execute();
header("location:index.php");
?>