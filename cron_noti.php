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
    
    header('Location:http://batallines.es/json/gcm_engine.php?registrationIDs=APA91bGv_Iikmu0Vo_EVcWNgHDZiKzmVqD_MTSUAAQrAbrVmliwW5lAZ9O5-9lx2mt0ZoJ1r-IbnQRuR7-I1DekY_78cP7qfQQ9UfYaW7AQS0_cN0i9gseBydxESU--xIARGIlsf6aH66EcOExgBWSX_jVE-GwJ9wA&message=' . $mensaje .  '&apiKey=AIzaSyDbpsUSs-WPDzAlSJ268yBUzdJtNvyc35E&tipo=1');
}else{
    echo("No hay partidos");
}
?>