<?php

require_once '../conexion.php';
if (isset($_POST['tipo']) && $_POST['tipo']=='a'){
	$sql="select * from jugadores where rango>0";
	//echo $sql;
	$res = mysql_query ($sql, $conexion);
	if(mysql_affected_rows()>0){
		while($row = mysql_fetch_array($res)){
			$datos []= array("apodo" => $row["apodo"], "foto" => $row["foto"],"desc" => utf8_encode($row["descripcion"]),"numero" => $row["numero"]) ;
		}
	}else{
		$datos []= array("apodo" => "", "foto" => "") ;
	}
}elseif(isset($_POST['tipo']) && $_POST['tipo']=='b' && isset($_POST['usuario']) ){
	$sql="select * from partidos where jugado='S' order by temporada desc, jornada desc limit 1";
	$res = mysql_query ($sql, $conexion);
	$resultado = mysql_fetch_array ($res);
	$jornada = $resultado['jornada'];
	$temporada = $resultado['temporada'];
	//echo $sql;
	$sql=" select e.jornada,e.temporada,e.jugador, e.nopresentado, e.goles, e.amarillas, e.rojas, j.apodo, j.foto  from estadisticas e, jugadores j where temporada='" . $temporada . "' AND jornada=" . $jornada . " and e.jugador=j.apodo and e.nopresentado='' and j.apodo<>'" . $_POST['usuario'] . "' group by e.jugador";
	$res = mysql_query ($sql, $conexion);
	if(mysql_affected_rows()>0){
		while($row = mysql_fetch_array($res)){
			$datos []= array("apodo" => $row["jugador"], "foto" => $row["foto"],"desc" => utf8_encode($row["nopresentado"]),"nota" => 1,"jornada" => $row["jornada"],"temporada" => $row["temporada"]) ;
		}
	}else{
		$datos []= array("apodo" => "", "foto" => "") ;
	}
}else{
	$datos []= array("apodo" => "", "foto" => "") ;
}
echo json_encode($datos);
?>