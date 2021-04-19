<?php
$ruta = $_SERVER['DOCUMENT_ROOT'] . '/kevin/ficheros/datos/datos.txt';
$lineas = file($ruta);
for ($i=0; $i<count($lineas);$i++) {
	echo "<p> Linea : $i | " . htmlspecialchars($lineas[$i]) . "</p>";
}
?>