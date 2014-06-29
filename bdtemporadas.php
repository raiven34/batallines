<?PHP include('seguridad.php');?>
<?php

include('conexion.php');
include('backup.php');
switch ($_REQUEST['opera']) {
    case "m":
	$queEmp = "UPDATE temporadas SET" . " temporada='" . $_REQUEST['temporada'] . "',division='" . $_REQUEST['division'] . "' WHERE temporada='" . $_REQUEST['temporadaini'] . "'";
	$mensaje="Modificación de temporadas: temporada " . $_REQUEST['temporadaini'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Temporadas','" . $mensaje . "')";
	$reslog = mysql_query($quelog, $conexion) or die(mysql_error());   				
	break;
		
    case "a":
        $queEmp = "INSERT INTO temporadas (temporada,division) VALUES ('" . $_REQUEST['temporada'] . "','" . $_REQUEST['division'] . "')";
        $mensaje="Alta de temporadas: temporada" . $_REQUEST['temporada'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Temporadas','" . $mensaje . "')";
	$reslog = mysql_query($quelog, $conexion) or die(mysql_error());   	        
        break;
    case "b":
        $queEmp = "DELETE FROM temporadas WHERE temporada='" . $_REQUEST['temporadaini'] . "'";
        $mensaje="Borrado de temporadas: de temporada " . $_REQUEST['temporadaini'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Temporadas','" . $mensaje . "')";
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

print ('window.location="admintemporadas.php?listatemporadas=' . $_REQUEST['temporadaini'] . '"' . "\n");
print ('</script>');
?>