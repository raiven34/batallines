<?PHP include('seguridad.php');?>
<?php
   // Subir fichero
      $copiarFichero = false;
	  $tamfich = 1024000;
   // Copiar fichero en directorio de ficheros subidos
   // Se renombra para evitar que sobreescriba un fichero existente
   // Para garantizar la unicidad del nombre se añade una marca de tiempo
      if (is_uploaded_file ($_FILES['foto']['tmp_name'])&& $_FILES['foto']['size']<$tamfich)
      {
         $nombreDirectorio = "img/";
         $nombreFichero = $_FILES['foto']['name'];
         $copiarFichero = true;

      // Si ya existe un fichero con el mismo nombre, renombrarlo
         $nombreCompleto = $nombreDirectorio . $nombreFichero;
         if (is_file($nombreCompleto))
         {
            $idUnico = time();
            $nombreFichero = $idUnico . "-" . $nombreFichero;
         }
       }
      // Mover fichero de imagen a su ubicación definitiva
         if ($copiarFichero){
            move_uploaded_file ($_FILES['foto']['tmp_name'],
            $nombreDirectorio . $nombreFichero);	  
         }
         else
            $nombreCompleto=$_REQUEST['fotoini'];
            
session_start();

include('conexion.php');
include('backup.php');
switch ($_REQUEST['opera']) {
    case "m":
        $queEmp = "UPDATE marquee SET id='" . $_REQUEST['titulo'] . "'," . "contenido='" . $_REQUEST['texto'] . "',activado=" . $_REQUEST['activado'] .   ", orden=" . $_REQUEST['orden'] . " WHERE id='" . $_REQUEST['tituloini'] . "'";
	$mensaje="Modificaci�n de Marquee " . $_REQUEST['tituloini'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Marquee','" . $mensaje . "')";
	$reslog = mysql_query($quelog, $conexion) or die(mysql_error());  	
	break;
		
    case "a":
        $queEmp = "INSERT INTO marquee (id,contenido,activado) VALUES ('" . $_REQUEST['titulo'] . "','" . $_REQUEST['texto'] . "','" . $_REQUEST['activado'] . "'," . $_REQUEST['orden'] . ")";
        $mensaje="Alta de marquee " . $_REQUEST['tituloini'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Marquee','" . $mensaje . "')";
	$reslog = mysql_query($quelog, $conexion) or die(mysql_error());  	
        break;
    case "b":
        $queEmp = "DELETE FROM marquee WHERE id='" . $_REQUEST['tituloini'] . "'";
        $mensaje="Borrado de marquee " . $_REQUEST['tituloini'];
	include('logbatallines.php');
 	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Marquee','" . $mensaje . "')";
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

if( $_FILES['imagen']['size']<$tamfich){	
	print ('alert("' . $registros . ' registro/s actualizado/s");' . "\n");
}
else 
	print ('alert("Registro actualizado sin imagen al ser de más de 1MB");' . "\n");

print ('window.location="adminmarquee.php"; ' . "\n");
print ('</script>');
?>