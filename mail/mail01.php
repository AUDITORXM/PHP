<?php

	require ('config.php');

	if (mail($para, $titulo, $mensaje, $cabeceras)){
		echo 'Correo mandado con éxito';
	} else {
		echo 'Error al mandar correo';
	}
?>