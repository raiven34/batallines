<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
include('conexion.php');
//if ($totjugadores> 0) {
$ar=fopen("estadisticas.php","w") or die("Problemas en la creacion");
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
$quetemporadas = "SELECT * FROM temporadas order by temporada desc";
$restemporadas = mysql_query($quetemporadas, $conexion) or die(mysql_error());
while ($rowtemporadas = mysql_fetch_assoc($restemporadas)) {
	$temporada=str_replace('/','',$rowtemporadas['temporada']);
	fputs($ar,"\n");
	fputs($ar, 'var dsjugadores' . $temporada . '= new Spry.Data.XMLDataSet("xml/jugadores' . $temporada . '.xml", "jugadores/item", {sortOnLoad: "goles", sortOrderOnLoad: "descending", useCache: false});
	dsjugadores' . $temporada . '.setColumnType("goles", "number");
	dsjugadores' . $temporada . '.setColumnType("asistencias", "number");
	dsjugadores' . $temporada . '.setColumnType("partidos", "number");
	dsjugadores' . $temporada . '.setColumnType("amarillas", "number");
	dsjugadores' . $temporada . '.setColumnType("rojas", "number");
	dsjugadores' . $temporada . '.setColumnType("@item_id", "number");');	
}
fputs($ar,"\n");
fputs($ar, '//-->');
fputs($ar,"\n");
fputs($ar, 'function ver_ocultar(id){
var link="link" + id;
if(document.getElementById(id).className=="tablapartidos"){
	document.getElementById(id).className="tablapartidosoculto";
	MM_changeProp(link,"","color","#3366FF","A")

	
}else{
	document.getElementById(id).className="tablapartidos";
	MM_changeProp(link,"","color","#000066","A")
}
}
$.backstretch("img/los_15_mejores_estadios_de_futbol_portada.jpg");
</script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>');
fputs($ar,"\n");
fputs($ar,'<body class="body" onload="' . "MM_changeProp('botonestadisticas','','color','#F30','A')" . '">');
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
            <td><a id="botonjugadores" class="opcionmenu" href="jugadores.php" onmouseout="MM_changeProp(' . "'botonjugadores','','color','#F90','A')" . '" onmouseover="MM_changeProp('.  "'botonjugadores','','color','#F30','A')" . '">Jugadores</a></td>
            <td><a id="botonestadisticas" class="opcionmenu" href="estadisticas.php">Estadísticas</a></td>
            <td><a href="http://195.53.111.97/CampeonatosWeb/index1.aspx" target="_blank" class="opcionmenu" id="botonclasificacion" onmouseout="MM_changeProp(' . "'botonclasificacion','','color','#F90','A')" . '" onmouseover="MM_changeProp(' . "'botonclasificacion','','color','#F30','A')" . '">Clasificación</a></td>
            <td><a href="http://batallines.mforos.com/" target="_blank" class="opcionmenu" id="botonforo" onmouseout="MM_changeProp(' . "'botonforo','','color','#F90','A')" . '" onmouseover="MM_changeProp(' . "'botonforo','','color','#F30','A')" . '">Foro</a></td>
            <td><a id="botonvideos" class="opcionmenu" href="videos.php" onmouseout="MM_changeProp(' . "'botonvideos','','color','#F90','A')" . '" onmouseover="MM_changeProp(' . "'botonvideos','','color','#F30','A')" . '">Videos</a></td>
            <td><a id="botonadmin" class="opcionmenu" href="adminbatallines.php" target="_blank" onmouseout="MM_changeProp(' . "'botonadmin','','color','#F90','A')" . '" onmouseover="MM_changeProp(' . "'botonadmin','','color','#F30','A')" . '">Admin</a></td>
            <td><div id="login"></div></td>
          </tr>
        </table>');
