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
<script src="SpryAssets/xpath.js" type="text/javascript"></script>
<script src="SpryAssets/SpryData.js" type="text/javascript"></script>
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="js/jquery.backstretch.min.js" type="text/javascript"></script>
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

function votar(nombre,puntos) {
	for (i=0;i<=9;i++) {
			$("#" + nombre + i).removeClass("estrella");
			$("#" + nombre + i).addClass("estrellab");	
	}

	for (i=0;i<=puntos;i++) {
			$("#" + nombre + i).addClass("estrella");	
	}
	$("#val" + nombre).attr("value", puntos);
	
}

$(document).ready(function(){
	$("#login").load("compruebaloginrapido.php");
	$("#puntuar").addClass("nivel1select");
	$("#submit").click(function(){
		if(confirm('¿Seguro que quieres guardar esta votación?')){
			var datos = $("#puntuaciones").serialize();
			$.get("bdpuntuaciones.php",datos, function(resultado) {  
				$(".fondonoticiasi").html(resultado);
			});
		}	
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

   // Calcular última jornada
				  $instruccion = "select * from partidos where jugado='S' order by temporada desc, jornada desc limit 1";
				  $consulta = mysql_query ($instruccion, $conexion)
					 or die ("Fallo en la consulta");
				  $resultado = mysql_fetch_array ($consulta);
				  $jornada = $resultado['jornada'];
				  $local = $resultado['local'];
				  $visitante = $resultado['visitante'];
				  $goleslocal = $resultado['goleslocal'];
				  $golesvisitante = $resultado['golesvisitante'];
				  $temporada = $resultado['temporada'];
			   // Calcular el n?mero de jugadores
				  $instruccion = " select e.jornada,e.temporada,e.jugador, e.nopresentado, e.goles, e.amarillas, e.rojas, j.apodo, j.foto  from estadisticas e, jugadores j where temporada='" . $temporada . "' AND jornada=" . $jornada . " and e.jugador=j.apodo and e.nopresentado='' and j.apodo<>'" . $_SESSION['usuario'] . "' group by e.jugador";
				  $consulta = mysql_query ($instruccion, $conexion)
					 or die ("Fallo en la consulta");
				  $nfilas = mysql_num_rows ($consulta);
			   // Calcular si ha votado
				  $quevotantes = " select * from puntuaciones where temporada='" . $temporada . "' and jornada=" . $jornada . " and votante='" . $_SESSION['usuario'] . "'";
				  $revotantes = mysql_query ($quevotantes, $conexion)
					 or die ("Fallo en la consulta");
				  $votado = mysql_num_rows ($revotantes);
					  				  
			
			

           $resultado = mysql_fetch_array ($consulta);
		   $consulta = mysql_query ($instruccion, $conexion);
           print('<br />');
	   print('<div class="fondonoticiass">Jornada ' . $jornada . ' de la temporada ' . $temporada . '
	           	</div>
	          	<div class="noticias">' . "\n");
	   if($votado==0){
		   print('       	<form id="puntuaciones" method="post" action="bdpuntuaciones.php" enctype="multipart/form-data"><table cellspacing="5" id="tablavotaciones" align="center"><TR><TH colspan="11">' . $local . ' ' . $goleslocal . ' - ' . $golesvisitante . ' ' . $visitante . '</TH></TR>');
		   for ($i=0; $i<$nfilas; $i++) {
		   	$resultado = mysql_fetch_array ($consulta);
			print('<tr><input id="val' . $resultado['apodo'] . '" name="val' . $resultado['apodo'] . '" type="hidden" value="4" /><td>' . $resultado['apodo'] .'</br><img width="65" height="80" src="' .$resultado['foto'] .'"/></td><td><div class="estrella" id="' . $resultado['apodo'] . "0" . '" onclick="votar(' . "'" . $resultado['apodo'] . "'" . ',' . "'" . "0" . "'" . ')">1</div></td><td><div class="estrella" id="' . $resultado['apodo'] . "1" . '"   onclick="votar(' . "'" . $resultado['apodo'] . "'" . ',' . "'" . "1" . "'" . ')">2</div></td><td><div class="estrella" id="' . $resultado['apodo'] . "2" . '"   onclick="votar(' . "'" . $resultado['apodo'] . "'" . ',' . "'" . "2" . "'" . ')">3</div></td><td><div class="estrella" id="' . $resultado['apodo'] . "3" . '"   onclick="votar(' . "'" . $resultado['apodo'] . "'" . ',' . "'" . "3" . "'" . ')">4</div></td><td><div class="estrella" id="' . $resultado['apodo'] . "4" . '"   onclick="votar(' . "'" . $resultado['apodo'] . "'" . ',' . "'" . "4" . "'" . ')">5</div></td><td><div class="estrellab" id="' . $resultado['apodo'] . "5" . '"   onclick="votar(' . "'" . $resultado['apodo'] . "'" . ',' . "'" . "5" . "'" . ')">6</div></td><td><div class="estrellab" id="' . $resultado['apodo'] . "6" . '"   onclick="votar(' . "'" . $resultado['apodo'] . "'" . ',' . "'" . "6" . "'" . ')">7</div></td><td><div class="estrellab" id="' . $resultado['apodo'] . "7" . '"   onclick="votar(' . "'" . $resultado['apodo'] . "'" . ',' . "'" . "7" . "'" . ')">8</div></td><td><div class="estrellab" id="' . $resultado['apodo'] . "8" . '"   onclick="votar(' . "'" . $resultado['apodo'] . "'" . ',' . "'" . "8" . "'" . ')">9</div></td><td><div class="estrellab" id="' . $resultado['apodo'] . "9" . '"   onclick="votar(' . "'" . $resultado['apodo'] . "'" . ',' . "'" . "9" . "'" . ')">10</div></td></tr>' . "\n");
		   }
		  print('<tr><td colspan="11"><a class="boton" id="submit">Votar</a></td></tr>
		  <tr><td colspan="11"></br><a href="resultado.php?jornada=' . $jornada . '&temporada=' . $temporada . '" class="acabecera">Ver Resultados</a></td></tr>
		  </table></form>');
	   }else{
	   	print('<table cellspacing="40" align="center"><tr><th>' . $local . ' ' . $goleslocal . ' - ' . $golesvisitante . ' ' . $visitante . '</th></tr><tr><td><a class="resultado">Ya has votado esta semana</a></td></tr><tr><td><a href="resultado.php?jornada=' . $jornada . '&temporada=' . $temporada . '" class="acabecera">Ver Resultados</a></td></tr></table>');
	   }       	
	   print('	          	</div>
	           	<div class="fondonoticiasi"><br /></div>');

		  
		   
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
