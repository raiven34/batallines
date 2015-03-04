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
if(isset($_REQUEST['orden']) && $_REQUEST['orden']!='' ){
	$orden=$_REQUEST['orden'];
        
}else{
	$orden="temporada desc,jornada desc";
}
	$sql="SELECT * from partidos WHERE temporada =  '". $temp ."' order by " . $orden;
if($temp=='Todas'){
	$sql="SELECT * from partidos order by " . $orden;
}
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