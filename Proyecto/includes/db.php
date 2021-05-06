<?php
$dbname='Kevin';
$user='usuario1';
$pass='usuario1';
$con = new PDO('mysql:host=localhost;dbname='.$dbname, $user, $pass);

if (!$con) {
	die('Error contectando a la Base de Datos');
}
?>