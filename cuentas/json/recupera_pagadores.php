<?php
session_start();
$datos[] = array("resultado" => "0","datos" =>"") ;
if ( ISSET($_SESSION["usuario"]) && ISSET($_SESSION["password"]) ){ 

    require_once '../../conexion.php';
    $query="select distinct(usuario) from gastos_usuarios";
    $res = mysql_query($query, $conexion) or die(mysql_error());

        if(mysql_affected_rows()>0){
                while($row = mysql_fetch_array($res)){
			//$datos []= array("local" => $row["local"], "visitante" => $row["visitante"],"goleslocal" => $row["goleslocal"],"golesvisitante" => $row["golesvisitante"],"lugar" => $row["lugar"],"hora" => $row["hora"],"jornada" => $row["jornada"],"temporada" => $row["temporada"],"fecha" => $row["fecha"],"jugado" => $row["jugado"]) ;
			
                        $datos [0]["datos"][] = array_map('utf8_encode', $row);
		}
                $datos [0]["resultado"]="1";
        }else{
                $datos [0]["resultado"]="2";
        }

    
}  
echo json_encode($datos);

?>