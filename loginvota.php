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
});

function votar(nombre,puntos) {
	for (i=1;i<=5;i++) {
			$("#" + nombre + i).attr("src", "img/estrellab.gif");	
	}

	for (i=1;i<=puntos;i++) {
			$("#" + nombre + i).attr("src", "img/estrella.gif");	
	}
	
}

$.backstretch("batfon.jpg");
//-->

</script>
</head>

<body  class="body" onload="MM_changeProp('botonnoticias','','color','#F30','A')">

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

<form name="frm_login" method="post" action="compruebalogin.php">
<div class="centradaadmin" >
	<table align="center">
	<tr>
	<td class="cabeceraest" ><a class="acabecera">Usuario: <input type="text" size="10" name="usuario" /><br /></a></td>
	</tr>
	<tr>
	<td class="cabeceraest" ><a class="acabecera">Clave: &nbsp;&nbsp;&nbsp;&nbsp;<input type="password" size="10" name="pass" /><br /></a></td>
	</tr>
	<tr>
	<td class="cabeceraest" ><a><input type="submit" name="submit" value="Entrar" /><br /></a></td>
	</tr>

	</table>
</div>
</form>

<table align="center">
		<tr>
	<td>
		<?php
			if (isset($_GET['error'])) {
			    echo '<b>Usuario o clave incorrecta. El Medusa debe autorizarte ;)</b>';
			}
		?>
	</td>
	</tr>
</table>	
		<br />   
		</div>
        <div class="fondoi"></div>
</div>
    
    </div>
    
</div>
</body>
</html>
