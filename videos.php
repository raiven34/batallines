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
	$("#videos").addClass("nivel1select");
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
           <table  align="center" class="tablaest">
  <tr>
    <td><iframe src="http://player.vimeo.com/video/16600125" width="400" height="320" frameborder="0"></iframe><p><a href="http://vimeo.com/16600125">TRIBUTO A LOS BATALLINES</a> </p></td>
  </tr>  
  <tr>
    <td><iframe src="http://player.vimeo.com/video/4957896" width="400" height="300" frameborder="0"></iframe><p><a href="http://vimeo.com/4957896">Batallines: J18-J22 F</a></p></td>
  </tr>
  <tr>
    <td><iframe src="http://player.vimeo.com/video/3484936" width="400" height="290" frameborder="0"></iframe><p><a href="http://vimeo.com/3484936">Batallines: J8-J15 RC1</a></p></td>
  </tr>
  <tr>
    <td><iframe src="http://player.vimeo.com/video/2572875" width="400" height="292" frameborder="0"></iframe><p><a href="http://vimeo.com/2572875">Batallines: Jornadas 3,5,6,7</a></p></td>
  </tr>
  <tr>
    <td><iframe src="http://player.vimeo.com/video/2224959" width="400" height="292" frameborder="0"></iframe><p><a href="http://vimeo.com/2224959">Batallines - MDC</a></p></td>
  </tr>
  <tr>
    <td><iframe src="http://player.vimeo.com/video/2219595" width="400" height="292" frameborder="0"></iframe><p><a href="http://vimeo.com/2219595">2 Avot informatica - Batallines</a></td>
  </tr>
  <tr>
    <td><iframe src="http://player.vimeo.com/video/2207337" width="400" height="292" frameborder="0"></iframe><p><a href="http://vimeo.com/2207337">Avot Informatica - Batallines</a></p></td>
  </tr>
</table>

		</div>
        <div class="fondoi"></div>  
</div>
    
    </div>
    
</div>
</body>
</html>
