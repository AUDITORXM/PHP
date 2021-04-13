<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("./includes/inc_config.php"); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Contáctanos</title>
</head>
<body>

	<?php include("./includes/inc_cabecera.php"); ?>

	<h1>Formulario de Contacto</h1>
	<h2>Aporta tus sugerencias y ayúdanos a mejorar</h2>
	<p>Nos gustaría seguir creciendo y para ello solicitamos tu colaboración. Tus sugerencias son valiosas para nosotros.</p>

	<!-- Formulario -->
	<form action="#">

		<img src="img/form.PNG" alt="Imagen_Formulario">

		<label for="nombre">Nombre:</label>
		<input type="text" name="nombre" id="nombre">

		<br>

		<label for="email">Email:</label>
		<input type="email" name="email" id="email">
		
		<br>

		<input type="radio" id="hombre" name="sexo" value="hombre">
		<label for="hombre">Hombre</label>

		<br>

		<input type="radio" id="mujer" name="sexo" value="mujer">
		<label for="mujer">Mujer</label>

		<br>

		<label for="conocer">Conozco la web por:</label>
		<select name="conocer" id="conocer">
			<option value="buscadores">Buscadores</option>
			<option value="amigos">Amigos</option>
			<option value="publi">Publicidad</option>
			<option value="otros">Otros</option>
		</select>

		<br>

		<label for="sugerencias" id="label_sugerencias">Sugerencias:</label>
		<textarea name="sugerencias" id="sugerencias" cols="60" rows="10"></textarea>

		<br>

		<button type="submit">Enviar</button>

	</form>

	<?php include("./includes/inc_pie.php"); ?>

</body>
</html>