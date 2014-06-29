<?php

require_once '../conexion.php';
$quetemp="select * from temporadas order by temporada desc limit 1";
$restemp = mysql_query($quetemp, $conexion) or die(mysql_error());
$row = mysql_fetch_array($restemp);
$ulttemp=$row["temporada"];
//jornadas
$que="SELECT jornada from puntuaciones WHERE temporada = '2013/2014' order by jornada desc limit 1";
$res = mysql_query($que, $conexion) or die(mysql_error());
$row = mysql_fetch_array($res);
$ultjornada = $row['jornada'];
if(isset($_REQUEST['temporada'])){
	$temp=$_REQUEST['temporada'];
}else{
	$temp=$ulttemp;
}
if(isset($_REQUEST['jornada']) && $_REQUEST['jornada']!="Todas"){
	$sql=" select p.jugador, p.puntos, p.jornada, p.temporada, j.apodo, j.foto, count( p.jugador ), sum(p.puntos), round(sum(p.puntos) / count( p.jugador ),2) as media, max(puntos) as maxpuntos, min(puntos) as minpuntos from jugadores j, puntuaciones p where p.jugador=j.apodo and jornada=" . $_REQUEST['jornada'] . " and temporada='" . $temp . "' group by p.jugador order by round(sum(p.puntos) / count( p.jugador ),1)+0 desc";
}else{
	$sql = "select p.jugador, p.puntos, p.jornada, p.temporada, j.apodo, j.foto, count( p.jugador ), sum(p.puntos), round(sum(p.puntos) / count( p.jugador ),2) as media, max(puntos) as maxpuntos, min(puntos) as minpuntos from jugadores j, puntuaciones p where p.jugador=j.apodo and temporada='" . $temp . "' group by p.jugador order by round(sum(p.puntos) / count( p.jugador ),2)+0 desc";
}
	//echo $sql;
	$res = mysql_query ($sql, $conexion);
	if(mysql_affected_rows()>0){
		while($row = mysql_fetch_array($res)){
			$datos []= array("apodo" => $row["jugador"], "foto" => $row["foto"],"media" => $row["media"],"maxpuntos" => $row["maxpuntos"],"minpuntos" => $row["minpuntos"],"ultjornada" => $ultjornada) ;
		}
	}else{
		$datos []= array("apodo" => "", "foto" => "") ;
	}

echo json_encode($datos);
?>