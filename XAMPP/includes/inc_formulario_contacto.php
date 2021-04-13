<form action="respuesta.php" method="post">
	<div class="form-group">
		<label for="nombre" class="form-label">Nombre:</label>
		<input type="text" class="form-control" name="nombre" id="nombre" required="true">
	</div>
	<div class="form-group">
		<label for="email" class="form-label">Email:</label>
		<input type="email" class="form-control" name="email" id="email" required="true">
	</div>
	<div class="form-group">
		<label for="" class="form-label">Sexo:</label>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="hm" id="h" value="h" checked>
			<label class="form-check-label" for="h">Hombre</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="hm" id="m" value="m">
			<label class="form-check-label" for="m">Mujer</label>
		</div>
	</div>
	<br>
	<div class="form-group">
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" name="html" value="html">
			<label class="form-check-label" for="html">HTML</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" name="css" value="css">
			<label class="form-check-label" for="css">CSS</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" name="js" value="js">
			<label class="form-check-label" for="js">JS</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" name="php" value="php">
			<label class="form-check-label" for="php">PHP</label>
		</div>
	</div>
	<div class="form-group">
		<label for="observacion">Observaciones:</label>
		<textarea class="form-control" name="observacion" id="observacion" rows="3"></textarea>
	</div>
		<button type="submit" class="btn btn-primary" value="Enviar">Enviar</button>
		<button type="reset" class="btn btn-secondary" value="Borrar">Borrar</button>
</form>

<!-- <form action="respuesta.php" method="post">
	<p>Nombre: <input type="text" name="nombre" size="40" required="true"></p>
	<p>Correo: <input type="email" name="correo" size="40" required="true"></p>
	<p>Año de nacimiento: <input type="number" name="nacido" min="1900" max="2021"></p>
	<p>Sexo:
		<input type="radio" name="hm" value="h" checked="checked"> Hombre
		<input type="radio" name="hm" value="m"> Mujer
	</p>
	<p>Conocimientos:
		<input type="checkbox" name="html" value="html"> HTML
		<input type="checkbox" name="css" value="css"> CSS
		<input type="checkbox" name="js" value="js"> JavaScript
		<input type="checkbox" name="php" value="php"> PHP
	</p>
	<p>Observaciones
		<textarea name="observacion"></textarea>
	</p>

	<p>
		<input type="submit" value="Enviar">
		<input type="reset" value="Borrar">
	</p>
</form> -->