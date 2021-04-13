<?php
	if (!isset($_COOKIE['redireccionado'])){
		if ($_COOKIE['redireccionado'] == 0){
			setcookie('redireccionado', 1);
			if (isset($_COOKIE['pagina']) && $_COOKIE['pagina'] != $_SERVER['PHP_SELF']){
				header('location: ' . $_COOKIE['pagina']);
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php include("./includes/inc_config.php"); ?>
	<title>Cookies</title>
</head>
<body>
	<?php include("./includes/inc_cabecera.php"); ?>
	<?php
		if (!isset($_COOKIE['contador'])) {
			$cookie = 1;
			setcookie('contador', $cookie, time()+60*60*24*30);
		} else {
			$cookie = ++$_COOKIE['contador'];
			setcookie('contador', $cookie, time()+60*60*24*30);
		}
	?>
	<h1>Cookies</h1>
	<p>Esto es el index</p>
	<?php echo '<p>Número de veces que has entrado en la página: ' . $_COOKIE['contador'] . '</p>';?>
	<h2>Temas</h2>
	<button id="btn1">Tema 1</button>
	<button id="btn2">Tema 2</button>
	<button id="btn3">Tema 3</button>
	<button id="btn4">Tema 4</button>
	<?php  include("./includes/inc_pie.php"); ?>
</body>
</html>