fputs($ar, "\n");
fputs($ar, "      </div>\n");
fputs($ar,'      <div id="marquee"><marquee scrolldelay="200"><?PHP include("marquee.php") ?></marquee></div>');
fputs($ar, '<div class="fondo">
		<div class="fondos"></div>
		<div class="fondom">');
fputs($ar, "\n");

		fputs($ar,'<a class="aexcel" href="javi/ClasificacionF7.xlsx" target="_blank"><< DESCARGAR VERSIÓN EXCEL >></a><br/><br/>		  
		<div id="TabbedPanels1" class="TabbedPanels2"><ul class="TabbedPanelsTabGroup">');
		$restemporadas = mysql_query($quetemporadas, $conexion) or die(mysql_error());
		while ($rowtemporadas = mysql_fetch_assoc($restemporadas)) {
			$temporada = $rowtemporadas['temporada'];
			include('publicarjugadoresxml.php');
			$vectorgoles[$temporada]=$golestemp;
			$vectorasistencias[$temporada]=$asistenciastemp;
			$vectoramarillas[$temporada]=$amarillastemp;
			$vectorrojas[$temporada]=$rojastemp;
			$vectorestad[$temporada]=$totestad;			
			fputs($ar, '              <li class="TabbedPanelsTab" tabindex="0">' . $rowtemporadas['temporada'] . '</li>');	
		}
	
		
		fputs($ar, "\n");
		fputs($ar, '	        </ul>');
		fputs($ar, "\n");
		fputs($ar, '		    <div class="TabbedPanelsContentGroup2">');
		fputs($ar, "\n");
		$restemporadas = mysql_query($quetemporadas, $conexion) or die(mysql_error());
		while ($rowtemporadas = mysql_fetch_assoc($restemporadas)) {
		$temporada=str_replace('/','',$rowtemporadas['temporada']);
		fputs($ar, '		      <div class="TabbedPanelsContent"><br/>');
		fputs($ar, "\n");
		
fputs($ar,'				  <a id="linkestadisticas' . $rowtemporadas['temporada'] . '"class="acabecera" onclick="' . "ver_ocultar('" . "estadisticas" . $rowtemporadas['temporada'] . "')" . '">ESTADÍSTICAS ' . $rowtemporadas['temporada'] . '(Click para ver/ocultar)</a><br /><br />
                  <div id="estadisticas' . $rowtemporadas['temporada'] . '" spry:region="dsjugadores' . $temporada . '" class="tablapartidosoculto">
                  		<table class="tablaest" cellpadding="0" cellspacing="0" width="980">
                              <tr>
                                <th class="cabeceraest" scope="col"><a class="tituloficha">Foto</a></th>
                                <th onclick="dsjugadores' . $temporada . '.sort(' . "'jugador'" . ');" class="thjugadores" scope="col"><a class="tituloficha">Jugador</a></th>
                                <th onclick="dsjugadores' . $temporada . '.sort(' . "'partidos'" . ');" class="thjugadores" scope="col"><a class="tituloficha">Partidos</a></th>                                
                                <th onclick="dsjugadores' . $temporada . '.sort(' . "'goles'" . ');" class="thjugadores" scope="col"><a class="tituloficha">Goles</a><img  title="Goles" src="balon.png" width="20" height="20" /></th>
                                <th onclick="dsjugadores' . $temporada . '.sort(' . "'asistencias'" . ');" class="thjugadores" scope="col"><a class="tituloficha">Asistencias</a><img  title="Asistencias" src="img/asistencias.gif" width="20" height="20" /></th>
                                <th onclick="dsjugadores' . $temporada . '.sort(' . "'amarillas'" . ');" class="thjugadores" scope="col"><a class="tituloficha">Amarillas</a><img  title="Amarillas" src="amarilla.png" width="12" height="20" /></th>
                                <th onclick="dsjugadores' . $temporada . '.sort(' . "'rojas'" . ');" class="thjugadores" scope="col"><a class="tituloficha">Rojas</a><img  title="Rojas" src="roja.png" width="12" height="20" /></th>
                                <th class="cabeceraest" scope="col"><a class="tituloficha">Ausencias</a></th>
                              </tr>
                              <tr spry:repeat="dsjugadores' . $temporada . '">
                                <td class="celdaest"><img src=' . "'{dsjugadores" . $temporada . "::foto}'" . 'width="50" height="50" /></td>
                                <td class="celdaest">{dsjugadores' . $temporada . '::jugador}</td>
                                <td class="celdaest">{dsjugadores' . $temporada . '::partidos}</td>
                                <td class="celdaest">{dsjugadores' . $temporada . '::goles}</td>
                                <td class="celdaest">{dsjugadores' . $temporada . '::asistencias}</td>
                                <td class="celdaest">{dsjugadores' . $temporada . '::amarillas}</td>
                                <td class="celdaest">{dsjugadores' . $temporada . '::rojas}</td>
                                <td class="celdaest">{dsjugadores' . $temporada . '::ausencias}</td>
                              </tr>
                              <tr>
                                <td class="cabeceraest" colspan="2">Totales</td>
                                <td class="cabeceraest">' . $vectorestad[$temporada] . '</td>
                                <td class="cabeceraest">' . $vectorgoles[$temporada] . '</td>
                                <td class="cabeceraest">' . $vectorasistencias[$temporada] . '</td>
                                <td class="cabeceraest">' . $vectoramarillas[$temporada] . '</td>
                                <td class="cabeceraest">' . $vectorrojas[$temporada] . '</td>
                                <td class="cabeceraest"></td>
                              </tr>                              
                        </table>
						<br />
                  </div>');
fputs($ar, '		                          <a id="linktemporada' . $rowtemporadas['temporada'] . '" class="acabecera" onclick="' . "ver_ocultar('" . "temporada" . $rowtemporadas['temporada'] . "')" . '">PARTIDOS ' . $rowtemporadas['temporada'] . '(Click para ver/ocultar)</a><br /><br />
		<div id="temporada' . $rowtemporadas['temporada'] . '" class="tablapartidosoculto">
					  <table class="tablaest" width="980" cellpadding="0" cellspacing="0" >
                        <tr>
                          <th class="cabeceraest" scope="col"><a class="tituloficha">Jornada</a></th>
                          <th class="cabeceraest" scope="col"><a class="tituloficha">Local</a></th>
                          <th class="cabeceraest" scope="col"><a class="tituloficha">Visitante</a></th>
                          <th class="cabeceraest" scope="col"><a class="tituloficha">Resultado</a></th>
                          <th class="cabeceraest" scope="col"><a class="tituloficha">Fecha</a></th>
                          <th class="cabeceraest" scope="col"><a class="tituloficha">Estadísticas</a></th>
                          <th class="cabeceraest" scope="col"><a class="tituloficha">Jugador del Partido</a></th>
                        </tr>');
                        fputs($ar, "\n");
                        $quepartidos = "SELECT * FROM partidos where temporada='" . $rowtemporadas['temporada'] . "' ORDER BY jornada";
			$respartidos = mysql_query($quepartidos, $conexion) or die(mysql_error());
            while ($rowpartidos = mysql_fetch_assoc($respartidos)) {
				fputs($ar,'                     <tr>
					                          <td class="celdaest" scope="col">Jornada ' . $rowpartidos['jornada']. '</td>
					                          <td class="celdaest" scope="col">' . $rowpartidos['local'] . '</td>
					                          <td class="celdaest" scope="col">' . $rowpartidos['visitante'] . '</td>
					                          <td class="celdaest" scope="col">' . $rowpartidos['goleslocal'] . '-' . $rowpartidos['golesvisitante'] . '</td>
					                          <td class="celdaest" scope="col">' . $rowpartidos['fecha']. '</td>
					                          <td class="celdaest" scope="col">
											  	<table cellpadding="0" cellspacing="0" >');
				fputs($ar, "\n");
		    	$queestadisticas = "SELECT * FROM estadisticas where temporada='" . $rowtemporadas['temporada'] . "' AND jornada=" . $rowpartidos['jornada'] . " AND(goles !=0 OR amarillas !=0 OR rojas !=0 OR asistencias!=0) ORDER BY jugador";
			    $resestadisticas = mysql_query($queestadisticas, $conexion) or die(mysql_error());
				while ($rowestadisticas = mysql_fetch_assoc($resestadisticas)) {
					   fputs($ar,'                         		<tr>');
					   fputs($ar,'                           		<td align="left">' . $rowestadisticas['jugador'] . ':&nbsp;</td>');
					   for ($i=0; $i<$rowestadisticas['goles']; $i++) {
					   	fputs($ar,'                           		<td><img  title="Gol" src="balon.png" width="20" height="20" /></td>');
					   }
					   for ($i=0; $i<$rowestadisticas['asistencias']; $i++) {
					   	fputs($ar,'                           		<td><img  title="Asistencia" src="img/asistencias.gif" width="20" height="20" /></td>');
					   }					   
					   for ($i=0; $i<$rowestadisticas['amarillas']; $i++) {
					   	fputs($ar,'                           		<td><img  title="Amarilla" src="amarilla.png" alt="" width="12" height="18" /></td>');
					   }
					   for ($i=0; $i<$rowestadisticas['rojas']; $i++) {
					   	fputs($ar,'                           		<td><img  title="Rojas" src="roja.png" alt="" width="12" height="18" /></td>');
					   }
					   fputs($ar,'                         		</tr>');
					                          		
				}
				fputs($ar, "</table></td>\n");
				$quepuntuaciones = "select e.jugador, sum(e.puntos), j.foto, round(avg(e.puntos),2) from puntuaciones e, jugadores j where temporada='" . $rowtemporadas['temporada'] . "' and j.apodo=e.jugador and jornada=" . $rowpartidos['jornada'] . " group by jugador ORDER BY avg(e.puntos) DESC";
			        $conpuntuaciones = mysql_query($quepuntuaciones, $conexion) or die(mysql_error());
				$nfilas = mysql_num_rows ($conpuntuaciones);
				fputs($ar,'							  
					                          <td class="celdaest" scope="col"><table  align="center" cellpadding="0" cellspacing="0" >');

			        fputs($ar,'                         		<tr>');
			        $respuntuaciones = mysql_fetch_array ($conpuntuaciones);
			        $maxpunt = $respuntuaciones['round(avg(e.puntos),2)'];
			        $conpuntuaciones = mysql_query($quepuntuaciones, $conexion) or die(mysql_error());
			        for ($i=0; $i<$nfilas; $i++){
			        	$respuntuaciones = mysql_fetch_array ($conpuntuaciones);
			        	if($respuntuaciones['round(avg(e.puntos),2)'] == $maxpunt){
			        	fputs($ar, '                         			<td><table><tr><td><img width="80" height="80" src="' . $respuntuaciones['foto'] . '" /></td></tr><tr><td>' . $respuntuaciones['jugador'] . '</td></tr></table></td>' . "\n");			        	
			        	}
			        }
			        fputs($ar,'                         		</tr>');
			        
				fputs($ar,'</table></td>
					                        </tr>');
				fputs($ar, "\n");	                        
	         }
                 
                 
                 fputs($ar, '                        </table>
                  </div>
                  <br />
                  <br />');
                fputs($ar, "\n");                    
		fputs($ar, '		      </div>');
		}
		fputs($ar, "\n");
		fputs($ar, '              </div>');
		fputs($ar, "\n");

fputs($ar, '		</div>');
fputs($ar, '	    </div>');
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
fputs($ar, 'var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");');

fputs($ar, "\n");
fputs($ar, '</script>');
fputs($ar, "\n");
fputs($ar, '</body>');
fputs($ar, "\n");
fputs($ar, '</html>');
fputs($ar, "\n");
fclose($ar);
echo "Estad&iacute;sticas publicadas correctamente.";

// else echo "No hay jugadores en la BBDD.";
mysql_close($conexion);
?>
</body>
</html>