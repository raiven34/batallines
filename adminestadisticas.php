<? include('seguridad.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administración Estadísticas</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="css/estilosweb.css" rel="stylesheet" type="text/css" />
</head>

<body>

<script type="text/javascript">
function update(formulario)
	{ 
					eval('document.'+formulario+'.opera.value="m"');
					eval('document.'+formulario+'.submit()');
					
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
					eval('document.'+formulario+'.opera.value="a"');
					eval('document.'+formulario+'.submit()');
	}
$(document).ready(function() {
	$(".acabecera").click(function(){ 
		var data = [];<!-- Construimos un objeto con la información a enviar -->
		var i = 0;
 		while($("#form" + i).length>0){
			var jug=$("#jugador" + i).val();
			data.push({
				jugador: $("#jugador" + i).val(),
				jornada: $("#jornada" + i).val(),
				temporada: $("#temporada" + i).val(),
				nopresentado: $("#nopresentado" + i).val(),
				goles: $("#goles" + i).val(),
				asistencias: $("#asistencias" + i).val(),
				amarillas: $("#amarillas" + i).val(),
				rojas: $("#rojas" + i).val()
				
			});			

			i=i+1;
		}
		json_form = JSON.stringify(data);  // convertimos el objeto a una cadena JSON
		
		console.log(json_form);
		$.ajax({ <!-- Comenzamos la función con ajax -->
 
		type: "POST", <!-- Enviamos los datos por POST -->
		 
		data: {form:json_form}, <!-- Metemos los datos del array para enviarlos -->
		 
		url: './json/json_estadisticas.php', <!-- Le ponemos la ruta del PHP al que le enviamos los datos -->
		 
		success: function(data) { <!-- En caso de que los datos hayan llegado correctamente al destinatario, y haya contestado, se ejecutará esta función -->
		 
		var res = jQuery.parseJSON(data); <!-- Recogemos los datos que devuelve el PHP en formato JSON -->
		 	
		alert(res.success + " registros se actualizaron");
		 
		},
		 
		error: function(e){ <!-- Si no ha podido conectar con el servidor -->
		 
		alert("Se ha producido un error en el servidor");
		 
		}
		 
		}); <!-- fin ajax -->
 
	});  
});
</script>
<?PHP
if($_SESSION["rango"]>1){		  
include('conexion.php');

   // Calcular el n?mero total de filas de la tabla
      if (isset($_REQUEST['temporada']) && isset($_REQUEST['jornada'])){
	      $instruccion = "select * from estadisticas where temporada='" . $_REQUEST['temporada'] . "' and jornada='" . $_REQUEST['jornada'] ."'";
	      $consulta = mysql_query ($instruccion, $conexion)
	      or die ("Fallo en la consulta");
		  $nfilas = mysql_num_rows ($consulta);
		  if($nfilas==0){
			  $instruccion = "select apodo as jugador, '' as nopresentado,0 as goles, 0 as asistencias, 0 as amarillas, 0 as rojas from jugadores where rango>0";
			  $consulta = mysql_query ($instruccion, $conexion)
			  or die ("Fallo en la consulta");
			  $nfilas = mysql_num_rows ($consulta);		  	
		  }
	      
	      print ('<TABLE border="1">' . "\n");
 		  print ("<TR>\n");
		  print ("<TH>Jugador</TH>\n");
		  print ("<TH>Jornada</TH>\n");
		  print ("<TH>Temporada</TH>\n");
		  print ("<TH>No presentado</TH>\n");
		  print ("<TH>Goles</TH>\n");
		  print ("<TH>Asistencias</TH>\n");
		  print ("<TH>Amarillas</TH>\n");
		  print ("<TH>Rojas</TH>\n");
		  print ("</TR>\n");
		  for ($a=0; $a<$nfilas; $a++) {	
      		$resultado = mysql_fetch_array ($consulta);
			
			print ("<TR>\n");
			print ('<form id="form'. $a . '" ' . 'name="form'. $a . '" ' . 'method="post" action="bdestadisticas.php" enctype="multipart/form-data">' . "\n");
			print ('<TD><input name="jugador" type="text" id="jugador'. $a . '" ' . '" value=' . $resultado['jugador'] . ' size="10" maxlength="10" readonly="readonly" />' . "\n");
			print ("</TD>\n");
			print ('<TD><input name="jornada" type="text" id="jornada'. $a . '" ' . '" value=' . $_REQUEST['jornada'] . ' size="2" maxlength="2" readonly="readonly" />' . "\n");
			print ("</TD>\n");
			print ('<TD><input name="temporada" type="text" id="temporada'. $a . '" ' . '" value="' . $_REQUEST['temporada'] . '" size="9" maxlength="9" readonly="readonly" />' . "\n");
			print ("</TD>\n");
			print ('<TD><input name="nopresentado" type="text" id="nopresentado'. $a . '" ' . '" value="' . $resultado['nopresentado'] . '" size="30" maxlength="30" />' . "\n");
			print ("</TD>\n");
			print ('<TD><input name="goles" type="text" id="goles'. $a . '" ' . '" value="' . $resultado['goles'] . '" size="2" maxlength="2" />' . "\n");
			print ("</TD>\n");
			print ('<TD><input name="asistencias" type="text" id="asistencias'. $a . '" ' . '" value="' . $resultado['asistencias'] . '" size="2" maxlength="2" />' . "\n");
			print ("</TD>\n");
			print ('<TD><input name="amarillas" type="text" id="amarillas'. $a . '" ' . '" value="' . $resultado['amarillas'] . '" size="2" maxlength="2" />' . "\n");
			print ("</TD>\n");
			print ('<TD><input name="rojas" type="text" id="rojas'. $a . '" ' . '" value="' . $resultado['rojas'] . '" size="2" maxlength="2" />' . "\n");
			print ("</TD>\n");
			print ('<TD><img height="16px" width="16px" src="b_drop.png" title="Borrar" onclick= " borrar(' . " 'form" . $a . "')" . '"/></TD>' . "\n");
			print ('<TD><img name="' . $a .'"' . 'height="16px" width="16px" src="modificar.png" title="Actualizar" onclick= " update(' . " 'form" . $a . "')" . '"/></TD>' . "\n");
			print ('<input name="opera" id="opera" type="hidden" />' . "\n");
			print ("</form>\n");
			print ("</TR>\n");
		  }
		  print ("</table>\n");
		  print("<div style='padding:10px;'><a class='acabecera'>GUARDAR</a></div>");
		  print("<BR /><BR /><BR /><BR />\n");
      	  
		  print('<a class="tituloficha">Alta estadística</a>');
		  print ('<TABLE border="1">' . "\n");
    	  print ("<TR>\n");
		  print ("<TH>Jugador</TH>\n");
		  print ("<TH>Jornada</TH>\n");
		  print ("<TH>Temporada</TH>\n");
		  print ("<TH>No presentado</TH>\n");
		  print ("<TH>Goles</TH>\n");
		  print ("<TH>Asistencias</TH>\n");
		  print ("<TH>Amarillas</TH>\n");
		  print ("<TH>Rojas</TH>\n");
		  print ("</TR>\n");
		  print ('<form id="formalta" name="formalta" method="post" action="bdestadisticas.php" enctype="multipart/form-data">' . "\n");
		  print ("<TR>\n");

			print ('<TD><SELECT name="jugador" id="jugador">');
	      	$quejugadores = "select * from jugadores_temporada where temporada='" . $_REQUEST['temporada'] . "'";
			$resjugadores = mysql_query ($quejugadores, $conexion)
	         or die ("Fallo en la consulta");
			$njugadores = mysql_num_rows ($resjugadores);
			for ($b=0; $b<$njugadores; $b++) {
				$rowjugadores = mysql_fetch_array ($resjugadores);
				print ("\n");
				print ('<OPTION VALUE="' . $rowjugadores['jugador'] . '">' . $rowjugadores['jugador'] . '</OPTION>');
			}
			print ('</SELECT></TD>' . "\n");
			print ('<TD><input name="jornada" type="text" id="jornada" value="' . $_REQUEST['jornada'] . '" size="2" maxlength="2" readonly="readonly" />' . "\n");
			print ("</TD>\n");
			print ('<TD><input name="temporada" type="text" id="temporada" value="' . $_REQUEST['temporada'] . '" size="9" maxlength="9" readonly="readonly" />' . "\n");
			print ("</TD>\n");
			print ('<TD><input name="nopresentado" type="text" id="nopresentado" size="30" maxlength="30" />' . "\n");
			print ("</TD>\n");
			print ('<TD><input name="goles" type="text" id="goles" size="2" maxlength="2" />' . "\n");
			print ("</TD>\n");
			print ('<TD><input name="asistencias" type="text" id="asistencias" size="2" maxlength="2" />' . "\n");
			print ("</TD>\n");
			print ('<TD><input name="amarillas" type="text" id="amarillas" size="2" maxlength="2" />' . "\n");
			print ("</TD>\n");
			print ('<TD><input name="rojas" type="text" id="rojas" size="2" maxlength="2" />' . "\n");
			print ("</TD>\n");
			print ('<TD><img height="16px" width="16px" src="alta.png" title="Alta" onclick= " alta(' . "'formalta')" . '"/></TD>' . "\n");
			print ('<input name="opera" id="opera" type="hidden" />' . "\n");

			print ("</TR>\n");
			print ("</form>\n");
		    print ("</table>\n");
			print ("<br />\n");
			print ('<a href="adminpartidos.php?listatemporadas=' . $_REQUEST['temporada'] . '">Volver</a>');
		  
      }
	  else echo "Parametros incorrectos";
      
mysql_close($conexion);
}else{
	print ("No tienes permiso");	
}
?>

</body>
</html>