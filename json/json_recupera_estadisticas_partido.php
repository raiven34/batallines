<?php
$datos = array();
require_once '../conexion.php';
if($_REQUEST['jornada']=="" || $_REQUEST['jornada']==""){
	$quetemp="select * from partidos where jugado='N' order by temporada desc, jornada limit 1";
	$restemp = mysql_query($quetemp, $conexion) or die(mysql_error());
	$resultado = mysql_fetch_array ($restemp);
	$temporada = $resultado['temporada'];
	$jornada = $resultado['jornada'];
}else{
	$temporada = $_REQUEST['temporada'];
	$jornada = $_REQUEST['jornada'];
}
$sql="select p.jugador,j.foto from puntuaciones p , jugadores j where p.jugador=j.apodo and jornada=" . $jornada . " and temporada='" . $temporada . "' group by jugador order by avg(puntos) desc limit 0,1";
$res = mysql_query ($sql, $conexion);
$existepunt=mysql_affected_rows();
if($existepunt>0){
	$rowpunt = mysql_fetch_array($res);
	$mvp=$rowpunt["jugador"];
        $fotomvp=$rowpunt["foto"];
}else{
	$mvp="null";
        $fotomvp="img/anonimo.JPG";
}
$sqlpart="select * from partidos where jornada='" . $jornada . "' and temporada='" . $temporada . "'";
$respart = mysql_query ($sqlpart, $conexion);
$existe=mysql_affected_rows();
//echo ($sqlpart);
$row = mysql_fetch_array($respart);

$datos []= array("jornada" => $row["jornada"], "temporada" => $row["temporada"],"local" => utf8_encode($row["local"]),"visitante" => utf8_encode($row["visitante"]),"goleslocal" => $row["goleslocal"],"golesvisitante" => $row["golesvisitante"],"lugar" => utf8_encode($row["lugar"]),"fecha" => $row["fecha"],"hora" => $row["hora"],"jugado" => $row["jugado"],"mvp" => $mvp,"fotomvp" => $fotomvp) ;

if(isset($temporada) && isset($jornada) && $existe>0){
	$temporada = $_REQUEST['temporada'];
	$jornada = $_REQUEST['jornada'];
	$sql="select * from estadisticas where jornada='$jornada' and temporada='$temporada' and (goles!=0 or amarillas!=0 or rojas!=0 or asistencias!=0)";
	//echo $sql;
	$res = mysql_query ($sql, $conexion);
	if(mysql_affected_rows()>0){
		while($row = mysql_fetch_array($res)){
			$datos2 []= array("jugador" => $row["jugador"], "goles" => $row["goles"],"amarillas" => $row["amarillas"],"rojas" => $row["rojas"],"asistencias" => $row["asistencias"]) ;
			
		}
		
	}else{
		$datos2 []= array("jugador" => "") ;
	}
	$datos [] = $datos2;
}else{
	$datos []= array("jugador" => "") ;
}
echo json_encode($datos);
?>