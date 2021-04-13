<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" href="img/tab_icon.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="css/styles.css">
	<title>El Broker</title>
</head>
	<body>

		<div id="login">
			<div class="container">
				<div id="login-row" class="row justify-content-center align-items-center">
					<div id="login-column" class="col-md-6">
						<div id="login-box" class="col-md-12">
							<form id="login-form" class="form" action="" method="post">
								<?php include('errors.php'); ?>
								<h3 class="text-center text-info">Login</h3>
								<div class="form-group">
									<label for="username" class="text-info">Usuario:</label><br>
									<input type="text" name="username" id="username" class="form-control">
								</div>
								<div class="form-group">
									<label for="password" class="text-info">Contraseña:</label><br>
									<input type="text" name="password" id="password" class="form-control">
								</div>
								<br>
								<div class="form-group">
									<input type="submit" name="login" class="btn btn-info btn-md" value="Iniciar Sesión">
								</div>
								<br>
								<div id="register-link" class="text-right">
									<a href="registro.php" class="text-info">Registrarse</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- <button id="iniciar" onclick="empezarJuego()">Empezar</button> -->
		</div>

		<p id="tiempo">Tiempo Restante: </p>

		<div id="contenido">
			<p id="capital">Efectivo Disponible: </p>
			<br>

			<p id="accion">Nº de Acciones: </p>
			<br>

			<p id="precio">Precio actual de la Acción: </p>
			<img src="" alt="movimiento_accion" id="img_precio">
			<br>

			<button id="comprar" onclick="comprarAccion()">Comprar</button>
			<button id="vender" onclick="venderAccion()">Vender</button>
			<br>
			<br>
			
			<p id="record">Récord Actual: </p>
		</div>

		<div id="repetir">
			<h3 id="texto">Qué desea hacer?</h3>
			<button id="seguir" onclick="repetir()">Seguir Jugando</button>
			<button id="salir" onclick="salir()">Salir del Juego</button>
		</div>

		<div id="myModal" class="modal">

			<div class="modal-content">
			  <span id="cerrar" class="close">&times;</span>
			  <p id="modal_msg">FELICIDADES USUARIO, HAS BATIDO UN NUEVO RÉCORD</p>
			  <img src="img/copa.png" alt="copa" id="copa">
			</div>
		  
		</div>

		<script src="js/scripts.js"></script>
	</body>
</html>