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
if($_SESSION["rango"]>0){	  

include('conexion.php');

   // Establecer el n?mero de filas por p?gina y la fila inicial
      $num = 5; // n?mero de filas por p?gina
      $comienzo = $_REQUEST['comienzo'];
      if (!isset($comienzo)) $comienzo = 0;

   // Calcular el n?mero total de filas de la tabla
      $instruccion = "select * from noticias order by fecha desc";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      $nfilas = mysql_num_rows ($consulta);

      if ($nfilas > 0)
      {

      // Mostrar n?meros inicial y final de las filas a mostrar
         print ("<P>Mostrando noticias " . ($comienzo + 1) . " a ");
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
      $instruccion = "select * from noticias order by fecha desc limit $comienzo, $num";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");

   // Mostrar resultados de la consulta
      $nfilas = mysql_num_rows ($consulta);
if ($nfilas > 0)
      {
     print ('<TABLE border="1">' . "\n");
     print ("<TR>\n");
     print ("<TH>T&iacute;tulo</TH>\n");
     print ("<TH>Texto</TH>\n");
     print ("<TH>Texto2</TH>\n");
     print ("<TH>Ruta del Foro</TH>\n");
     print ("<TH>Fecha</TH>\n");
     print ("<TH>Imagen</TH>\n");
	 print ("<TH>Autor</TH>\n");
     print ("</TR>\n");
	for ($i=0; $i<$nfilas; $i++) {
   
            $resultado = mysql_fetch_array ($consulta);
			$texto=str_replace("<br />","\n",$resultado['texto']);
			$texto2=str_replace("<br />","\n",$resultado['texto2']);
			print ("<TR>\n");
			print ('<form id="form'. $i . '" ' . 'name="form'. $i . '" ' . 'method="post" action="bdnoticias.php" enctype="multipart/form-data">' . "\n");
//			print ('<TD><span id="sprytextfield1">' . "\n");
			print ('<TD><input name="titulo" type="text" id="titulo" value=' ."'" . $resultado['titulo'] . "'" . 'size="40" maxlength="40" />' . "\n");
//			print ('<span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span>' . "\n");
			print ("</TD>\n");
			
			
			print ('<TD><span id="sprytextarea' . $i . '">' . "\n");
			print ('<textarea name="texto" id="texto" cols="45" rows="5">' . $texto . "</textarea>\n");
			print ('<span id="countsprytextarea' . $i . '"></span>' . "\n");
			print ("</TD>\n");
			
			print ('<TD><textarea name="texto2" id="texto2" cols="45" rows="5">' . $texto2 . "</textarea>\n");
			print ("</TD>\n");
			
//			print ('<TD><span id="sprytextfield5">' . "\n");
			print ('<TD><input name="rutaforo" type="text" id="rutaforo"  value="' . $resultado['rutaforo'] . '" size="30" maxlength="100"/>' . "\n");
//			print ('<span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>' . "\n");
			print ("</TD>\n");
			
//			print ('<TD><span id="sprytextfield2">' . "\n");
			print ('<TD><input name="fecha" type="text" id="fecha"  value="' . $resultado['fecha'] . '" size="19" readonly="readonly"/>' . "\n");
//			print ('<span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>' . "\n");
			print ("</TD>\n");
			
//			print ('<TD><span id="sprytextfield3">' . "\n");
			print ('<TD><img width="95px" height="95px" src="' . $resultado['imagen'] . '" /><input name="imagen" type="FILE" id="imagen" value="' . $resultado['imagen'] . '" size="30" maxlength="100" />' . "\n");
			print ("</TD>\n");
			
//			print ('<TD><span id="sprytextfield4">' . "\n");
			print ('<TD><input name="autor" type="text" id="autor" value="' . $resultado['autor'] . '" size="30" maxlength="30" readonly="readonly"/>' . "\n");
			print ("</TD>\n");
			print ('<input name="opera" id="opera" type="hidden" />' . "\n");
			print ('<input name="tituloini" id="tituloini"  type="hidden" value=' ."'" . $resultado['titulo'] . "'" . '" />' . "\n");
			print ('<input name="imagenini" id="imagenini" type="hidden" value="' . $resultado['imagen'] . '" />' . "\n");

			print ('<TD><img height="16px" width="16px" src="b_drop.png" title="Borrar" onclick= " borrar(' . " 'form" . $i . "')" . '"/></TD>' . "\n");
			print ('<TD><img name="' . $i .'"' . 'height="16px" width="16px" src="modificar.png" title="Actualizar" onclick= " update(' . " 'form" . $i . "')" . '"/></TD>');
			print ("</form>\n");
			print ("</TR>\n");
			print ('<script type="text/javascript">');
			print ('var sprytextarea' . $i . '= new Spry.Widget.ValidationTextarea("sprytextarea' . $i . '", {maxChars:1000, counterType:"chars_remaining", counterId:"countsprytextarea' . $i . '"});');
			print ('</script>');
   
   }
print ("</TABLE>\n"); 
}
else
   print ("No hay noticias disponibles");
print ("<br/>\n");
print ("<br/>\n");
print ("<br/>\n");
print ("<br/>\n");
print ('<form id="formalta" name="formalta" method="post" action="bdnoticias.php" enctype="multipart/form-data">' . "\n");
//print ('<span id="sprytextfield1">' . "\n");
print('<a class="tituloficha">Alta noticia</a>');
print ('<TABLE border="1">' . "\n");
print ("	<TR>\n");
print ("	<TH>T&iacute;tulo</TH>\n");
print ("	<TH>Texto</TH>\n");
print ("	<TH>Texto2</TH>\n");
print ("	<TH>Ruta del Foro</TH>\n");
print ("	<TH>Imagen</TH>\n");
print ("	<TH>Autor</TH>\n");
print ("	</TR>\n");
print ("	<TR>\n");
print ('	<TD><input name="titulo" type="text" id="titulo" size="40" maxlength="40" /></TD>');
print ("\n");

print ('	<TD><span id="sprytextareaalta">
	   <textarea name="texto" id="texto" cols="45" rows="5"></textarea>
	   <span id="countsprytextareaalta"></span></TD>');
print ("\n");

print ('<TD><textarea name="texto2" id="texto2" cols="45" rows="5"></textarea></TD>');
print ("\n");				
			
//print ('<span id="sprytextfield5">' . "\n");
print ('	<TD><input name="rutaforo" type="text" id="rutaforo" size="30" maxlength="100"/></TD>' . "\n");
//print ('<span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>' . "\n");


//print ('<span id="sprytextfield2">' . "\n");
//print ('	<TD><input name="fecha" type="text" id="fecha" value="' . date("Y-m-d H:i:s") . '" size="19" readonly="readonly"/></TD>' . "\n");
//print ('<span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>' . "\n");
			
//print ('<span id="sprytextfield3">' . "\n");
print ('	<TD><input name="imagen" type="FILE" id="imagen" size="30" maxlength="100" /></TD>' . "\n");
			
//print ('<span id="sprytextfield4">' . "\n");
print ('	<TD><input name="autor" type="text" id="autor" size="30" maxlength="30" value= "' . $_SESSION["usuario"] . '" readonly="readonly"/></TD>' . "\n");

print ('<input name="opera" id="opera" type="hidden" />' . "\n");

print ('	<TD><img height="16px" width="16px" src="alta.png" title="A?adir" onclick= " alta(' . "'formalta')" . '" /></TD>' . "\n");
print ("</TR>\n");
print ("</TABLE>\n");
print ("</form>\n");
print ("<BR />\n");
print ('<a href="' . 'adminbatallines.php">Volver</a>' . "\n");
print ('<script type="text/javascript">');
print ('var sprytextareaalta= new Spry.Widget.ValidationTextarea("sprytextareaalta", {maxChars:1000, counterType:"chars_remaining", counterId:"countsprytextareaalta"});');
print ('</script>');
mysql_close($conexion);
}else{
	print ("No tienes permiso");	
}
?>

</body>
</html>