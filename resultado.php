<?PHP
header( "Expires: Mon, 20 Dec 1998 01:00:00 GMT" );
header( "Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
header( "Cache-Control: no-cache, must-revalidate" );
header( "Pragma: no-cache" );
include('seguridadvota.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Batallines</title>
<link href="css/estilosweb_new.css" rel="stylesheet" type="text/css" />
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/xpath.js" type="text/javascript"></script>
<script src="SpryAssets/SpryData.js" type="text/javascript"></script>
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="js/jquery.backstretch.min.js" type="text/javascript"></script>
<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
<script src="js/jquery.tablesorter.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function MM_changeProp(objId,x,theProp,theValue) { //v9.0
  var obj = null; with (document){ if (getElementById)
  obj = getElementById(objId); }
  if (obj){
    if (theValue == true || theValue == false)
      eval("obj.style."+theProp+"="+theValue);
    else eval("obj.style."+theProp+"='"+theValue+"'");
  }
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

$(document).ready(function(){
	$("#myTable").tablesorter( {sortList: [[1,1]],widthFixed: false} );
	$("#login").load("compruebaloginrapido.php");
	$("#puntuar").addClass("nivel1select");
	$("#submit").click(function(){
		var datos = $("#puntuaciones").serialize();
		$.get("bdpuntuaciones.php",datos, function(resultado) {  
			$(".fondonoticiasi").html(resultado);
		});	
	});
});


$.backstretch("batfon.jpg");
//-->

</script>
</head>

<body  class="body">

<div id="Contenedora">
<div id="CentradaHS">
      <div id="cabecera">
<?
include("menu.php");
?>	  
	  
	  </div>
      <div id="marquee"><marquee scrolldelay="200"><?PHP include("marquee.php") ?></marquee></div>
<div class="fondo">
		<div class="fondos"></div>
		<div class="fondom">
           &nbsp;
           <?PHP
	  
include('conexion.php');

   // Calcular última jornada y comprobar si ha votado
			   if (isset($_REQUEST['jornada']) && isset($_REQUEST['temporada']) && $_REQUEST['jornada']!=''){
				  $jornada = $_REQUEST['jornada'];
				  $temporada = $_REQUEST['temporada'];
				  $instruccion = " select p.jugador, p.puntos, p.jornada, p.temporada, j.apodo, j.foto, count( p.jugador ), sum(p.puntos), round(sum(p.puntos) / count( p.jugador ),2), max(puntos) as maxpuntos, min(puntos) as minpuntos from jugadores j, puntuaciones p where p.jugador=j.apodo and jornada=" . $jornada . " and temporada='" . $temporada . "' group by p.jugador order by round(sum(p.puntos) / count( p.jugador ),1)+0 desc";
				  $quevotantes = "select distinct(votante) from puntuaciones where jornada=" . $jornada . " and temporada='" . $temporada . "'";
			  	
			  	  $quehavotado="select distinct(votante) from puntuaciones where jornada='" . $jornada . "' and votante='" . $_SESSION['usuario'] . "' and temporada='" . $temporada . "'";
			  	  $rehavotado = mysql_query ($quehavotado, $conexion);
			  	  $nhavotado = mysql_num_rows ($rehavotado);
			  	  
			  }else{
			  	$jornada='';
			  	$nhavotado=1;
				$temporada = $_REQUEST['temporada'];
			  	$quevotantes = "select distinct(votante) from puntuaciones where temporada='" . $temporada . "'";
			  	$instruccion = "select p.jugador, p.puntos, p.jornada, p.temporada, j.apodo, j.foto, count( p.jugador ), sum(p.puntos), round(sum(p.puntos) / count( p.jugador ),2), max(puntos) as maxpuntos, min(puntos) as minpuntos from jugadores j, puntuaciones p where p.jugador=j.apodo and temporada='" . $temporada . "' group by p.jugador order by round(sum(p.puntos) / count( p.jugador ),2)+0 desc";
			  }
			   // Calcular el n?mero de jugadores
				  
				  $consulta = mysql_query ($instruccion, $conexion)
					 or die ("Fallo en la consulta");
				  $nfilas = mysql_num_rows ($consulta);
		
			   // Calcular el n?mero de votantes
				  
				  $revotantes = mysql_query ($quevotantes, $conexion)
					 or die ("Fallo en la consulta");
				  $nvotantes = mysql_num_rows ($revotantes);

			   // Calcular el n?mero de jornadas
				  
				  $quejornadas = "select distinct(jornada) from partidos where temporada='2013/2014' and jugado='S' order by jornada";
				  $rejornadas = mysql_query ($quejornadas, $conexion)
					 or die ("Fallo en la consulta");
				  $njornadas = mysql_num_rows ($rejornadas);
				  
			  // Última jornada
			  
			  	  $queultimajornada = "select * from partidos where jugado='S' and temporada='2013/2014' order by temporada desc, jornada desc limit 1";
				  $conultimajornada = mysql_query ($queultimajornada, $conexion)
					 or die ("Fallo en la consulta");
				  $resultimajornada = mysql_fetch_array ($conultimajornada);
				  $ultimajornada = $resultimajornada['jornada'];
				  
			   
			   	     
					  				  
			
			

           $resultado = mysql_fetch_array ($consulta);
	   $consulta = mysql_query ($instruccion, $conexion);
	   print('<form id="formver" method="get" action="resultado.php" enctype="multipart/form-data"><div class="fondonoticiass">Jornada ');
	   print('      <select name="jornada" id="jornada" onchange="document.forms[' . "'formver'" . '].submit();">
           	<option value="">Todas</option>');
	   for ($i=1; $i<=$njornadas; $i++) {
	   	$resultjornada = mysql_fetch_array ($rejornadas);		
	   	if(isset($jornada) && $jornada == $resultjornada['jornada']){
			print('			<option selected=selected value="'. $resultjornada['jornada'] . '">' . $resultjornada['jornada'] . '</option>');	
		}else{
			print('			<option value="'. $resultjornada['jornada'] . '">' . $resultjornada['jornada'] . '</option>');	
		}
	   }		
	   print('		</select> de la temporada ' . $temporada . '<input name="temporada" type="hidden" value="2013/2014"></input>
	           	</div>
	          	<div class="noticias"></br>' . "\n");
	   
	   if( ($nhavotado>0 || $jornada!=$ultimajornada || $_SESSION['rango']==2) && $nfilas>0 ){
	   print('       	<table id="myTable" class="tablesorter" align="center">' . "\n");
	   print('<thead>
                        <tr>
	   		  <th class="thjugadores"><a>Jugador</a></th>
			  <th class="thjugadores"><a>Media</a></th>
			  <th class="thjugadores"><a>Valoración Máxima</a></th>
			  <th class="thjugadores"><a>Valoración Mínima</a></th>
			</tr></thead><tbody>');
	   for ($i=0; $i<$nfilas; $i++) {
	   	$resultado = mysql_fetch_array ($consulta);
				print('<tr><td class="celdaest">' . $resultado['jugador'] .'</br><img width="65" height="80" src="' .$resultado['foto'] .'"/></td><td class="celdaest">' . $resultado['round(sum(p.puntos) / count( p.jugador ),2)'] . '</td><td class="celdaest"><div class="alineadocentro">');
				for ($c=0; $c<$resultado['maxpuntos']; $c++) {
					$d=$c+1;
					print('<div class="estrellamini">' .$d . '</div>');
				}
				 print('</div></td><td class="celdaest"><div class="alineadocentro">');
				for ($c=0; $c<$resultado['minpuntos']; $c++) {
					$d=$c+1;
					print('<div class="estrellamini">' .$d . '</div>');
				}				 
				 print('</div></td></tr>' . "\n");
	   }
	  print('        	
	  </tbody></table>');
	  }else{
	  	if($nfilas>0){
	  		print('<a class="resultado">No puedes consultar la jornada sin haber votado antes.</br></a>');
	  	}else{
	  		print('<a class="resultado">No hay votos para la jornada seleccionada.</br></a>');
	  	}
	  }
	  
print('</form></br>
	          	</div>
	           	<div class="fondonoticiasi">');
if(isset($jornada) && $jornada!='' && ($nhavotado>0 || $jornada!=$ultimajornada || $_SESSION['rango']==2))
{
	print('Votos Totales: ' . $nvotantes);
}	           	
print('</div>');
		  
		   
mysql_close($conexion);
		   ?>
		<br />   
		</div>
         <div class="fondoi"></div>
</div>
    
    </div>
    
</div>
</body>
</html>
