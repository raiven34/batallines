<?php
$data_back = json_decode(file_get_contents('php://input'));
//$data = json_decode(stripslashes($_POST["form"])); // recogemos el JSON enviado desde JS y eliminamos los slashes /
//echo $data_back[0]["temporada"]; 
require_once '../../conexion.php';
$datos[] = array("Modificados" => 0 , "Erroneos" => 0 , "Insertados" => 0 , "Eliminados" => 0 ) ;
$tam = count($data_back);

for ($a=0; $a<$tam; $a++) {
	$nombre= $data_back[$a]->nombre;
	$id= $data_back[$a]->id;
	$importe= $data_back[$a]->importe;
	$descripcion= $data_back[$a]->descripcion;
        $peridiocidad= $data_back[$a]->peridiocidad;
        $fecha= $data_back[$a]->fecha;
        $estado= $data_back[$a]->estado;
        $pagadores= $data_back[$a]->pagadores;
        $grupoid= $data_back[$a]->grupo->id;
	if($estado=='a'){
            if($grupoid!=''){
                $query = "insert into gastos (nombre,descripcion,peridiocidad,grupo,importe) values('" . $nombre . "','" . $descripcion .  "'," . $peridiocidad . "," . $grupoid . "," . $importe . ")";
            }else{
                $query = "insert into gastos (nombre,descripcion,peridiocidad,importe) values('" . $nombre . "','" . $descripcion .  "'," . $peridiocidad . "," . $importe . ")";
            }
            $inserta = mysql_query ($query, $conexion);
            if(mysql_error()){
		$datos[0]["Erroneos"] = $datos[0]["Erroneos"] + 1 ;
//		echo $query ;
//                echo mysql_error();
            }else{
                $tam2 = count($pagadores);
                $queryid="select id from gastos where nombre='" . $nombre ."'";
                $resid= mysql_query ($queryid, $conexion);
                $rowid = mysql_fetch_array($resid);
                for ($i=0; $i<$tam2; $i++) {
                    $pagusuario= $pagadores[$i]->usuario;
                    $pagimporte_pagado= $pagadores[$i]->importe_pagado;
                    $pagimporte_pagar= $pagadores[$i]->importe_pagar;
                    $paggasto= $rowid["id"];
                    $query2 = "insert into gastos_usuarios (usuario,importe_pagar,importe_pagado,gasto) values('" . $pagusuario . "'," . $pagimporte_pagar .  "," . $pagimporte_pagado . "," . $paggasto . ")";
                    $insertapagadores = mysql_query ($query2, $conexion);
                    //falta controlar errores al insertar en gastos_usuarios
                }
                $datos[0]["Insertados"]=$datos[0]["Insertados"] + 1; 
            }
        }elseif($estado=='m'){
            $query = "update partidos2 set local='" . $local . "' , fecha='" . $fecha . "' , jornada='" . $jornada . "' , temporada='" . $temporada . "' , visitante='" . $visitante . "',golesvisitante=" . $golesvisitante . ", goleslocal=" . $goleslocal . ", jugado='" . $jugado . "' , lugar='" . $lugar . ", hora='" . $hora . "' where temporada='" . $temporada . "' and jornada=" . $jornada . "";
            $datos[0]["Modificados"]=$datos[0]["Modificados"] + 1;
        }elseif($estado=='d'){
            $query = "delete from gastos where id=" . $id;
            $delete = mysql_query ($query, $conexion);
            if(mysql_error()){
                $datos[0]["Erroneos"] = $datos[0]["Erroneos"] + 1 ;
            }else{
                $datos[0]["Eliminados"]=$datos[0]["Eliminados"] + 1;
            }
        }
        //$inserta = mysql_query ($alta, $conexion);
        //echo $alta;
	

	 

}
		

	echo json_encode($datos); //Devolvemos la respuesta en JSON
	

?>