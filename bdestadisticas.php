<?PHP include('seguridad.php');?>
<?php
	  
include('conexion.php');

include('backup.php');
switch ($_REQUEST['opera']) {
    case "m":
		$queEmp = "UPDATE estadisticas SET" . " nopresentado='" . $_REQUEST['nopresentado'] . "'," . "goles='" . $_REQUEST['goles'] . "', asistencias='" . $_REQUEST['asistencias'] . "'," . "amarillas='" . $_REQUEST['amarillas'] . "'," . "rojas='" . $_REQUEST['rojas'] . "' WHERE jornada='" . $_REQUEST['jornada'] . "' AND temporada='" . $_REQUEST['temporada'] . "' AND jugador='" . $_REQUEST['jugador'] . "'";
		$mensaje="Modificación de estadistica de jornada " . $_REQUEST['jornada'] . " temporada " . $_REQUEST['temporada'] ." jugador " . $_REQUEST['jugador'];
		include('logbatallines.php');
		$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Estadísticas','" . $mensaje . "')";
		$reslog = mysql_query($quelog, $conexion) or die(mysql_error());		
	break;
		
    case "a":
        $queEmp = "INSERT INTO estadisticas (jugador,jornada,temporada,nopresentado,goles,asistencias,amarillas,rojas) VALUES ('" . $_REQUEST['jugador'] . "'," . $_REQUEST['jornada'] . ",'" . $_REQUEST['temporada'] . "','" . $_REQUEST['nopresentado'] . "','" . $_REQUEST['goles'] . "','" . $_REQUEST['asistencias'] . "','" . $_REQUEST['amarillas'] . "','" . $_REQUEST['rojas'] . "')";
        $mensaje="Alta de estadistica de jornada " . $_REQUEST['jornada'] . " temporada " . $_REQUEST['temporada'] ." jugador " . $_REQUEST['jugador'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Estadísticas','" . $mensaje . "')";
	$reslog = mysql_query($quelog, $conexion) or die(mysql_error());
        break;
    case "b":
        $queEmp = "DELETE FROM estadisticas WHERE jornada='" . $_REQUEST['jornada'] . "' AND temporada='" . $_REQUEST['temporada'] . "' AND jugador='" . $_REQUEST['jugador'] . "'";
        $mensaje="Borrado de estadistica de jornada " . $_REQUEST['jornada'] . " temporada " . $_REQUEST['temporada'] ." jugador " . $_REQUEST['jugador'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Estadísticas','" . $mensaje . "')";
	$reslog = mysql_query($quelog, $conexion) or die(mysql_error());	
        break;
    default:
       echo "Error en parametros";
}
$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$registros = mysql_affected_rows();
mysql_query("COMMIT");
mysql_close($conexion);
print ('<script type="text/javascript">' . "\n");

print ('alert("' . $registros . ' registro/s actualizado/s");' . "\n");

print ('window.location="adminestadisticas.php?temporada=' . $_REQUEST['temporada'] . '&jornada=' . $_REQUEST['jornada'] . '";' . "\n");
print ('</script>');
?>