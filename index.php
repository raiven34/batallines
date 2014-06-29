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

$(document).ready(function(){
	$("#login").load("compruebaloginrapido.php");
	$("#noticias").addClass("nivel1select");
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

			   if ($resultado['imagen']!= NULL) {
			   	print('<div class="fondonoticiass">' . $resultado['titulo'] . '
	           	</div>
	          	<div class="noticias"><br /><img class="fotonoticia" src=' . "'" . $resultado['imagen'] . "'" . '/><div class="divtexto">' . $resultado['texto'] . '</div><a href="leernoticia.php?comienzo=' . $noticia . '" class="enlacever">Leer noticia completa</a>' . '<br /><br />' . '</div>
	           	<div class="fondonoticiasi">Escrito por: ' . $resultado['autor'] . ' el ' . $resultado['fecha'] . '</div>');
			   }
			   else{
			   	print('<div class="fondonoticiass">' . $resultado['titulo'] . '
	           	</div>
	          	<div class="noticias"><br /><img class="fotonoticia" src=' . "'img/Escudo.jpg'" . '/><div class="divtexto">' . $resultado['texto'] . '</div><a href="leernoticia.php?comienzo=' . $noticia . '" class="enlacever">Leer noticia completa</a>' . '<br /><br />' . '</div>
	           	<div class="fondonoticiasi">Escrito por: ' . $resultado['autor'] . ' el ' . $resultado['fecha'] . '</div>');
			   }

	}	  
		   
		   mysql_close($conexion);
		   ?>
		<br />
        <table align="center"><tr>
        	<?PHP 
        	$npaginas = $nnoticias / 10;
        	if ($nnoticias % 10 !=0){
        		$npaginas++;
        	}
        	$npaginas = floor($npaginas);
        	print('<td><a class="apagina" href="index.php?comienzo=0">Primera</a></td>');
        	for ($a=0; $a<$npaginas; $a++) {
        		$p = $a + 1;
        		$com = $a * 10;
        		if ($comienzo!=$com){
        			print('<td><a class="apagina" href="index.php?comienzo=' . $com . '">' . $p . "</a></td>");
        		}else{
        			print('<td><a class="apaginaresaltado" href="index.php?comienzo=' . $com . '">' . $p . "</a></td>");
        		}
        	}	
        	print('<td><a class="apagina" href="index.php?comienzo=' . $com . '">&Uacute;ltima</a></td>');
        	?>
        	</tr></table>   
		</div>

</div>
    
    </div>
    
</div>
</body>
</html>
