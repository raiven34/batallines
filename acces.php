
<?php

/*LOGIN*/

$usuario = $_POST['usuario'];
$passw = $_POST['password'];


require_once 'conexion.php';
$result = mysql_query("SELECT apodo from jugadores WHERE apodo = '$usuario' and password='$passw'");
$num_rows = mysql_affected_rows(); //numero de filas retornadas
if ($num_rows > 0) {

	$resultado[]=array("logstatus"=>"1");
}else{
	$resultado[]=array("logstatus"=>"0");
	}
	
echo json_encode($resultado);




?>
