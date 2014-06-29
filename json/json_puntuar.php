<?php
$data = json_decode(stripslashes($_POST["form"])); // recogemos el JSON enviado desde JS y eliminamos los slashes /
 
require_once '../conexion.php';
$datos[] = array("Success" => "1") ;
$tam = count($data);
$usuario= $_POST["usuario"];

for ($a=0; $a<$tam; $a++) {
	$jugador= $data[$a]->apodo;
	$nota= $data[$a]->nota;
	$jornada= $data[$a]->jornada;
	$temporada= $data[$a]->temporada;
	$mensaje=$usuario . " pone nota a la jornada " . $jornada . " temporada " . $temporada;

	$alta = "insert into puntuaciones (votante,jugador,puntos,jornada,temporada) values('" . $usuario . "','" . $jugador . "'," . $nota .  ",'" . $jornada . "','" . $temporada . "')";
	$inserta = mysql_query ($alta, $conexion);

	
	if(mysql_error()=="Duplicate entry '" . $usuario . "-" . $jugador . "-" . $jornada . "-" . $temporada . "' for key 'PRIMARY'"){
	
		
		$datos[0] = array("Success" => "0") ;
		$mensaje=$usuario . " vota duplicado";
	}
	 

}
		
	   include('../logbatallines.php');
	   $quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $usuario . "','Puntuar Movil','" . $mensaje . "')";
	   $reslog = mysql_query($quelog, $conexion) or die(mysql_error());

	echo json_encode($datos); //Devolvemos la respuesta en JSON
	

?>