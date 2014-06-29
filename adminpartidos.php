<?include('seguridad.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administración Partidos</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="css/estilosweb.css" rel="stylesheet" type="text/css" />
</head>

<body>

<script type="text/javascript">
function update(formulario)
	{		
					if( eval('document.'+formulario+'.jornada.value')!= ''){ 
					eval('document.'+formulario+'.opera.value="m"');
					eval('document.'+formulario+'.submit()');
					}
					else{
						alert("Jornada obligatoria");
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
					if( eval('document.'+formulario+'.jornada.value')!= ''){ 
					eval('document.'+formulario+'.opera.value="a"');
					eval('document.'+formulario+'.submit()');
					}
					else{
						alert("Jornada obligatorio");
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
      $instruccion = "select * from temporadas order by temporada desc";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      $nfilas = mysql_num_rows ($consulta);
 

      if ($nfilas > 0)
      {
      	$resultado = mysql_fetch_array ($consulta);
      	$ultimatemporada = $resultado['temporada'];
      	if (!isset($_REQUEST['listatemporadas'])) $temporada=$ultimatemporada;
      	else $temporada = $_REQUEST['listatemporadas'];      	
      	print ('<form id="formlistatemporadas" name="formlistatemporadas" method="post" action="adminpartidos.php">' . "\n");
      	print ('<a class="tituloficha">Temporada</a>' . "\n");
		print ('<SELECT name="listatemporadas" id="listatemporadas">');
      	$consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      	for ($i=0; $i<$nfilas; $i++) {	
      		$resultado = mysql_fetch_array ($consulta);
      		print ("\n");
		if ($resultado['temporada']==$temporada)
		print ('<OPTION SELECTED VALUE="' . $resultado['temporada'] . '">' . $resultado['temporada'] . '</OPTION>');
		else
		print ('<OPTION VALUE="' . $resultado['temporada'] . '">' . $resultado['temporada'] . '</OPTION>');
	}
	print ('</SELECT>');
	print ('<input type=submit value="Ver"></input>');
	print ("</form>\n");
	print ("<br />\n");
      	print ('<TABLE border="1">' . "\n");
	print ("<TR>\n");
	print ("<TH>Jornada</TH>\n");
	print ("<TH>Local</TH>\n");
	print ("<TH>Visitante</TH>\n");
	print ("<TH>Goles Local</TH>\n");
	print ("<TH>Goles Visitante</TH>\n");
	print ("<TH>Fecha</TH>\n");
	print ("<TH>Hora</TH>\n");
	print ("<TH>Lugar</TH>\n");
	print ("<TH>Temporada</TH>\n");
	print ("<TH>Jugado</TH>\n");
	print ("<TH>Cr&oacute;nica</TH>\n");
	print ("</TR>\n");
	$quepartidos = "SELECT * FROM partidos WHERE temporada='" . $temporada . "' ORDER BY jornada";
	$respartidos = mysql_query ($quepartidos, $conexion);
 	$numpartidos = mysql_num_rows ($respartidos);
 	for ($a=0; $a<$numpartidos; $a++) {
 			$rowpartidos = mysql_fetch_array ($respartidos);
 			$cronica=str_replace("<br />","\n",$rowpartidos['cronica']);
			print ("<TR>\n");
			print ('<form id="form'. $a . '" ' . 'name="form'. $a . '" ' . 'method="post" action="bdpartidos.php" enctype="multipart/form-data">' . "\n");
			
			print ('<TD><input name="jornada" type="text" id="jornada" value=' . $rowpartidos['jornada'] . ' size="2" maxlength="2" />' . "\n");
			print ("</TD>\n");

			print ('<TD><input name="local" type="text" id="visitante" value="' . $rowpartidos['local'] . '" size="30" maxlength="30" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><input name="visitante" type="text" id="visitante" value="' . $rowpartidos['visitante'] . '" size="30" maxlength="30" />' . "\n");
			print ("</TD>\n");			
			
			print ('<TD><input name="goleslocal" type="text" id="goleslocal" value="' . $rowpartidos['goleslocal'] . '" size="2" maxlength="2" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><input name="golesvisitante" type="text" id="golesvisitante" value="' . $rowpartidos['golesvisitante'] . '" size="2" maxlength="2" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><input name="fecha" type="text" id="fecha" value="' . $rowpartidos['fecha'] . '" size="10" maxlength="10" />' . "\n");
			print ("</TD>\n");

			print ('<TD><input name="hora" type="text" id="hora" value="' . $rowpartidos['hora'] . '" size="5" maxlength="5" />' . "\n");
			print ("</TD>\n");

			print ('<TD><input name="lugar" type="text" id="lugar" value="' . $rowpartidos['lugar'] . '" size="50" maxlength="100" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><input name="temporada" type="text" id="temporada" value="' . $rowpartidos['temporada'] . '" size="9" maxlength="9" readonly="readonly" />' . "\n");
			print ("</TD>\n");

			print ('<TD><SELECT name="jugado" id="jugado">' . "\n");
			if($rowpartidos['jugado']=='S'){
				print ('<OPTION VALUE="N">NO</OPTION>');			
				print ('<OPTION SELECTED VALUE="' . $rowpartidos['jugado'] . '">SÍ</OPTION>');
			}else{
				print ('<OPTION SELECTED VALUE="N">NO</OPTION>');
				print ('<OPTION VALUE="S">SÍ</OPTION>');
			}
			print ('</SELECT>' . "\n");
			print ("</TD>\n");
			
			
			print ('<TD><span id="sprytextarea' . $a . '">' . "\n");
			print ('<textarea name="cronica" id="cronica" cols="45" rows="5">' . $cronica . "</textarea>\n");
			print ('<span id="countsprytextarea' . $a . '"></span>' . "\n");
			print ("</TD>\n");
			
			print ('<TD><img height="16px" width="16px" src="b_drop.png" title="Borrar" onclick= " borrar(' . " 'form" . $a . "')" . '"/></TD>' . "\n");
			print ('<TD><img name="' . $a .'"' . 'height="16px" width="16px" src="modificar.png" title="Actualizar" onclick= " update(' . " 'form" . $a . "')" . '"/></TD>');
			print ('<TD><img name="' . $a .'"' . 'height="16px" width="16px" src="estadisticas.jpg" title="Estad?sticas" onclick= "estadisticas(' . " 'form" . $a . "')" . '"/></TD>');

			print ('<input name="opera" id="opera" type="hidden" />' . "\n");
			print ('<input name="jornadaini" id="jornadaini" value="' . $rowpartidos['jornada'] . '" type="hidden" />' . "\n");
			print ("</form>\n");
			
			print ("</TR>\n");
			print ('<script type="text/javascript">');
			print ('var sprytextarea' . $a . '= new Spry.Widget.ValidationTextarea("sprytextarea' . $a . '", {maxChars:1000, counterType:"chars_remaining", counterId:"countsprytextarea' . $a . '"});');
			print ('</script>');
			
			
      }
      print ("</TABLE>\n");
      print("<BR /><BR /><BR /><BR />\n");
      print('<a class="tituloficha">Alta partido</a>');
      print ('<TABLE border="1">' . "\n");
      print ("<TR>\n");
      print ("<TH>Jornada</TH>\n");
      print ("<TH>Local</TH>\n");
      print ("<TH>Visitante</TH>\n");
      print ("<TH>Goles Local</TH>\n");
      print ("<TH>Goles Visitante</TH>\n");
      print ("<TH>Fecha</TH>\n");
      print ("<TH>Hora</TH>\n");
      print ("<TH>Lugar</TH>\n");
      print ("<TH>Temporada</TH>\n");
      print ("<TH>Jugado</TH>\n");
      print ("<TH>Cr&oacute;nica</TH>\n");
      print ("</TR>\n");
      print ("<TR>\n");
      print ('<form id="formalta" name="formalta" method="post" action="bdpartidos.php" enctype="multipart/form-data">' . "\n");
      
      print ('<TD><input name="jornada" type="text" id="jornada"  size="2" maxlength="2" />' . "\n");
      print ("</TD>\n");
      
      print ('<TD><input name="local" type="text" id="visitante"  size="30" maxlength="30" />' . "\n");
      print ("</TD>\n");
      
      print ('<TD><input name="visitante" type="text" id="visitante"  size="30" maxlength="30" />' . "\n");
      print ("</TD>\n");
      			
      print ('<TD><input name="goleslocal" type="text" id="goleslocal"  size="2" maxlength="2" />' . "\n");
      print ("</TD>\n");
      
      print ('<TD><input name="golesvisitante" type="text" id="golesvisitante"  size="2" maxlength="2" />' . "\n");
      print ("</TD>\n");
			
      print ('<TD><input name="fecha" type="text" id="fecha" size="10" maxlength="10" />' . "\n");
      print ("</TD>\n");

      print ('<TD><input name="hora" type="text" id="hora"  size="5" maxlength="5" />' . "\n");
      print ("</TD>\n");
			
      print ('<TD><input name="lugar" type="text" id="lugar" size="50" maxlength="100" />' . "\n");
      print ("</TD>\n");
			
      print ('<TD><input name="temporada" type="text" id="temporada" value="' . $temporada . '" size="9" maxlength="9" readonly="readonly" />' . "\n");
      print ("</TD>\n");

      print ('<TD><SELECT name="jugado" id="jugado">' . "\n");
      print ('<OPTION SELECTED VALUE="N">NO</OPTION>');
      print ('<OPTION VALUE="S">SÍ</OPTION>');
      print ('</SELECT></TD>' . "\n");
			
      print ('<TD><span id="sprytextareaalta">' . "\n");
      print ('<textarea name="cronica" id="cronica" cols="45" rows="5"></textarea>' . "\n");
      print ('<span id="countsprytextareaalta"></span>' . "\n");
      print ("</TD>\n");
			
      print ('<TD><img height="16px" width="16px" src="alta.png" title="A?adir" onclick= " alta(' . "'formalta')" . '" /></TD>' . "\n");
      print ('<input name="opera" id="opera" type="hidden" />' . "\n");
      print ("</form>\n");
			
      print ("</TR>\n");
      print ("</TABLE>\n");
	  print ("<BR />\n");
	  print ('<a href="' . 'adminbatallines.php">Volver</a>' . "\n");
      print ('<script type="text/javascript">');
      print ('var sprytextareaalta= new Spry.Widget.ValidationTextarea("sprytextareaalta", {maxChars:1000, counterType:"chars_remaining", counterId:"countsprytextareaalta"});');
      print ('</script>');
    }		  
      
      
mysql_close($conexion);
}else{
	print ("No tienes permiso");	
}
?>

</body>
</html>