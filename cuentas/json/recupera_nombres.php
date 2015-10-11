<?php
session_start();
$datos[] = array("resultado" => "0","datos" =>"") ;
if ( ISSET($_SESSION["usuario"]) && ISSET($_SESSION["password"]) ){ 

    require_once '../../conexion.php';
    $query="select distinct(nombre) from gastos";
    $res = mysql_query($query, $conexion) or die(mysql_error());

        if(mysql_affected_rows()>0){
                while($row = mysql_fetch_array($res)){
			$datos [0]["datos"][]= array("nombre" => $row["nombre"]) ;
			
//                        $datos [0]["datos"][] = array_map('utf8_encode', $row);
		}
                $datos [0]["resultado"]="1";
        }else{
                $datos [0]["resultado"]="2";
        }

    
}  
echo json_encode($datos);

?>