<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Batallines</title>
<link href="css/estilosweb.css" rel="stylesheet" type="text/css" />
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

$(document).ready(function(){
	$("#login").load("compruebaloginrapido.php");
});

$.backstretch("img/los_15_mejores_estadios_de_futbol_portada.jpg");
//-->
</script>
</head>

<body  class="body" onload="MM_changeProp('botonnoticias','','color','#F30','A')">

<div id="Contenedora">
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
            <td><a href="index.php" class="opcionmenu" id="botonnoticias">Noticias</a></td>
            <td><a href="votacion.php" class="opcionmenu" id="botonvota"  onmouseout="MM_changeProp('botonvota','','color','#F90','A')" onmouseover="MM_changeProp('botonvota','','color','#F30','A')">Pon Nota</a></td>
            <td><a id="botonjugadores" class="opcionmenu" href="jugadores.php" onmouseout="MM_changeProp('botonjugadores','','color','#F90','A')" onmouseover="MM_changeProp('botonjugadores','','color','#F30','A')">Jugadores</a></td>
            <td><a id="botonestadisticas" class="opcionmenu" href="estadisticas.php" onmouseout="MM_changeProp('botonestadisticas','','color','#F90','A')" onmouseover="MM_changeProp('botonestadisticas','','color','#F30','A')">Estad&iacute;sticas</a></td>
            <td><a href="http://batallines.mforos.com/" target="_blank" class="opcionmenu" id="botonforo" onmouseout="MM_changeProp('botonforo','','color','#F90','A')" onmouseover="MM_changeProp('botonforo','','color','#F30','A')">Foro</a></td>
            <td><a id="botonvideos" class="opcionmenu" href="videos.php" onmouseout="MM_changeProp('botonvideos','','color','#F90','A')" onmouseover="MM_changeProp('botonvideos','','color','#F30','A')">Videos</a></td>
            <td><a id="botonadmin" class="opcionmenu" href="adminbatallines.php" target="_blank" onmouseout="MM_changeProp('botonadmin','','color','#F90','A')" onmouseover="MM_changeProp('botonadmin','','color','#F30','A')">Admin</a></td>      
            <td><div id="login"></div></td>
          </tr>
        </table>
      </div>
      <div id="marquee"><marquee scrolldelay="200"><?PHP include("marquee.php") ?></marquee></div>
<div class="fondo">
		<div class="fondos"></div>
		<div class="fondom">
           &nbsp;
           <?PHP
include('conexion.php');
			      // Establecer el n?mero de filas por p?gina y la fila inicial
				      $num = 10; // n?mero de filas por p?gina
				      if (!isset($_REQUEST['comienzo'])) $comienzo = 0;
					  else {$comienzo = $_REQUEST['comienzo'];}
      
			   // Calcular el n?mero total de noticias
				  $instruccion = "select * from noticias order by fecha desc";
				  $consulta = mysql_query ($instruccion, $conexion)
					 or die ("Fallo en la consulta");
				  $nnoticias = mysql_num_rows ($consulta);
			   // Calcular el n?mero total de filas de la tabla
				  $instruccion = "select * from noticias order by fecha desc limit $comienzo, $num";
				  $consulta = mysql_query ($instruccion, $conexion)
					 or die ("Fallo en la consulta");
				  $nfilas = mysql_num_rows ($consulta);				  
			
			
           for ($i=0; $i<$nfilas; $i++) {
   	    $noticia=$comienzo+$i;
            $resultado = mysql_fetch_array ($consulta);
           print('<br />');
		   if ($resultado['rutaforo']!= NULL){
			   if ($resultado['imagen']!= NULL) {
			   	print('<div class="fondonoticiass">' . $resultado['titulo'] . '
	           	</div>
	          	<div class="noticias"><div class="divtexto">' . $resultado['texto'] . '</div></div>
	           	<div class="fondonoticiasi"><br />Escrito por: ' . $resultado['autor'] . ' el ' . $resultado['fecha'] . '</div>');
			   }
			   else{
			   	print('<div class="fondonoticiass">' . $resultado['titulo'] . '
	           	</div>
	          	<div class="noticias"><div class="divtexto">' . $resultado['texto'] . '</div></div>
	           	<div class="fondonoticiasi"><br />Escrito por: ' . $resultado['autor'] . ' el ' . $resultado['fecha'] . '</div>');
			   }
		  }else{
		  	  if ($resultado['imagen']!= NULL) {
			   	print('<div class="fondonoticiass">' . $resultado['titulo'] . '
	           	</div>
 	<div class="noticias"><div class="divtexto">' . $resultado['texto'] . '</div></div>
	           	<div class="fondonoticiasi"><br />Escrito por: ' . $resultado['autor'] . ' el ' . $resultado['fecha'] . '</div>');
			   }
			   else{
			   	print('<div class="fondonoticiass">' . $resultado['titulo'] . '
	           	</div>
 	<div class="noticias"><div class="divtexto">' . $resultado['texto'] . '</div></div>
	           	<div class="fondonoticiasi"><br />Escrito por: ' . $resultado['autor'] . ' el ' . $resultado['fecha'] . '</div>');
			   }
		  }
	}	  
		   
		   mysql_close($conexion);
		   ?>
		<br />   
		</div>
        <div class="fondoi"><table align="center"><tr>
        	<?PHP 
        	$npaginas = $nnoticias / 10;
        	if ($nnoticias % 10 !=0){
        		$npaginas++;
        	}
        	$npaginas = floor($npaginas);
        	print('<td><a class="apagina" href="index.php?comienzo=0">Primera P&aacute;gina</a></td>');
        	for ($a=0; $a<$npaginas; $a++) {
        		$p = $a + 1;
        		$com = $a * 10;
        		if ($comienzo!=$com){
        			print('<td><a class="apagina" href="index.php?comienzo=' . $com . '">' . $p . "</a></td>");
        		}else{
        			print('<td><a class="apaginaresaltado" href="index.php?comienzo=' . $com . '">' . $p . "</a></td>");
        		}
        	}	
        	print('<td><a class="apagina" href="index.php?comienzo=' . $com . '">&Uacute;ltima P&aacute;gina</a></td>');
        	?>
        	</tr></table>
        </div>  
</div>
    
    </div>
    
</div>
</body>
</html>
