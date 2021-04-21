<?php
// include('usuariosconfig.php');
$id = $_REQUEST['id'];

include("conexion.php");

$accion = 'Modificar';
$query = "SELECT * FROM usuarios WHERE id =:id";
$resultado = $mbd -> prepare($query);
$resultado -> bindvalue(":id",$id);
$Exec = $resultado -> execute();
$fila = $resultado -> fetch();
$correo = $fila['Correo'];
$password = $fila['Password'];
$nombre = $fila['Nombre'];
$apellido = $fila['Apellido'];
$usuario = $fila['Usuario'];
$fecha_nac = $fila['Fecha_nac'];
$telefono = $fila['Telefono'];

include("formulario.php");
?>