
<?php

/*LOGIN*/

$usuario = $_REQUEST['usuario'];


require_once '../conexion.php';
			   // Calcular última jornada
$instruccion = "select * from partidos where jugado='S' order by temporada desc, jornada desc limit 1";
$consulta = mysql_query ($instruccion, $conexion)
or die (mysql_error());
$res = mysql_fetch_array ($consulta);
$jornada = $res['jornada'];
$temporada = $res['temporada'];
$result = mysql_query("SELECT * from puntuaciones WHERE jornada = '$jornada' and temporada='$temporada' and votante='$usuario'");
$num_rows = mysql_affected_rows(); //numero de filas retornadas
if ($num_rows > 0) {

	$resultado[]=array("logstatus"=>"1");
}else{
	$resultado[]=array("logstatus"=>"0");
	}
	
echo json_encode($resultado);




?>
