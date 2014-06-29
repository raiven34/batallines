<?php

require_once '../conexion.php';
$quetemp="select * from temporadas order by temporada desc limit 1";
$restemp = mysql_query($quetemp, $conexion) or die(mysql_error());
$row = mysql_fetch_array($restemp);
$ulttemp=$row["temporada"];
if(isset($_REQUEST['temporada'])){
	$temp=$_REQUEST['temporada'];
}else{
	$temp=$ulttemp;
}
if(isset($_REQUEST['orden'])){
	$orden=$_REQUEST['orden'];
}else{
	$orden="partidos desc";
}

	$sql="SELECT (select count(*) from estadisticas where jugador=e.jugador and nopresentado='' and temporada='" . $temp . "') as partidos,(select round(avg(puntos),2) from puntuaciones where jugador=e.jugador and temporada='" . $temp . "') as puntos,j.foto, j.apodo, e.jugador, SUM( e.goles ) as goles , SUM( e.amarillas ) as amarillas , SUM( e.rojas ) as rojas, SUM( e.asistencias ) as asistencias FROM jugadores j, estadisticas e WHERE temporada =  '". $temp ."' AND j.apodo = e.jugador GROUP BY j.apodo order by " . $orden;
if($temp=='Todas'){
	$sql="SELECT (select count(*) from estadisticas where jugador=e.jugador and nopresentado='') as partidos,(select round(avg(puntos),2) from puntuaciones where jugador=e.jugador ) as puntos,j.foto, j.apodo, e.jugador, SUM( e.goles ) as goles , SUM( e.amarillas ) as amarillas , SUM( e.rojas ) as rojas, SUM( e.asistencias ) as asistencias FROM jugadores j, estadisticas e WHERE j.apodo = e.jugador GROUP BY j.apodo order by " . $orden;
}
	//echo $sql;
	$res = mysql_query ($sql, $conexion);
	if(mysql_affected_rows()>0){
		while($row = mysql_fetch_array($res)){
			$datos []= array("apodo" => $row["apodo"], "foto" => $row["foto"],"goles" => $row["goles"],"amarillas" => $row["amarillas"],"rojas" => $row["rojas"],"asistencias" => $row["asistencias"],"partidos" => $row["partidos"],"puntos" => $row["puntos"]) ;
		}
	}else{
		$datos []= array("apodo" => "", "foto" => "") ;
	}

echo json_encode($datos);
?>