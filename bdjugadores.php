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
        $queEmp = "UPDATE jugadores SET jugador='" . $_REQUEST['jugador'] . "'," . "fecha_nacimiento='" . $_REQUEST['fecha_nacimiento'] . "'," . "numero='" . $_REQUEST['numero'] . "'," . "temporadas='" . $_REQUEST['temporadas'] . "'," . "descripcion='" . $_REQUEST['descripcion'] . "', foto='" . $nombreCompleto . "', apodo='" . $_REQUEST['apodo'] . "', password='" . $_REQUEST['clave'] . "', correo='" . $_REQUEST['correo'] .  "' WHERE jugador='" . $_REQUEST['jugadorini'] . "' AND rango='" . $_REQUEST['rango'] . "'";
	$mensaje="Modificaci�n de jugador " . $_REQUEST['jugador'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Jugadores','" . $mensaje . "')";
	$reslog = mysql_query($quelog, $conexion) or die(mysql_error());	
	break;
		
    case "a":
        $queEmp = "INSERT INTO jugadores (jugador,fecha_nacimiento,numero,temporadas,descripcion,foto,apodo,password,correo,rango) VALUES ('" . $_REQUEST['jugador'] . "','" . $_REQUEST['fecha_nacimiento'] . "','" . $_REQUEST['numero'] . "','" . $_REQUEST['temporadas'] . "','" . $_REQUEST['descripcion'] . "','" . $nombreCompleto . "','" . $_REQUEST['apodo'] ."','" . $_REQUEST['clave'] . "','" . $_REQUEST['correo'] . "','" . $_REQUEST['rango'] . "')";
        $mensaje="Alta de jugador " . $_REQUEST['jugador'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Jugadores','" . $mensaje . "')";
	$reslog = mysql_query($quelog, $conexion) or die(mysql_error());
        break;
    case "b":
        $queEmp = "DELETE FROM jugadores WHERE jugador='" . $_REQUEST['jugadorini'] . "'";
        $mensaje="Borrado de jugador " . $_REQUEST['jugador'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Jugadores','" . $mensaje . "')";
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

print ('window.location="adminjugadores.php"; ' . "\n");
print ('</script>');
?>