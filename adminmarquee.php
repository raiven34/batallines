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
if($_SESSION["rango"]>1){
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
	  
include('conexion.php');

   // Establecer el n?mero de filas por p?gina y la fila inicial
      $num = 5; // n?mero de filas por p?gina
      $comienzo = $_REQUEST['comienzo'];
      if (!isset($comienzo)) $comienzo = 0;

   // Calcular el n?mero total de filas de la tabla
      $instruccion = "select * from marquee order by orden";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      $nfilas = mysql_num_rows ($consulta);
      
   // Calcular el n?mero total de filas de la tabla
      $temporadas = "select * from temporadas";
      $contemp = mysql_query ($temporadas, $conexion)
         or die ("Fallo en la consulta");
      $ntemp = mysql_num_rows ($contemp);

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
      $instruccion = "select * from marquee order by orden limit $comienzo, $num";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");

   // Mostrar resultados de la consulta
      $nfilas = mysql_num_rows ($consulta);
if ($nfilas > 0)
      {
     print ('<TABLE border="1">' . "\n");
     print ("<TR>\n");
     print ("<TH>Identificador</TH>\n");
     print ("<TH>Concepto</TH>\n");
     print ("<TH>Activado</TH>\n");
     print ("<TH>Orden</TH>\n");
     print ("</TR>\n");
	for ($i=0; $i<$nfilas; $i++) {
   	     $temporadas = "select * from temporadas";
      	     $contemp = mysql_query ($temporadas, $conexion)or die ("Fallo en la consulta");
             $resultado = mysql_fetch_array ($consulta);
			$texto=str_replace("<br />","\n",$resultado['contenido']);
			print ("<TR>\n");
			print ('<form id="form'. $i . '" ' . 'name="form'. $i . '" ' . 'method="post" action="bdmarquee.php" enctype="multipart/form-data">' . "\n");
//			print ('<TD><span id="sprytextfield1">' . "\n");
			print ('<TD><input name="titulo" type="text" id="titulo" value=' ."'" . $resultado['id'] . "'" . 'size="15" maxlength="15" />' . "\n");
//			print ('<span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span>' . "\n");
			print ("</TD>\n");
			
			
			print ('<TD><span id="sprytextarea' . $i . '">' . "\n");
			if($resultado['id']=='Amarillas' || $resultado['id']=='Rojas' || $resultado['id']=='Goles' || $resultado['id']=='Asistencias'|| $resultado['id']=='Puntuaciones'){
				print ('<SELECT name="texto" id="texto">');
				for ($a=0; $a<$ntemp; $a++) {	
      					$restemp = mysql_fetch_array ($contemp);
      					print ("\n");
					if ($restemp['temporada']==$resultado['contenido'])
						print ('<OPTION SELECTED VALUE="' . $restemp['temporada'] . '">' . $restemp['temporada'] . '</OPTION>');
					else
						print ('<OPTION VALUE="' . $restemp['temporada'] . '">' . $restemp['temporada'] . '</OPTION>');					
				}
				print ('</SELECT>');
				
			}else{
				print ('<textarea name="texto" id="texto" cols="45" rows="3">' . $texto . "</textarea>\n");
				print ('<span id="countsprytextarea' . $i . '"></span>' . "\n");
			}
			print ("</TD>\n");
			
//			print ('<TD><span id="sprytextfield5">' . "\n");
			print ('<TD><input name="activado" type="text" id="activado"  value="' . $resultado['activado'] . '" size="1" maxlength="1"/>' . "\n");
//			print ('<span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>' . "\n");
			print ("</TD>\n");
			
//			print ('<TD><span id="sprytextfield5">' . "\n");
			print ('<TD><input name="orden" type="text" id="orden"  value="' . $resultado['orden'] . '" size="1" maxlength="1"/>' . "\n");
//			print ('<span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>' . "\n");
			print ("</TD>\n");

			
			print ('<input name="opera" id="opera" type="hidden" />' . "\n");
			print ('<input name="tituloini" id="tituloini"  type="hidden" value=' ."'" . $resultado['id'] . "'" . '" />' . "\n");

			print ('<TD><img height="16px" width="16px" src="b_drop.png" title="Borrar" onclick= " borrar(' . " 'form" . $i . "')" . '"/></TD>' . "\n");
			print ('<TD><img name="' . $i .'"' . 'height="16px" width="16px" src="modificar.png" title="Actualizar" onclick= " update(' . " 'form" . $i . "')" . '"/></TD>');
			print ("</form>\n");
			print ("</TR>\n");
			print ('<script type="text/javascript">');
			print ('var sprytextarea' . $i . '= new Spry.Widget.ValidationTextarea("sprytextarea' . $i . '", {maxChars:150, counterType:"chars_remaining", counterId:"countsprytextarea' . $i . '"});');
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
print ('<form id="formalta" name="formalta" method="post" action="bdmarquee.php" enctype="multipart/form-data">' . "\n");
//print ('<span id="sprytextfield1">' . "\n");
print('<a class="tituloficha">Alta noticia</a>');
print ('<TABLE border="1">' . "\n");
print ("	<TR>\n");
print ("	<TH>Identificador</TH>\n");
print ("	<TH>Contenido</TH>\n");
print ("	<TH>Activado</TH>\n");
print ("        <TH>Orden</TH>\n");
print ("	</TR>\n");
print ("	<TR>\n");
print ('	<TD><input name="titulo" type="text" id="titulo" size="15" maxlength="15" /></TD>');
print ("\n");

print ('	<TD><span id="sprytextareaalta">
	   <textarea name="texto" id="texto" cols="45" rows="3"></textarea>
	   <span id="countsprytextareaalta"></span></TD>');
print ("\n");			
print ('	<TD><input name="activado" type="text" id="activado" size="1" maxlength="1" /></TD>');
print ("\n");
print ("\n");			
print ('	<TD><input name="orden" type="text" id="orden" size="1" maxlength="1" /></TD>');
print ("\n");
			
print ('<input name="opera" id="opera" type="hidden" />' . "\n");

print ('	<TD><img height="16px" width="16px" src="alta.png" title="A?adir" onclick= " alta(' . "'formalta')" . '" /></TD>' . "\n");
print ("</TR>\n");
print ("</TABLE>\n");
print ("</form>\n");
print ("<BR />\n");
print ('<a href="' . 'adminbatallines.php">Volver</a>' . "\n");
print ('<script type="text/javascript">');
print ('var sprytextareaalta= new Spry.Widget.ValidationTextarea("sprytextareaalta", {maxChars:150, counterType:"chars_remaining", counterId:"countsprytextareaalta"});');
print ('</script>');
mysql_close($conexion);
}else{
	print ("No tienes permiso");	
}
?>

</body>
</html>