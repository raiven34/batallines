<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
include('conexion.php');
$quejugadores = "SELECT * FROM jugadores";
$resjugadores = mysql_query($quejugadores, $conexion) or die(mysql_error());
$totjugadores = mysql_num_rows($resjugadores);
if ($totjugadores> 0) {
$ar=fopen("jugadores.php","w") or die("Problemas en la creacion");
fputs($ar,'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Batallines</title>
<link href="css/estilosweb.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/xpath.js" type="text/javascript"></script>
<script src="SpryAssets/SpryData.js" type="text/javascript"></script>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="js/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function MM_changeProp(objId,x,theProp,theValue) { //v9.0
  var obj = null; with (document){ if (getElementById)
  obj = getElementById(objId); }
  if (obj){
    if (theValue == true || theValue == false)
      eval("obj.style."+theProp+"="+theValue);');
fputs($ar,"\n");
fputs($ar,'else eval("obj.style."+theProp+"=' . "'" . '"+theValue+"' . "'" . '");');
fputs($ar,"\n");
fputs($ar,'  }
}');
fputs($ar, 'function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+"' . ".location='" . '"+args[i+1]+"' . "'" . '");
}

$(document).ready(function(){
	$("#login").load("compruebaloginrapido.php");
});
');
fputs($ar,"\n");
fputs($ar, '//-->');
fputs($ar,"\n");
fputs($ar, '$.backstretch("img/los_15_mejores_estadios_de_futbol_portada.jpg");
</script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>');
fputs($ar,"\n");
fputs($ar,'<body class="body" onload="' . "MM_changeProp('botonjugadores','','color','#F30','A')" . '">');
fputs($ar,"\n");
fputs($ar, '<div id="Contenedora">
    <div id="CentradaHS">
      <div id="cabecera"></div>
      <div id="publicidad">
		<table width="1024" align="center">
		<tr>
			<td>

				<a href="http://www.goaldivision.com/"> <img width="278" heigth="90" src="img/goaldivision.JPG"/></a>
			</td>
			<td>
<div id="c_cce8a9ad8e4323ee672d541dfc82a8e0" class="ancho"><h2 style="color: #000000; margin: 0 0 3px; padding: 2px; font: bold 13px/1.2 Verdana; text-align: center;">tiempo Las Rozas de Madrid</h2></div><script type="text/javascript" src="http://www.eltiempo.es/widget/widget_loader/cce8a9ad8e4323ee672d541dfc82a8e0"></script>
			</td>
   		</tr>
    	      	</table>	
     </div>            
      <div id="menu">
      	<table align="center" class="tablamenu">
          <tr>
            <td><a href="index.php" class="opcionmenu" id="botonnoticias" onmouseout="MM_changeProp(' . "'botonnoticias','','color','#F90','A')" . '" onmouseover="MM_changeProp(' ."'botonnoticias','','color','#F30','A')" . '">Noticias</a></td>
			<td><a href="votacion.php" class="opcionmenu" id="botonvota"  onmouseout="MM_changeProp(' . "'botonvota','','color','#F90','A')" . '" onmouseover="MM_changeProp(' ."'botonvota','','color','#F30','A')" . '">Pon Nota</a></td>
            <td><a id="botonjugadores" class="opcionmenu" href="jugadores.php">Jugadores</a></td>
            <td><a id="botonestadisticas" class="opcionmenu" href="estadisticas.php" onmouseout="MM_changeProp(' . "'botonestadisticas','','color','#F90','A')" . '" onmouseover="MM_changeProp('.  "'botonestadisticas','','color','#F30','A')" . '">Estadísticas</a></td>
            <td><a href="http://195.53.111.97/CampeonatosWeb/index1.aspx" target="_blank" class="opcionmenu" id="botonclasificacion" onmouseout="MM_changeProp(' . "'botonclasificacion','','color','#F90','A')" . '" onmouseover="MM_changeProp(' . "'botonclasificacion','','color','#F30','A')" . '">Clasificación</a></td>
            <td><a href="http://batallines.mforos.com/" target="_blank" class="opcionmenu" id="botonforo" onmouseout="MM_changeProp(' . "'botonforo','','color','#F90','A')" . '" onmouseover="MM_changeProp(' . "'botonforo','','color','#F30','A')" . '">Foro</a></td>
            <td><a id="botonvideos" class="opcionmenu" href="videos.php" onmouseout="MM_changeProp(' . "'botonvideos','','color','#F90','A')" . '" onmouseover="MM_changeProp(' . "'botonvideos','','color','#F30','A')" . '">Videos</a></td>
            <td><a id="botonadmin" class="opcionmenu" href="adminbatallines.php" target="_blank" onmouseout="MM_changeProp(' . "'botonadmin','','color','#F90','A')" . '" onmouseover="MM_changeProp(' . "'botonadmin','','color','#F30','A')" . '">Admin</a></td>
            <td><div id="login"></div></td>
          </tr>
        </table>');
