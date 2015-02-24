<?php
require_once 'conexion.php';
$quetemp="select * from partidos where jugado='N' order by temporada desc, jornada limit 1";
$restemp = mysql_query($quetemp, $conexion) or die(mysql_error());
$resultado = mysql_fetch_array ($restemp);
//echo(mysql_affected_rows());
if(mysql_affected_rows()>0){
    if($resultado['visitante']=="BATALLINES FC"){
	$rival=$resultado['local'];
    }else{
	$rival=$resultado['visitante'];
    }
    $mensaje= $resultado['fecha'] . " " . $resultado['hora'] . " VS " . $rival;
    
    header('Location:http://batallines.es/json/gcm_engine.php?registrationIDs=todos&message=' . $mensaje .  '&apiKey=AIzaSyDbpsUSs-WPDzAlSJ268yBUzdJtNvyc35E&tipo=1');
}else{
    echo("No hay partidos");
}
?>