<?php

require_once '../conexion.php';

$sql="select apodo, movil_id from jugadores where movil_id!=''";

//echo ($sql);
	$res = mysql_query ($sql, $conexion);
	if(mysql_affected_rows()>0){
		while($row = mysql_fetch_array($res)){
			//$datos []= array("local" => $row["local"], "visitante" => $row["visitante"],"goleslocal" => $row["goleslocal"],"golesvisitante" => $row["golesvisitante"],"lugar" => $row["lugar"],"hora" => $row["hora"],"jornada" => $row["jornada"],"temporada" => $row["temporada"],"fecha" => $row["fecha"],"jugado" => $row["jugado"]) ;
			$datos [] = array_map('utf8_encode', $row);
		}
	}else{
		$datos []= array("local" => "", "visitante" => "") ;
	}

echo json_encode($datos);
?>