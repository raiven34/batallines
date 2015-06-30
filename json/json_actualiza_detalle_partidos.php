<?php
$data_back = json_decode(file_get_contents('php://input'));
//$data = json_decode(stripslashes($_POST["form"])); // recogemos el JSON enviado desde JS y eliminamos los slashes /
//echo $data_back[0]["temporada"]; 
require_once '../conexion.php';
$datos[] = array("Modificados" => "0" , "Erroneos" => "0" , "Insertados" => "0" , "Eliminados" => "0" ) ;
$tam = count($data_back);

for ($a=0; $a<$tam; $a++) {
	$local= $data_back[$a]->local;
	$fecha= $data_back[$a]->fecha;
	$jornada= $data_back[$a]->jornada;
	$temporada= $data_back[$a]->temporada;
        $visitante= $data_back[$a]->visitante;
        $golesvisitante= $data_back[$a]->golesvisitante;
        $goleslocal= $data_back[$a]->goleslocal;
        $jugado= $data_back[$a]->jugado;
        $lugar= $data_back[$a]->lugar;
        $hora= $data_back[$a]->hora;
        $estado= $data_back[$a]->estado;
	if($estado=='a'){
            $query = "insert into partidos2 (local,fecha,jornada,temporada,visitante,golesvisitante,goleslocal,jugado,lugar,hora) values('" . $local . "','" . $fecha . "'," . $jornada .  ",'" . $temporada . "','" . $visitante . "'," . $golesvisitante . "," . $goleslocal . ",'" . $jugado . "','" . $lugar . "','" . $hora . "')";
            $datos[0]["Insertados"]=$datos[0]["Insertados"] + 1;
        }elseif($estado=='m'){
            $query = "update partidos2 set local='" . $local . "' , fecha='" . $fecha . "' , jornada='" . $jornada . "' , temporada='" . $temporada . "' , visitante='" . $visitante . "',golesvisitante=" . $golesvisitante . ", goleslocal=" . $goleslocal . ", jugado='" . $jugado . "' , lugar='" . $lugar . ", hora='" . $hora . "' where temporada='" . $temporada . "' and jornada=" . $jornada . "";
            $datos[0]["Modificados"]=$datos[0]["Modificados"] + 1;
        }elseif($estado=='d'){
            $query = "delete partidos2 where temporada='" . $temporada . "' and jornada=" . $jornada . "";
            $datos[0]["Eliminados"]=$datos[0]["Eliminados"] + 1;
        }
        //$inserta = mysql_query ($alta, $conexion);
        //echo $alta;
	
	if(mysql_error()=="Duplicate entry '" . $usuario . "-" . $jugador . "-" . $jornada . "-" . $temporada . "' for key 'PRIMARY'"){
	
		
		$datos[0] = array("Success" => "0") ;
		$mensaje=$usuario . " vota duplicado";
	}
	 

}
		

	echo json_encode($datos); //Devolvemos la respuesta en JSON
	

?>