<?PHP include('seguridad.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administración jugadores</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="css/estilosweb.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?PHP include('seguridad.php');?>
<script type="text/javascript">
function update(formulario)
	{		
					if( eval('document.'+formulario+'.jugador.value')!= ''){ 
					eval('document.'+formulario+'.opera.value="m"');
					eval('document.'+formulario+'.submit()');
					}
					else{
						alert("Jugador obligatoria");
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
					if( eval('document.'+formulario+'.jugador.value')!= ''){ 
					eval('document.'+formulario+'.opera.value="a"');
					eval('document.'+formulario+'.submit()');
					}
					else{
						alert("Jugador obligatorio");
					}
	}
function estadisticas(formulario)
	{				var temporada = eval('document.'+formulario+'.temporada.value');
					var jornada = eval('document.'+formulario+'.jornada.value');
					window.location="adminestadisticas.php?temporada=" + temporada + "&jornada=" + jornada; 
	}

</script>
<?PHP
if($_SESSION["rango"]>1){		  
include('conexion.php');

   // Calcular el n?mero total de filas de la tabla
	print ('<TABLE border="1">' . "\n");
     	print ("<TR>\n");
      	print ("<TH>Jugador</TH>\n");
      	print ("<TH>Fecha De Nacimiento</TH>\n");
      	print ("<TH>Número</TH>\n");
      	print ("<TH>Temporadas</TH>\n");
      	print ("<TH>Descripción</TH>\n");
      	print ("<TH>Foto</TH>\n");
      	print ("<TH>Apodo</TH>\n");
      	print ("<TH>Clave</TH>\n");
      	print ("<TH>Correo</TH>\n");
      	print ("<TH>Rango</TH>\n");
     	print ("</TR>\n");
	$quejugadores = "SELECT * FROM jugadores order by jugador desc";
	$resjugadores = mysql_query ($quejugadores, $conexion);
 	$numjugadores = mysql_num_rows ($resjugadores);
 	for ($a=0; $a<$numjugadores; $a++) {
 			$rowjugadores = mysql_fetch_array ($resjugadores);
			print ("<TR>\n");
			print ('<form id="form'. $a . '" ' . 'name="form'. $a . '" ' . 'method="post" action="bdjugadores.php" enctype="multipart/form-data">' . "\n");
			
			print ('<TD><input name="jugador" type="text" id="jugador" value="' . $rowjugadores['jugador'] . '" size="30" maxlength="30" />' . "\n");
			print ("</TD>\n");

			print ('<TD><input name="fecha_nacimiento" type="text" id="fecha_nacimiento" value="' . $rowjugadores['fecha_nacimiento'] . '" size="10" maxlength="10" />' . "\n");
			print ("</TD>\n");
						
			
			print ('<TD><input name="numero" type="text" id="numero" value="' . $rowjugadores['numero'] . '" size="2" maxlength="2" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><input name="temporadas" type="text" id="temporadas" value="' . $rowjugadores['temporadas'] . '" size="2" maxlength="2" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><span id="sprytextarea' . $a . '">' . "\n");
			print ('<textarea name="descripcion" id="descripcion" cols="45" rows="5">' . $rowjugadores['descripcion'] . "</textarea>\n");
			print ('<span id="countsprytextarea' . $a . '"></span>' . "\n");
			print ("</TD>\n");
			
			print ('<TD><img width="95px" height="95px" src="' . $rowjugadores['foto'] . '" /><input name="foto" type="FILE" id="foto" value="' . $rowjugadores['foto'] . '" size="30" maxlength="100" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><input name="apodo" type="text" id="apodo" value="' . $rowjugadores['apodo'] . '" size="10" maxlength="10" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><input name="clave" type="text" id="clave" value="' . $rowjugadores['password'] . '" size="10" maxlength="10" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><input name="correo" type="text" id="correo" value="' . $rowjugadores['correo'] . '" size="50" maxlength="100" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><input name="rango" type="text" id="rango" value="' . $rowjugadores['rango'] . '" size="1" maxlength="1" />' . "\n");
			print ("</TD>\n");
			
			print ('<input name="fotoini" id="imagenini" type="hidden" value="' . $rowjugadores['foto'] . '" />' . "\n");
			print ('<input name="jugadorini" id="jugadorini" type="hidden" value="' . $rowjugadores['jugador'] . '" />' . "\n");
			
			print ('<TD><img height="16px" width="16px" src="b_drop.png" title="Borrar" onclick= " borrar(' . " 'form" . $a . "')" . '"/></TD>' . "\n");
			print ('<TD><img name="' . $a .'"' . 'height="16px" width="16px" src="modificar.png" title="Actualizar" onclick= " update(' . " 'form" . $a . "')" . '"/></TD>');

			print ('<input name="opera" id="opera" type="hidden" />' . "\n");
			
			print ("</form>\n");
			
			print ("</TR>\n");
			print ('<script type="text/javascript">');
			print ('var sprytextarea' . $a . '= new Spry.Widget.ValidationTextarea("sprytextarea' . $a . '", {maxChars:150, counterType:"chars_remaining", counterId:"countsprytextarea' . $a . '"});');
			print ('</script>');
			
			
      }
      print ("</TABLE>\n");
      print("<BR /><BR /><BR /><BR />\n");
      print('<a class="tituloficha">Alta Jugador</a>');
      print ('<TABLE border="1">' . "\n");
      print ("<TR>\n");
      print ("<TH>Jugador</TH>\n");
      print ("<TH>Fecha De Nacimiento</TH>\n");
      print ("<TH>Número</TH>\n");
      print ("<TH>Temporadas</TH>\n");
      print ("<TH>Descripción</TH>\n");
      print ("<TH>Foto</TH>\n");
      print ("<TH>Apodo</TH>\n");
      print ("<TH>Clave</TH>\n");
      print ("<TH>Correo</TH>\n");
      print ("<TH>Rango</TH>\n");
      print ("</TR>\n");
      print ("<TR>\n");
      print ('<form id="formalta" name="formalta" method="post" action="bdjugadores.php" enctype="multipart/form-data">' . "\n");
      
      print ('<TD><input name="jugador" type="text" id="jugador" size="30" maxlength="30" />' . "\n");
      print ("</TD>\n");

      print ('<TD><input name="fecha_nacimiento" type="text" id="fecha_nacimiento" size="10" maxlength="10" />' . "\n");
      print ("</TD>\n");
						
			
      print ('<TD><input name="numero" type="text" id="numero" size="2" maxlength="2" />' . "\n");
      print ("</TD>\n");
			
      print ('<TD><input name="temporadas" type="text" id="temporadas" size="2" maxlength="2" />' . "\n");
      print ("</TD>\n");
			
      print ('<TD><span id="sprytextarea' . $a . '">' . "\n");
      print ('<textarea name="descripcion" id="descripcion" cols="45" rows="5">' . "</textarea>\n");
      print ('<span id="countsprytextarea' . $a . '"></span>' . "\n");
      print ("</TD>\n");
			
      print ('<TD><input name="foto" type="FILE" id="foto" size="30" maxlength="100" />' . "\n");
      print ("</TD>\n");
			
      print ('<TD><input name="apodo" type="text" id="apodo" size="10" maxlength="10" />' . "\n");
      print ("</TD>\n");
      
      print ('<TD><input name="clave" type="text" id="clave" size="10" maxlength="10" />' . "\n");
      print ("</TD>\n");
      
      print ('<TD><input name="correo" type="text" id="correo" size="50" maxlength="100" />' . "\n");
      print ("</TD>\n");
      
      print ('<TD><input name="rango" type="text" id="rango" size="1" maxlength="1" />' . "\n");
      print ("</TD>\n");
			
      print ('<TD><img height="16px" width="16px" src="alta.png" title="Aï¿½adir" onclick= " alta(' . "'formalta')" . '" /></TD>' . "\n");
      print ('<input name="opera" id="opera" type="hidden" />' . "\n");
      print ("</form>\n");
			
      print ("</TR>\n");
      print ("</TABLE>\n");
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