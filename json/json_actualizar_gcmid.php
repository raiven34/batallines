
<?php

/*Acutualiza GCM_ID*/

$usuario = $_REQUEST['usuario'];
$id = $_REQUEST['id'];


require_once '../conexion.php';
$result = mysql_query("update jugadores set movil_id='$id' WHERE apodo = '$usuario'");
$num_rows = mysql_affected_rows(); //numero de filas retornadas
if ($num_rows > 0) {

	$resultado[]=array("logstatus"=>"1");
}else{
	$resultado[]=array("logstatus"=>"0");
	}
	
echo json_encode($resultado);




?>
