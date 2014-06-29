<?PHP include('seguridad.php');?>
<?php

include('conexion.php');
$cronica=str_replace("\n","<br />",$_REQUEST['cronica']);
include('backup.php');
switch ($_REQUEST['opera']) {
    case "m":
        $queEmp = "UPDATE partidos SET hora='" . $_REQUEST['hora'] . "',jugado='" . $_REQUEST['jugado'] . "',lugar='" . $_REQUEST['lugar'] . "',jornada='" . $_REQUEST['jornada'] . "'," . "local='" . $_REQUEST['local'] . "'," . "visitante='" . $_REQUEST['visitante'] . "'," . "goleslocal='" . $_REQUEST['goleslocal'] . "'," . "golesvisitante='" . $_REQUEST['golesvisitante'] . "'," . "fecha='" . $_REQUEST['fecha'] . "'," . "cronica='" . $cronica . "'," . "temporada='" . $_REQUEST['temporada'] . "' WHERE jornada='" . $_REQUEST['jornadaini'] . "' AND temporada='" . $_REQUEST['temporada'] . "'";
	$mensaje="Modificación de partido de jornada " . $_REQUEST['jornada'] . " temporada " . $_REQUEST['temporada'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Partidos','" . $mensaje . "')";
	$reslog = mysql_query($quelog, $conexion) or die(mysql_error()); 	
	break;
		
    case "a":
        $queEmp = "INSERT INTO partidos (jornada,local,visitante,goleslocal,golesvisitante,fecha,temporada,cronica,hora,jugado,lugar) VALUES ('" . $_REQUEST['jornada'] . "','" . $_REQUEST['local'] . "','" . $_REQUEST['visitante'] . "','" . $_REQUEST['goleslocal'] . "','" . $_REQUEST['golesvisitante'] . "','" . $_REQUEST['fecha'] . "','" . $_REQUEST['temporada'] . "','" . $cronica . "','" . $_REQUEST['hora'] . "','" . $_REQUEST['jugado'] . "','" . $_REQUEST['lugar'] . "')";
        $mensaje="Alta de partido de jornada " . $_REQUEST['jornada'] . " temporada " . $_REQUEST['temporada'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Partidos','" . $mensaje . "')";
	$reslog = mysql_query($quelog, $conexion) or die(mysql_error());         
        break;
    case "b":
        $queEmp = "DELETE FROM partidos WHERE jornada='" . $_REQUEST['jornadaini'] . "' AND temporada='" . $_REQUEST['temporada'] . "'";
        $mensaje="Borrado de partido de jornada " . $_REQUEST['jornada'] . " temporada " . $_REQUEST['temporada'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Partidos','" . $mensaje . "')";
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

print ('window.location="adminpartidos.php?listatemporadas=' . $_REQUEST['temporada'] . '"; ' . "\n");
print ('</script>');
?>