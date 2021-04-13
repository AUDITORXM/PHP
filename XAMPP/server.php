<!DOCTYPE html>
<html lang="es">
<head>
	<?php include("./includes/inc_config.php"); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Información del Usuario</title>
</head>
<body>
	<?php include("./includes/inc_cabecera.php"); ?>
	<h1>Información del Usuario</h1>

	<?php

		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		function getNavegador(){

			global $user_agent;

			if(strpos($user_agent, 'MSIE') !== FALSE)
				$navegador = 'Internet Explorer';
			elseif(strpos($user_agent, 'Trident') !== FALSE)
				$navegador = 'Internet explorer';
			elseif(strpos($user_agent, 'Firefox') !== FALSE)
				$navegador = 'Mozilla Firefox';
			elseif(strpos($user_agent, 'Chrome') !== FALSE)
				$navegador = 'Google Chrome';
			elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
				$navegador = "Opera Mini";
			elseif(strpos($user_agent, 'Opera') !== FALSE)
				$navegador = 'Opera';
			elseif(strpos($user_agent, 'Safari') !== FALSE)
				$navegador = 'Safari';
			else
				$navegador = 'Navegador no detectado';
			
			return $navegador;

		}

		function getSO(){

			global $user_agent;

			$so = "Sistema Operativo desconocido";

			$so_array = array(
				'/windows nt 10/i'      =>  'Windows 10',
				'/windows nt 6.3/i'     =>  'Windows 8.1',
				'/windows nt 6.2/i'     =>  'Windows 8',
				'/windows nt 6.1/i'     =>  'Windows 7',
				'/windows nt 6.0/i'     =>  'Windows Vista',
				'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
				'/windows nt 5.1/i'     =>  'Windows XP',
				'/windows xp/i'         =>  'Windows XP',
				'/windows nt 5.0/i'     =>  'Windows 2000',
				'/windows me/i'         =>  'Windows ME',
				'/win98/i'              =>  'Windows 98',
				'/win95/i'              =>  'Windows 95',
				'/win16/i'              =>  'Windows 3.11',
				'/macintosh|mac os x/i' =>  'Mac OS X',
				'/mac_powerpc/i'        =>  'Mac OS 9',
				'/linux/i'              =>  'Linux',
				'/ubuntu/i'             =>  'Ubuntu',
				'/iphone/i'             =>  'iPhone',
				'/ipod/i'               =>  'iPod',
				'/ipad/i'               =>  'iPad',
				'/android/i'            =>  'Android',
				'/blackberry/i'         =>  'BlackBerry',
				'/webos/i'              =>  'Mobile'
			);

			foreach ($so_array as $regex => $tipo_so)
				if (preg_match($regex, $user_agent))
					$so = $tipo_so;

			return $so;

		}

		function getIP(){

			$dirIP = $_SERVER['REMOTE_ADDR'];

			return $dirIP;

		}

		function getLenguaje(){

			$lenguaje = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
			$opcionesLenguaje = ['es', 'fr', 'en', 'it'];
			$lenguaje = in_array($lenguaje, $opcionesLenguaje) ? $lenguaje : 'en';

			switch ($lenguaje) {
				case 'es':
					$lenguaje = 'Español';
					break;
				case 'fr':
					$lenguaje = 'Francés';
					break;

				case 'en':
					$lenguaje = 'Inglés';
					break;

				case 'it':
					$lenguaje = 'Italiano';
					break;
				default:
					$lenguaje = 'No encontrado';
					break;
			}

			return $lenguaje;

		}

		function getHoraServer(){

			date_default_timezone_set("Europe/Berlin");
			$horaServer = date("h:i:sa");
			return $horaServer;

		}

		function getNombre(){

			$nombre = 'Ni idea, tu IP no está registrada';

			$lista_nombres = array(
				'172.17.11.23' => 'Lander',

				'172.17.11.2' => 'Ander M',

				'172.17.11.8' => 'Ander G',

				'172.17.11.16' => 'Kevin',

				'172.17.11.17' => 'Mikel U',

				'172.17.11.12' => 'Elizabeth',

				'172.17.11.18' => 'Orlando',

				'172.17.11.6' => 'Richard',

				'172.17.11.11' => 'Rafael',

				'172.17.11.9' => 'Arantza',

				'172.17.11.5' => 'Sergio',

				'172.17.11.15' => 'Imanol',

				'172.17.11.20' => 'Mikel S',

				'172.17.15.6' => 'Alberto'
			);

			foreach ($lista_nombres as $ip => $usuario_ip) {
				
				if (strcmp($ip, $_SERVER['REMOTE_ADDR']) == 0){
					$nombre = $usuario_ip;
				}

			}

			return $nombre;

		}

		function getTipoConexion(){

			$dirIP = $_SERVER['REMOTE_ADDR'];

			if (!filter_var($dirIP, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)){
				$mensajeAcceso = 'Red Local';
			} else {
				$mensajeAcceso = 'Internet';
			}

			return $mensajeAcceso;

		}

	?>

	<p>Estás usando el navegador: <?php echo getNavegador() ?></p>
	<p>Tu Sistema Operativo es: <?php echo getSO() ?></p>
	<p>Tu dirección IP es: <?php echo getIP() ?></p>
	<p>El lenguaje es: <?php echo getLenguaje() ?></p>
	<p>La hora del servidor es: <?php echo getHoraServer() ?></p>
	<p>Tu nombre es: <?php echo getNombre() ?></p>
	<p>Estás accediendo desde <?php echo getTipoConexion() ?></p>

	<?php include("./includes/inc_pie.php"); ?>
</body>
</html>