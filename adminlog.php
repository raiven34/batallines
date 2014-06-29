<? include('seguridad.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administraci&oacute;n Noticias</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="css/estilosweb.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?PHP 
session_start();
?>
<script type="text/javascript">
function update(formulario)
	{		
					if( eval('document.'+formulario+'.titulo.value')!= ''){ 
					eval('document.'+formulario+'.opera.value="m"');
					eval('document.'+formulario+'.submit()');
					}
					else{
						alert("T&iacute;tulo obligatorio");
					}
	}
function borrar(formulario)
	{		
					if (confirm("Seguro de eliminar el registro?")) {
					eval('document.'+formulario+'.opera.value="b"');
					eval('document.'+formulario+'.submit()');
					}
	}
function alta(formulario)
	{		
					if( eval('document.'+formulario+'.titulo.value')!= ''){ 
					eval('document.'+formulario+'.opera.value="a"');
					eval('document.'+formulario+'.submit()');
					}
					else{
						alert("T&iacute;tulo obligatorio");
					}
	}


</script>
<?PHP
if($_SESSION["rango"]>1){	  

include('conexion.php');

   // Establecer el n?mero de filas por p?gina y la fila inicial
      $num = 30; // n?mero de filas por p?gina
      $comienzo = $_REQUEST['comienzo'];
      if (!isset($comienzo)) $comienzo = 0;

   // Calcular el n?mero total de filas de la tabla
      $instruccion = "select * from log order by timestamp desc";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      $nfilas = mysql_num_rows ($consulta);

      if ($nfilas > 0)
      {

      // Mostrar n?meros inicial y final de las filas a mostrar
         print ("<P>Mostrando logs " . ($comienzo + 1) . " a ");
         if (($comienzo + $num) < $nfilas)
            print ($comienzo + $num);
         else
            print ($nfilas);
         print (" de un total de $nfilas.\n");

      // Mostrar botones anterior y siguiente
         $estapagina = $_SERVER['PHP_SELF'];
         if ($nfilas > $num)
         {
            if ($comienzo > 0)
               print ("[ <A HREF='$estapagina?comienzo=" . ($comienzo - $num) . "'>Anterior</A> | ");
            else
               print ("[ Anterior | ");
            if ($nfilas > ($comienzo + $num))
               print ("<A HREF='$estapagina?comienzo=" . ($comienzo + $num) . "'>Siguiente</A> ]\n");
            else
               print ("Siguiente ]\n");
         }
         print ("</P>\n");

      }

   // Enviar consulta
      $instruccion = "select * from log order by timestamp desc limit $comienzo, $num";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");

   // Mostrar resultados de la consulta
      $nfilas = mysql_num_rows ($consulta);
if ($nfilas > 0)
      {
     print ('<TABLE border="1">' . "\n");
     print ("<TR>\n");
     print ("<TH>Id</TH>\n");
     print ("<TH>Usuario</TH>\n");
     print ("<TH>Tipo</TH>\n");
     print ("<TH>Mensaje</TH>\n");
     print ("<TH>Fecha</TH>\n");

     print ("</TR>\n");
	for ($i=0; $i<$nfilas; $i++) {
   
            $resultado = mysql_fetch_array ($consulta);
			$texto=str_replace("<br />","\n",$resultado['texto']);
			$texto2=str_replace("<br />","\n",$resultado['texto2']);
			print ("<TR>\n");
			print ('<form id="form'. $i . '" ' . 'name="form'. $i . '" ' . 'method="post" action="bdlog.php" enctype="multipart/form-data">' . "\n");
			
			print ('<TD><input name="id" type="text" id="id" value=' ."'" . $resultado['id'] . "'" . 'size="6" readonly="readonly" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><input name="usuario" type="text" id="usuario" value=' ."'" . $resultado['usuario'] . "'" . 'size="15" readonly="readonly" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><input name="tipo" type="text" id="tipo" value=' ."'" . $resultado['tipo'] . "'" . 'size="20" readonly="readonly" />' . "\n");
			print ("</TD>\n");	
			
			print ('<TD><input name="mensaje" type="text" id="mensaje" value=' ."'" . $resultado['mensaje'] . "'" . 'size="150" readonly="readonly" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><input name="fecha" type="text" id="fecha" value=' ."'" . $resultado['timestamp'] . "'" . 'size="19" readonly="readonly" />' . "\n");
			print ("</TD>\n");					
			

			print ('<input name="opera" id="opera" type="hidden" />' . "\n");

			print ("</form>\n");
			print ("</TR>\n");

   
   }
print ("</TABLE>\n"); 
}
else
   print ("No hay noticias disponibles");
print ("<br/>\n");
print ("<br/>\n");
print ("<br/>\n");
print ("<br/>\n");

print ("<BR />\n");
print ('<a href="' . 'adminbatallines.php">Volver</a>' . "\n");
mysql_close($conexion);
}else{
	print ("No tienes permiso");	
}
?>

</body>
</html>
