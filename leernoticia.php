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

<?PHP
include('conexion.php');
// Establecer el n?mero de filas por p?gina y la fila inicial
				      $num = 1; // n?mero de filas por p?gina
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
				  $resultado = mysql_fetch_array ($consulta);	
?>
$(document).ready(function(){
	$("#noticias").addClass("nivel1select");
	$("#login").load("compruebaloginrapido.php");
	datos = "noticia=<?PHP echo $resultado['titulo']; ?>&fecha_noticia=<?PHP echo $resultado['fecha']; ?>";
	$.get("bdcomentarios.php",datos, function(resultado) {  
		$("#comentarios").html(resultado);
	});
	$("#enviar").click(function(){
		var datos = $("#form").serialize();
		datos = datos + "&noticia=<?PHP echo $resultado['titulo']; ?>&fecha_noticia=<?PHP echo $resultado['fecha']; ?>";
		$.get("bdcomentarios.php",datos, function(resultado) {  
			$("#comentarios").html(resultado);
			$("#texto").attr('value', '');
		});
	});
	$("#texto").click(function(){	
		$("#texto").attr('value', '');	
	});
});

$.backstretch("batfon.jpg");
//-->
</script>
</head>

<body  class="body" onload="MM_changeProp('botonnoticias','','color','#F30','A')">

<div id="Contenedora">
<div id="CentradaHS">
      <div id="cabecera">
	      <div id="menu">
	                    <ul>
	                      <li id="noticias" class="nivel1"><a href="index.php">Noticias</a>
	                      </li>
	                      <li id="puntuar" class="nivel1"><a href="votacion.php">Puntuar</a></li>
	                      <li id="jugadores" class="nivel1"><a href="jugadores.php">Plantilla</a>
	                      </li>
	                      <li id="estadisiticas" class="nivel1"><a href="estadisticas.php">Estad&iacute;sticas</a></li>
	                      <li id="partidos" class="nivel1"><a href="partidos.php">Partidos</a></li>
	                      <li id="clasificacion" class="nivel1"><a href="http://195.53.111.97/CampeonatosWeb/index1.aspx" target="_blank">Clasificación</a></li>
	                      <li id="foro" class="nivel1"><a href="http://batallines.mforos.com/" target="_blank">Foro</a></li>
	                      <li id="videos" class="nivel1"><a href="videos.php">Videos</a></li>
	                      <li id="admin" class="nivel1"><a href="http://batallines.comuv.com/adminbatallines.php" target="_blank">Admin</a></li>
	                    </ul>
	                    <div id="login"></div>  
	      </div>      
      </div>

      <div id="marquee"><marquee scrolldelay="200"><?PHP include("marquee.php") ?></marquee></div>
<div class="fondo">
		<div class="fondos"></div>
		<div class="fondom">
           &nbsp;
           <?PHP
	  
		  
			
			
           if ($nfilas>0) {
   
           print('<br />');

		  	  if ($resultado['imagen']!= NULL) {
			   	print('<div class="fondonoticiass">' . $resultado['titulo'] . '
	           	</div>
	          	<div class="noticias"><br /><img  class="fotonoticiaext" src=' . "'" . $resultado['imagen'] . "'" . '/><div class="divtexto">' . $resultado['texto'] . $resultado['texto2'] . '</div></div>
	           	<div class="fondonoticiasi">Escrito por: ' . $resultado['autor'] . ' el ' . $resultado['fecha'] . '</div>');
			   }
			   else{
			   	print('<div class="fondonoticiass">' . $resultado['titulo'] . '
	           	</div>
	          	<div class="noticias"><br /><img class="fotonoticia" src=' . "'img/Escudo.jpg'" . '/><div class="divtexto">' . $resultado['texto'] . $resultado['texto2'] . '</div></div>
	           	<div class="fondonoticiasi">Escrito por: ' . $resultado['autor'] . ' el ' . $resultado['fecha'] . '</div>');
			   }
	}	  
		   
		   mysql_close($conexion);
		   ?>
		<br />
			<div class="fondonoticiass">Comentarios</div>
			<div class="noticias">
				<form id="form" name="form" method="post" action="bdnoticias.php" enctype="multipart/form-data">
					<table align="center">
						<tr>
							<td><img width="65" height="80" src="
<?php 
	session_start();
	if (isset($_SESSION['foto'])){  
		echo ($_SESSION['foto']); 
	}else{
		echo ("img/anonimo.JPG");					
	}
?>
"/></td>
							<td><textarea class="textarea" name="texto" id="texto" cols="60" rows="5">Escribe comentario..</textarea></td>	
						</tr>
						<tr>
							<td colspan="2"><a  id="enviar" class="boton">Enviar</a></td>
						</tr>
					
					</table>
				</form>
			</br>
			<div class="comentarios" id="comentarios"></div>
			</div>
			<div class="fondonoticiasi"></div>

		<br />	   
		</div>
        <div class="fondoi">
        </div>  
</div>
    
    </div>
    
</div>
</body>
</html>
