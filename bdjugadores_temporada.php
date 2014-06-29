<?PHP include('seguridad.php');?>
<?php

include('conexion.php');
include('backup.php');
switch ($_REQUEST['opera']) {
    case "m":
	$queEmp = "UPDATE jugadores_temporada SET" . " jugador='" . $_REQUEST['jugador'] . "' WHERE temporada='" . $_REQUEST['temporadaini'] .  "' AND jugador='" . $_REQUEST['jugadorini'] . "'";
	$mensaje="Modificación de jugadores_temporada: jugador " . $_REQUEST['jugadorini'] . " de temporada " . $_REQUEST['temporadaini'];
	include('logbatallines.php');	
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Jugadores_temporada','" . $mensaje . "')";
	$reslog = mysql_query($quelog, $conexion) or die(mysql_error());	
	break;
		
    case "a":
        $queEmp = "INSERT INTO jugadores_temporada (jugador,temporada) VALUES ('" . $_REQUEST['listajugadores'] . "','" . $_REQUEST['temporadaini'] . "')";
        $mensaje="Alta de jugadores_temporada: jugador" . $_REQUEST['jugador'] . " temporada " . $_REQUEST['temporadaini'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Jugadores_temporada','" . $mensaje . "')";
	$reslog = mysql_query($quelog, $conexion) or die(mysql_error());        
        break;
    case "b":
        $queEmp = "DELETE FROM jugadores_temporada WHERE temporada='" . $_REQUEST['temporadaini'] . "' AND jugador='" . $_REQUEST['jugadorini'] . "'";
        $mensaje="Borrado de jugadores_temporada: de jugador " . $_REQUEST['jugadorini'] . " temporada " . $_REQUEST['temporadaini'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Jugadores_temporada','" . $mensaje . "')";
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

print ('window.location="adminjugadores_temporada.php?listatemporadas=' . $_REQUEST['temporadaini'] . '"' . "\n");
print ('</script>');
?>