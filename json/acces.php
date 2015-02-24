
<?php

/*LOGIN*/

$usuario = $_REQUEST['usuario'];
$passw = $_REQUEST['password'];


require_once '../conexion.php';
$restemp = mysql_query("select temporada from temporadas order by temporada desc limit 1");
$row = mysql_fetch_array($restemp);
$temporada = $row['temporada'];
$resjor = mysql_query("SELECT jornada from puntuaciones WHERE temporada = '" . $temporada . "' order by jornada desc limit 1");
$num_rows = mysql_affected_rows(); //numero de filas retornadas
if ($num_rows > 0) {
	$row = mysql_fetch_array($resjor);
	$jornada = $row['jornada'];
}else{
	$jornada=1;
}
$result = mysql_query("SELECT apodo, movil_id,version from jugadores WHERE apodo = '$usuario' and password='$passw'");
$num_rows = mysql_affected_rows(); //numero de filas retornadas
if ($num_rows > 0) {
	$row = mysql_fetch_array($result);
	$resultado[]=array("logstatus"=>"1","movil_id"=>$row['movil_id'],"ult_jornada"=>$jornada,"temporada"=>$temporada);
	$mensaje="Login Correcto";
        if(isset($_REQUEST['version'])){
            $quever = "UPDATE jugadores set version='" . $_REQUEST['version']. "' WHERE apodo='$usuario'";
            $resver = mysql_query($quever, $conexion) or die(mysql_error());
        }
}else{
	$resultado[]=array("logstatus"=>"0","movil_id"=>"","ult_jornada"=>$jornada,"temporada"=>$temporada);
	$mensaje="Login Incorrecto";
	}
	
include('../logbatallines.php');
$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $usuario . "','Login Movil','" . $mensaje . "')";
$reslog = mysql_query($quelog, $conexion) or die(mysql_error());
echo json_encode($resultado);




?>
