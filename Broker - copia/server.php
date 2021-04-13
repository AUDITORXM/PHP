<?php
include('db.php');
session_start();

// ---------- Validar Nuevo Usuario ----------
if (isset($_POST["reg_user"])){

	$usuario = $_POST["username"];
	$pass1 = $_POST["password_1"];
	$pass2 = $_POST["password_2"];
	$errores = array();

	// Validar si usuario ya existe
	$query = "SELECT * FROM USUARIOS WHERE NOMBRE = '$usuario'";

	if ($resultado = $conn->query($query)){
		while ($obj = $resultado->fetch_assoc()) {
			array_push($errores, "Usuario ya existe");
		}
		$resultado->close();
	}

	if ($pass1 != $pass2){
		array_push($errores, "Las contraseñas introducidas son diferentes");
	}

	if (count($errores) == 0) {

		$pass = md5($pass1);

		$query = "INSERT INTO USUARIOS VALUES (NULL, '$usuario', '$pass', 0)";

		if ($conn->query($query) === TRUE) {
			echo "Usuario creado con éxito"
			sleep(3);
			header('location: index.php');
		} else {
			echo "Error:" . $query . "<br>" . $conn->error;
		}

	} else {

		foreach ($errores as $error) {
			echo "ERROR: " . $error;
		}

	}

}

// ---------- Login ----------

if (isset($_POST["login"])){

	$usuario = $_POST["username"];
	$pass = $_POST["password"];
	$errores = array();

	if (empty($usuario)){
		array_push($errores, "Nombre de Usuario no introducido");
	}

	if (empty($pass)){
		array_push($errores, "Contraseña no introducida");
	}

	if (count($errores) == 0){

		$query = "SELECT * FROM USUARIOS WHERE NOMBRE = '$usuario' AND PASS = '$pass'";

		if ($resultado = $conn->query($query)){

			$_SESSION['username'] = $usuario;
			$_SESSION['success'] = "Sesión Iniciada";

		}

	}

}