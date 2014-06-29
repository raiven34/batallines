<? include('seguridad.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administración Jugadores Por Temporada</title>
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
					if( eval('document.'+formulario+'.jugador.value')!= ''){ 
					eval('document.'+formulario+'.opera.value="m"');
					eval('document.'+formulario+'.submit()');
					}
					else{
						alert("Jugador obligatorio");
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
										
					if( eval('document.'+formulario+'.listajugadores.value')!= ''){ 
					eval('document.'+formulario+'.opera.value="a"');
					eval('document.'+formulario+'.submit()');
					}
					else{
						alert("Jugador obligatorio");
					}
	}

</script>
<?PHP
	  
include('conexion.php');

   // Calcular el n?mero total de filas de la tabla
      $instruccion = "select * from temporadas order by temporada desc";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      $nfilas = mysql_num_rows ($consulta);
      
   // Calcular el n?mero total de filas de la tabla
      $jugadores = "select * from jugadores order by apodo desc";
      $consultajug = mysql_query ($jugadores, $conexion)
         or die ("Fallo en la consulta");
      $njugadores = mysql_num_rows ($consultajug);
 

      if ($nfilas > 0)
      {
      	$resultado = mysql_fetch_array ($consulta);
      	$ultimatemporada = $resultado['temporada'];
      	if (!isset($_REQUEST['listatemporadas'])) $temporada=$ultimatemporada;
      	else $temporada = $_REQUEST['listatemporadas'];      	
      	print ('<form id="formlistatemporadas" name="formlistatemporadas" method="post" action="adminjugadores_temporada.php">' . "\n");
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
	print ("<TH>Jugador</TH>\n");
	print ("</TR>\n");
	$quejugadores = "SELECT * FROM jugadores_temporada WHERE temporada='" . $temporada . "' ORDER BY jugador";
	$resjugadores = mysql_query ($quejugadores, $conexion);
 	$numjugadores = mysql_num_rows ($resjugadores);
 	for ($a=0; $a<$numjugadores; $a++) {
 			$rowjugadores = mysql_fetch_array ($resjugadores);
			print ("<TR>\n");
			print ('<form id="form'. $a . '" ' . 'name="form'. $a . '" ' . 'method="post" action="bdjugadores_temporada.php" enctype="multipart/form-data">' . "\n");
			
			print ('<TD><input name="jugador" type="text" id="jugador" value=' . $rowjugadores['jugador'] . ' size="30" maxlength="30" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><img height="16px" width="16px" src="b_drop.png" title="Borrar" onclick= " borrar(' . " 'form" . $a . "')" . '"/></TD>' . "\n");
			print ('<TD><img name="' . $a .'"' . 'height="16px" width="16px" src="modificar.png" title="Actualizar" onclick= " update(' . " 'form" . $a . "')" . '"/></TD>');

			print ('<input name="opera" id="opera" type="hidden" />' . "\n");
			print ('<input name="temporadaini" id="temporadaini" value="' . $rowjugadores['temporada'] . '" type="hidden" />' . "\n");
			print ('<input name="jugadorini" id="jugadorini" value="' . $rowjugadores['jugador'] . '" type="hidden" />' . "\n");
			print ("</form>\n");
			
			print ("</TR>\n");			
			
      }
      print ("</TABLE>\n");
      print("<BR /><BR /><BR /><BR />\n");
      print('<a class="tituloficha">Alta Jugadores </a>');
      print ('<TABLE border="1">' . "\n");
      print ("<TR>\n");
      print ("<TH>Jugador</TH>\n");
      print ("</TR>\n");
      print ("<TR>\n");
      print ('<form id="formalta" name="formalta" method="post" action="bdjugadores_temporada.php" enctype="multipart/form-data">' . "\n");
      

      
      print ('<TD>' . "\n");
      print ('<SELECT name="listajugadores" id="listajugadores">');
      	for ($c=0; $c<$njugadores; $c++) {	
      		$resjugadores = mysql_fetch_array ($consultajug);
      		print ("\n");
		print ('<OPTION VALUE="' . $resjugadores['apodo'] . '">' . $resjugadores['apodo'] . '</OPTION>');
	}      
      print ('</SELECT>');      
      print ("</TD>\n");
      print ('<input name="temporadaini" id="temporadaini" value="' . $temporada . '" type="hidden" />' . "\n");		
      print ('<TD><img height="16px" width="16px" src="alta.png" title="Añadir" onclick= " alta(' . "'formalta')" . '" /></TD>' . "\n");
      print ('<input name="opera" id="opera" type="hidden" />' . "\n");
      print ("</form>\n");
			
      print ("</TR>\n");
      print ("</TABLE>\n");
	  print ("<BR />\n");
	  print ('<a href="' . 'admintemporadas.php">Volver</a>' . "\n");

    }		  
      
      
mysql_close($conexion);
?>

</body>
</html>