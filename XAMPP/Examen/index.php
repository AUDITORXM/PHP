<script>
	function confirmar (mensaje) {
		return confirm(mensaje);
	}
</script>

<?php 
if (isset($_GET['excel'])) {
	$filename = 'Informe_' . date("Ymdhis") . '.xls';
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=\"$filename\"");
}

include('includes/inc_config.php');
include('includes/inc_cabecera.php');

try {
	include("conexion.php");

	echo '<table class="table table-striped table-hover align-middle text-center">';
	echo '<tr><th>Id</th><th>Nombre</th><th>Apellido</th><th>Login</th><th>Correo</th><th>Género</th><th>Fecha de Nacimiento</th><th>Teléfono</th><th>Fecha de Alta</th><th>Estado</th><th>Editar</th><th>Borrar</th></tr>';

	$query = 'SELECT usuarios.*, estados.Descripcion from usuarios, estados WHERE estados.ID = usuarios.Estado';

	foreach($mbd->query($query) as $fila) {
		echo '<tr>';

		echo '<td>' . $fila['ID'] . '</td>
			<td>' .  $fila['Nombre'] . '</td>
			<td>' .$fila['Apellido'] . '</td>
			<td>' .$fila['Usuario'] . '</td>
			<td>' . $fila['Correo'] . '</td>
			<td>' . $fila['Genero'] . '</td>
			<td>' . $fila['Fecha_nac'] . '</td>
			<td>' . $fila['Telefono'] . '</td>
			<td>' . $fila['Fecha_alta'] . '</td>
			<td>' . $fila['Descripcion'] . '</td>';

		echo '<td><a class="btn btn-primary" href="editar.php?id='.$fila['ID'].'">Editar</a></td>';

		echo '<td><a class="btn btn-danger" href="eliminar.php?id='.$fila['ID'].'" onclick="return confirmar(\'¿Está seguro que desea eliminar el registro con ID ' . $fila['ID'] . '?\')">Eliminar</a></td>';

		echo '</tr>';
	}

	$mbd = null;
	echo '</table>';
} catch (PDOException $e) {
	print "¡Error!: " . $e->getMessage() . "<br/>";
	die();
}
?>
<a class="btn btn-primary" href="insertar.php">Insertar nuevo usuario</a>
<br><br>
<a class="btn btn-success" href="index.php?excel=s">Generar Excel</a>

<?php include('includes/inc_pie.php');?>