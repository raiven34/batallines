<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Batallines</title>
<link href="css/estilosweb_new.css" rel="stylesheet" type="text/css" />
<link href="css/menu.css" rel="stylesheet" type="text/css" />
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
      eval("obj.style."+theProp+"="+theValue);
else eval("obj.style."+theProp+"='"+theValue+"'");
  }
}function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

$(document).ready(function(){
	$("#login").load("compruebaloginrapido.php");
	$("#jugadores").addClass("nivel1select");
});

//-->
$.backstretch("batfon.jpg");
</script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>
<body class="body">
<div id="Contenedora">
    <div id="CentradaHS">
      <div id="cabecera">
<?
include("menu.php");
?>     
      </div>

      <div id="marquee"><marquee scrolldelay="200"><?PHP include("marquee.php") ?></marquee></div><div class="fondo">
		<div class="fondos"></div>
		<div class="fondom">
<?php
include("conexion.php");

$quejuga="select * from jugadores where rango>0" ;

$resjuga = mysql_query($quejuga, $conexion) or die(mysql_error());

$numjuga = mysql_affected_rows();

for($d=0; $d<$numjuga; $d++){

	$subjuga = mysql_fetch_array ($resjuga);
?>
			<div class="noticias" style="padding-top:10px; width:600px">
					<div style="padding-left:50px;float:left;">

						<table cellspacing="0">
					
					
							<tr>
<?php
					

					
?>
								<td><img width="80" height="100" src="<?php echo($subjuga['foto'])?>" /></td>

							</tr>
					
						</table>
					</div>
					<div  style="text-align:left; padding-left:150px; padding-right:20px" >
						<table>

							<tr>
					
								<td>Nombre: </td><td><?php echo($subjuga['jugador']); ?></td>
					
							</tr>
					
							<tr>
					
								<td>Fecha Nacimiento: </td><td><?php echo($subjuga['fecha_nacimiento']); ?></td>
					
							</tr>
							<tr>
					
								<td>N&uacute;mero: </td><td><?php echo($subjuga['numero']); ?></td>
					
							</tr>
							<tr>
					
								<td>Temporadas: </td><td><?php echo($subjuga['temporadas']); ?></td>
					
							</tr>
							<tr>
					
								<td>Descripci&oacute;n: </td><td><?php echo($subjuga['descripcion']); ?></td>
					
							</tr>														
						</table>	
					</div>

			</div>
			</br>
<?php
}
mysql_close($conexion);
?>
        <div class="fondoi"></div>  
</div>
</div>
</div>
</body>
</html>
