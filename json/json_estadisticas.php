<?PHP include('../seguridad.php');?>
<?php
session_start();
$data = json_decode(stripslashes($_POST["form"])); // recogemos el JSON enviado desde JS y eliminamos los slashes /
 
require_once '../conexion.php';

$response = array (
 
"success" => 0
 
);
$tam = count($data);
for ($a=0; $a<$tam; $a++) {
	$jugador= $data[$a]->jugador;
	$jornada= $data[$a]->jornada;
	$temporada= $data[$a]->temporada;
	$nopresentado= $data[$a]->nopresentado;
	$goles= $data[$a]->goles;
	$asistencias= $data[$a]->asistencias;
	$amarillas= $data[$a]->amarillas;
	$rojas= $data[$a]->rojas;
	// Llamamos a la función de login situada en el fichero DB/DB_Functions.php. Devuelve un booleano
	 
	$sql = "INSERT INTO estadisticas (jugador,jornada,temporada,nopresentado,goles,asistencias,amarillas,rojas) VALUES ('" . $jugador . "'," . $jornada . ",'" . $temporada . "','" . $nopresentado . "','" . $goles . "','" . $asistencias . "','" . $amarillas . "','" . $rojas . "')";
	//echo $sql;
	$res = mysql_query ($sql, $conexion);
	
	if(mysql_error()=="Duplicate entry '" . $jugador . "-" . $jornada . "-" . $temporada . "' for key 'PRIMARY'"){
		
		$sql = "UPDATE estadisticas SET" . " nopresentado='" . $nopresentado . "'," . "goles='" . $goles . "', asistencias='" . $asistencias . "'," . "amarillas='" . $amarillas . "'," . "rojas='" . $rojas . "' WHERE jornada='" . $jornada . "' AND temporada='" . $temporada . "' AND jugador='" . $jugador . "'";
		//echo $sql;
		
		$res = mysql_query ($sql, $conexion);
	}
	
	if (mysql_affected_rows()==1) {

		$response["success"] = $response["success"]+1 ; 
	 
	}
}
	

	echo json_encode($response); //Devolvemos la respuesta en JSON
	

?>