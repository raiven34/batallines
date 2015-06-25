<?php

require_once '../conexion.php';
if (isset($_REQUEST['temporada']) && isset($_REQUEST['jornada'])){
	$sql="select * from estadisticas where temporada='" . $_REQUEST['temporada'] . "' and jornada='" . $_REQUEST['jornada'] ."'";
	//echo $sql;
	$res = mysql_query ($sql, $conexion);
	if(mysql_affected_rows()>0){
		while($row = mysql_fetch_array($res)){
			$datos [] = array_map('utf8_encode', $row);
		}
	}else{
                $instruccion = "select apodo as jugador, '' as nopresentado,'" . $_REQUEST['temporada'] . "' as temporada,'" . $_REQUEST['jornada'] . "' as jornada,0 as goles, 0 as asistencias, 0 as amarillas, 0 as rojas from jugadores where rango>0";
		$consulta = mysql_query ($instruccion, $conexion)
                or die ("Fallo en la consulta");
                //echo $instruccion;
                while($row = mysql_fetch_array($consulta)){
                    $datos [] = array_map('utf8_encode', $row);
                }
	}
}else{
	$datos []= array("apodo" => "", "foto" => "") ;
}
echo json_encode($datos);
?>