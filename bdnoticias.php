<?PHP include('seguridad.php');?>
<?php
date_default_timezone_set('Europe/Madrid');
   // Subir fichero
      $copiarFichero = false;
	  $tamfich = 1024000;
   // Copiar fichero en directorio de ficheros subidos
   // Se renombra para evitar que sobreescriba un fichero existente
   // Para garantizar la unicidad del nombre se aÃ±ade una marca de tiempo
      if (is_uploaded_file ($_FILES['imagen']['tmp_name'])&& $_FILES['imagen']['size']<$tamfich)
      {
         $nombreDirectorio = "img/";
         $nombreFichero = $_FILES['imagen']['name'];
         $copiarFichero = true;

      // Si ya existe un fichero con el mismo nombre, renombrarlo
         $nombreCompleto = $nombreDirectorio . $nombreFichero;
         if (is_file($nombreCompleto))
         {
            $idUnico = time();
            $nombreFichero = $idUnico . "-" . $nombreFichero;
         }
       }
      // Mover fichero de imagen a su ubicaciÃ³n definitiva
         if ($copiarFichero){
            move_uploaded_file ($_FILES['imagen']['tmp_name'],
            $nombreDirectorio . $nombreFichero);	  
         }
         else
            $nombreCompleto=$_REQUEST['imagenini'];
            
session_start();

include('conexion.php');
$texto=str_replace("\n","<br />",$_REQUEST['texto']);
$texto2=str_replace("\n","<br />",$_REQUEST['texto2']);
include('backup.php');
switch ($_REQUEST['opera']) {
    case "m":
        $queEmp = "UPDATE noticias SET titulo='" . $_REQUEST['titulo'] . "'," . "texto='" . $texto . "', texto2='" . $texto2 . "', fecha='" . $_REQUEST['fecha'] . "'," . "imagen='" . $nombreCompleto . "'," . "autor='" . $_REQUEST['autor'] . "', rutaforo='" . $_REQUEST['rutaforo'] . "' WHERE titulo='" . $_REQUEST['tituloini'] . "' AND fecha='" . $_REQUEST['fecha'] . "'";
	$mensaje="Modificación de noticia " . $_REQUEST['titulo'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Noticias','" . $mensaje . "')";
	$reslog = mysql_query($quelog, $conexion) or die(mysql_error());  	
	break;
		
    case "a":
        $queEmp = "INSERT INTO noticias (titulo,texto,texto2,fecha,imagen,autor,rutaforo) VALUES ('" . $_REQUEST['titulo'] . "','" . $texto . "','" . $texto2 . "','" . date("Y-m-d H:i:s") . "','" . $nombreCompleto . "','" . $_REQUEST['autor'] . "','" . $_REQUEST['rutaforo'] . "')";
        $mensaje="Inserción de noticia " . $_REQUEST['titulo'];
	include('logbatallines.php');
	$quejugadores="select * from jugadores where rango>0";
	$resjugadores = mysql_query($quejugadores, $conexion) or die(mysql_error());
	$nfilas = mysql_num_rows ($resjugadores);
	$destinatario="";
        for ($i=0; $i<$nfilas; $i++) {
		$resultado = mysql_fetch_array ($resjugadores);
		$destinatario.= $resultado['correo'] . ",";
	}
        $asunto="Nueva noticia publicada";
	$texto="<p>" . $_SESSION['usuario'] . ", ha publicado una nueva noticia</p><p><a href='http://batallines.es/'>http://batallines.es/</a></p>";
	include('mail.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Noticias','" . $mensaje . "')";
	$reslog = mysql_query($quelog, $conexion) or die(mysql_error());         
        break;
    case "b":
        $queEmp = "DELETE FROM noticias WHERE titulo='" . $_REQUEST['tituloini'] . "' AND fecha='" . $_REQUEST['fecha'] . "'";
        $mensaje="Borrado de noticia " . $_REQUEST['titulo'];
	include('logbatallines.php');
	$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Noticias','" . $mensaje . "')";
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
	print ('alert("Registro actualizado sin imagen al ser de mÃ¡s de 1MB");' . "\n");

print ('window.location="admin.php"; ' . "\n");
print ('</script>');
?>