<?php

require_once '../conexion.php';

if(isset($_REQUEST['orden'])){
	$orden=$_REQUEST['orden'];
}else{
	$orden="partidos desc";
}

	$sql="SELECT * from noticias order by fecha desc" ;

	//echo $sql;
	$res = mysql_query ($sql, $conexion);
	if(mysql_affected_rows()>0){
		while($row = mysql_fetch_array($res)){
			$datos [] = array_map('utf8_encode', $row);
		}
	}else{
		$datos []= array("apodo" => "", "foto" => "") ;
	}

echo json_encode($datos);
?>