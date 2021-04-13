<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("./includes/inc_config.php"); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Galería</title>
</head>
<body>

	<?php include("./includes/inc_cabecera.php"); ?>

	<h1>Galería de Ejemplos</h1>
	<h2>Origami - Papiroflexia</h2>

	<!-- 1ra tabla -->
	<table id="animales">
		<tr>
			<th colspan="5">Animales</th>
		</tr>
		<tr>
			<td><img src="img/aguila.png" alt="Águila">Águila</td>
			<td><img src="img/elefante.png" alt="Elefante">Elefante</td>
			<td><img src="img/caballo.png" alt="Caballo">Caballo</td>
			<td><img src="img/rana.png" alt="Rana">Rana</td>
			<td><img src="img/flamenco.png" alt="Flamenco">Flamenco</td>
		</tr>
	</table>

	<!-- 2da tabla -->
	<table id="varios">
		<tr>
			<th colspan="6">Varios</th>
		</tr>
		<tr>
			<td><img src="img/flores.png" alt="Flores">Flores</td>
			<td><img src="img/abstracto1.png" alt="Abstracto_1">Abstracto 1</td>
			<td><img src="img/abstracto2.png" alt="Caballo">Caballo</td>
			<td><img src="img/angel.png" alt="Angel">Ángel</td>
			<td><img src="img/camara.png" alt="Camara_De_Fotos">Cámara de Fotos</td>
			<td><img src="img/arbol.png" alt="Arbol">Árbol</td>
		</tr>
	</table>

	<?php include("./includes/inc_pie.php"); ?>

</body>
</html>