fputs($ar, "      </div>\n");
fputs($ar,'      <div id="marquee"><marquee scrolldelay="200"><?PHP include("marquee.php") ?></marquee></div>');
fputs($ar, '<div class="fondo">
		<div class="fondos"></div>
		<div class="fondom">');
fputs($ar, "\n");
	$contador=0;
	while ($rowjugadores = mysql_fetch_assoc($resjugadores)) {
		$quetemporadas = "SELECT * FROM temporadas order by temporada desc";
		$restemporadas = mysql_query($quetemporadas, $conexion) or die(mysql_error());
		fputs($ar, 		  '<div id="TabbedPanels' . $contador . '" class="TabbedPanels">
		    <ul class="TabbedPanelsTabGroup">
		      <li class="TabbedPanelsTab" tabindex="0"><a>GENERAL</a></li>
		      <li class="TabbedPanelsTab" tabindex="0"><a>TOTALES</a></li>');
		while ($rowtemporadas = mysql_fetch_assoc($restemporadas)) {
			fputs($ar, '              <li class="TabbedPanelsTab" tabindex="0">' . $rowtemporadas['temporada'] . '</li>');	
		}
		
		fputs($ar, "\n");
		fputs($ar, '	        </ul>');
		fputs($ar, "\n");
		fputs($ar, '		    <div class="TabbedPanelsContentGroup">');
		fputs($ar, "\n");
		fputs($ar, '		      <div class="TabbedPanelsContent">');
		fputs($ar, "\n");
		fputs($ar, '		        <div class="divfoto"><img class="foto" src="' . $rowjugadores['foto'] . '" /></div>');
		fputs($ar, "\n");
		fputs($ar, '		        <div class="contenidoficha">');
		fputs($ar, "\n");
		fputs($ar, '                	<a class="tituloficha">Nombre: </a><a class="textoficha">' . $rowjugadores['jugador'] . '</a><br /><br />');
		fputs($ar, "\n");
		fputs($ar, '                    <a class="tituloficha">Fecha de Nacimiento: </a><a class="textoficha">' . $rowjugadores['fecha_nacimiento'] . '</a><br /><br />');
		fputs($ar, "\n");
		fputs($ar, '                    <a class="tituloficha">Número: </a><a class="textoficha">' . $rowjugadores['numero'] . '</a><br /><br />');
		fputs($ar, "\n");
		fputs($ar, '            <a class="tituloficha">Temporadas: </a><a class="textoficha">' . $rowjugadores['temporadas'] . '</a><br /><br />');
		fputs($ar, "\n");
		fputs($ar, '                    <a class="tituloficha">Descripción: </a><a class="textoficha">' . $rowjugadores['descripcion'] . '</a>');
		fputs($ar, "\n");
		fputs($ar, '                </div>');
		fputs($ar, "\n");
		fputs($ar, '		      </div>');
		fputs($ar, "\n");
		$queestadisticas = "SELECT * FROM estadisticas where jugador='" . $rowjugadores['apodo'] . "'";
		$resestadisticas = mysql_query($queestadisticas, $conexion) or die(mysql_error());
		fputs($ar, '              <div class="TabbedPanelsContent">');
		fputs($ar, "\n");
		fputs($ar, '              	<div class="divfoto"><img class="foto" src="' . $rowjugadores['foto'] . '" /></div>');
		fputs($ar, "\n");
		fputs($ar, '		        <div class="contenidoficha"><br /><br />');
		$golestotales=0;
		$amarillastotales=0;
		$rojastotales=0;
		$partidostotales=0;
		$asistenciastotales=0;
		while ($rowestadisticas = mysql_fetch_assoc($resestadisticas)) {
		$golestotales= $golestotales + $rowestadisticas['goles'];
		$amarillastotales= $amarillastotales + $rowestadisticas['amarillas'];
		$rojastotales= $rojastotales + $rowestadisticas['rojas'];
		$asistenciastotales= $asistenciastotales + $rowestadisticas['asistencias'];
		if($rowestadisticas['nopresentado']==null){
			$partidostotales++;
		}
		}
		fputs($ar, "\n");
		fputs($ar, '                	<a class="tituloficha">Goles Totales: </a><a class="textoficha">' . $golestotales . '</a><br /><br />');
		fputs($ar, "\n");
		fputs($ar, '                    <a class="tituloficha">Asistencias: </a><a class="textoficha">' . $asistenciastotales . '</a><br /><br />');
		fputs($ar, "\n");
		fputs($ar, '                    <a class="tituloficha">Amarillas Totales: </a><a class="textoficha">' . $amarillastotales . '</a><br /><br />');
		fputs($ar, "\n");
		fputs($ar, '                    <a class="tituloficha">Rojas Totales: </a><a class="textoficha">' . $rojastotales . '</a><br /><br />');
		fputs($ar, "\n");
		fputs($ar, '                    <a class="tituloficha">Partidos Totales: </a><a class="textoficha">' . $partidostotales . '</a>');
		fputs($ar, "\n");
		fputs($ar, '                </div>');
		fputs($ar, "\n");
		fputs($ar, '              </div>');
		fputs($ar, "\n");
		$restemporadas = mysql_query($quetemporadas, $conexion) or die(mysql_error());
		while ($rowtemporadas = mysql_fetch_assoc($restemporadas)) {
		$queestadisticas = "SELECT * FROM estadisticas where jugador='" . $rowjugadores['apodo'] . "'" . "AND temporada='" . $rowtemporadas['temporada'] . "'";
		$resestadisticas = mysql_query($queestadisticas, $conexion) or die(mysql_error());
		$goles=0;
		$amarillas=0;
		$rojas=0;
		$partidos=0;
		$asistencias=0;
		while ($rowestadisticas = mysql_fetch_assoc($resestadisticas)) {
		$goles= $goles + $rowestadisticas['goles'];
		$asistencias= $asistencias + $rowestadisticas['asistencias'];
		$amarillas= $amarillas + $rowestadisticas['amarillas'];
		$rojas= $rojas + $rowestadisticas['rojas'];
		if($rowestadisticas['nopresentado']==null){
			$partidos++;
		}
		}
		fputs($ar, '              <div class="TabbedPanelsContent">');
		fputs($ar, "\n");
		fputs($ar, '              	<div class="divfoto"><img class="foto" src="' . $rowjugadores['foto'] . '" /></div>');
		fputs($ar, "\n");
		fputs($ar, '		        <div class="contenidoficha"><br /><br />');
		fputs($ar, "\n");
		fputs($ar, '                	<a class="tituloficha">Goles: </a><a class="textoficha">' . $goles . '</a><br /><br />');
		fputs($ar, "\n");
		fputs($ar, '                	<a class="tituloficha">Asistencias: </a><a class="textoficha">' . $asistencias . '</a><br /><br />');
		fputs($ar, "\n");
		fputs( $ar,'                    <a class="tituloficha">Amarillas: </a><a class="textoficha">' . $amarillas . '</a><br /><br />');
		fputs($ar, "\n");
		fputs($ar, '                    <a class="tituloficha">Rojas: </a><a class="textoficha">' . $rojas . '</a><br /><br />');
		fputs($ar, "\n");
		fputs($ar, '                    <a class="tituloficha">Partidos: </a><a class="textoficha">' . $partidos . '</a>');
		fputs($ar, "\n");
		fputs($ar, '                </div>');
		fputs($ar, "\n");
		fputs($ar, '              </div>');
		}
		fputs($ar, "\n");
		fputs($ar,'	        </div>');
		fputs($ar, "\n");
		fputs($ar, '	      </div>');
		fputs($ar, "\n");
		fputs($ar, '          <br />');
		fputs($ar, "\n");
		
		$contador++;
	}
fputs($ar, '		</div>');
fputs($ar, "\n");
fputs($ar, '        <div class="fondoi"></div>  ');
fputs($ar, "\n");
fputs($ar, '</div>');
fputs($ar, "\n");
fputs($ar, '</div>');
fputs($ar, "\n");
fputs($ar, '</div>');
fputs($ar, "\n");
fputs($ar, '<script type="text/javascript">');
fputs($ar, "\n");
for ($i=0; $i<$totjugadores; $i++) {
	fputs($ar, 'var TabbedPanels0 = new Spry.Widget.TabbedPanels("TabbedPanels' . $i . '");');
}
fputs($ar, "\n");
fputs($ar, '</script>');
fputs($ar, "\n");
fputs($ar, '</body>');
fputs($ar, "\n");
fputs($ar, '</html>');
fputs($ar, "\n");

fclose($ar);
echo "Jugadores publicados correctamente.";
}
else echo "No hay jugadores en la BBDD.";
mysql_close($conexion);
?>
</body>
</html>