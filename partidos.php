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
<script type="text/javascript" src="http://filamentgroup.github.com/EnhanceJS/enhance.js"></script>
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="js/jquery.backstretch.min.js" type="text/javascript"></script>

<script src="js/jquery.tablesorter.js" type="text/javascript"></script>
<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
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
	$("#partidos").addClass("nivel1select");
	$("#login").load("compruebaloginrapido.php");
	$("#divestadisticas").load("calcula_partidos.php");
	$("#miVentana").click(function(){
		$("#vmodal").attr("style","display:none;");
		$("#miVentana").attr("style","display:none");
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
		<div id="vmodal"></div>
		<div id="miVentana"></div>
		<div class="fondos"></div>
		<div class="fondom">
			<div id="divestadisticas" name="divestadisticas"></div>
			<a class="acabecera" href="/javi/ClasificacionF7.xlsx">Descargar Excel</a>
		</div>
        <div class="fondoi"></div>  
</div>
    
    </div>
    
</div>
</body>
</html>
