<?include('seguridad.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administración Temporadas</title>
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
					if( eval('document.'+formulario+'.temporada.value')!= ''){ 
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
										
					if( eval('document.'+formulario+'.temporada.value')!= ''){ 
					eval('document.'+formulario+'.opera.value="a"');
					eval('document.'+formulario+'.submit()');
					}
					else{
						alert("Jugador obligatorio");
					}
	}
function jugadores(formulario)
	{				var temporada = eval('document.'+formulario+'.temporada.value');
					window.location="adminjugadores_temporada.php?listatemporadas=" + temporada; 
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
 
      
      print ('<TABLE border="1">' . "\n");
      print ("<TR>\n");
      print ("<TH>Temporada</TH>\n");
      print ("<TH>División</TH>\n");
      print ("</TR>\n");      	
      for ($a=0; $a<$nfilas; $a++) {	
			$resultado = mysql_fetch_array ($consulta);
			print ("<TR>\n");
			print ('<form id="form'. $a . '" ' . 'name="form'. $a . '" ' . 'method="post" action="bdtemporadas.php" enctype="multipart/form-data">' . "\n");
			
			print ('<TD><input name="temporada" type="text" id="temporada" value=' . $resultado['temporada'] . ' size="9" maxlength="9" />' . "\n");
			print ("</TD>\n");
			print ('<TD><input name="division" type="text" id="division" value=' . $resultado['division'] . ' size="1" maxlength="1" />' . "\n");
			print ("</TD>\n");
			
			print ('<TD><img height="16px" width="16px" src="b_drop.png" title="Borrar" onclick= " borrar(' . " 'form" . $a . "')" . '"/></TD>' . "\n");
			print ('<TD><img name="' . $a .'"' . 'height="16px" width="16px" src="modificar.png" title="Actualizar" onclick= " update(' . " 'form" . $a . "')" . '"/></TD>');
			print ('<TD><img name="' . $a .'"' . 'height="16px" width="16px" src="estadisticas.jpg" title="Jugadores" onclick= "jugadores(' . " 'form" . $a . "')" . '"/></TD>');

			print ('<input name="opera" id="opera" type="hidden" />' . "\n");
			print ('<input name="temporadaini" id="temporadaini" value="' . $resultado['temporada'] . '" type="hidden" />' . "\n");
			print ('<input name="jugadorini" id="jugadorini" value="' . $resultado['jugador'] . '" type="hidden" />' . "\n");
			print ("</form>\n");
			
			print ("</TR>\n");	
	}

      print ("</TABLE>\n");
      print("<BR /><BR /><BR /><BR />\n");
      print('<a class="tituloficha">Alta Temporada </a>');
      print ('<TABLE border="1">' . "\n");
      print ("<TR>\n");
      print ("<TH>Temporada</TH>\n");
      print ("<TH>División</TH>\n");
      print ("</TR>\n");
      print ("<TR>\n");
      print ('<form id="formalta" name="formalta" method="post" action="bdtemporadas.php" enctype="multipart/form-data">' . "\n");
            
      print ('<TD>' . "\n");
      print ('<input name="temporada" id="temporada" value="" size="9" maxlength="9"/>' . "\n");    
      print ("</TD>\n");
      
      print ('<TD>' . "\n");
      print ('<input name="division" id="division" value="" size="1" maxlength="1"/>' . "\n");    
      print ("</TD>\n");		
      print ('<TD><img height="16px" width="16px" src="alta.png" title="Añadir" onclick= " alta(' . "'formalta')" . '" /></TD>' . "\n");
      print ('<input name="opera" id="opera" type="hidden" />' . "\n");
      print ("</form>\n");
			
      print ("</TR>\n");
      print ("</TABLE>\n");
	  print ("<BR />\n");
	  print ('<a href="' . 'adminbatallines.php">Volver</a>' . "\n");
      
      mysql_close($conexion);
}else{
	print ("No tienes permiso");	
}
?>

</body>
</html>