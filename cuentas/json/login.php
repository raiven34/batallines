<?php
$data_back = json_decode(file_get_contents('php://input'));
//$data = json_decode(stripslashes($_POST["form"])); // recogemos el JSON enviado desde JS y eliminamos los slashes /
//echo $data_back[0]["temporada"]; 
require_once '../../conexion.php';
$datos[] = array("resultado" => "" , "ultima_conexion" => "") ;
$tam = count($data_back);

for ($a=0; $a<$tam; $a++) {
	$usuario= $data_back[$a]->usuario;
	$password= $data_back[$a]->password;
	if($usuario!='' && $password!=''){
            $query="select * from usuarios_gastos where nombre='" . $usuario . "' and password='" . $password . "'";
            $consulta = mysql_query ($query, $conexion);
            if(mysql_affected_rows()>0){
                //$row = mysql_fetch_array($consulta);
                $datos[0]["resultado"]="1";
                session_start();
                $_SESSION["usuario"]=$usuario;
                $_SESSION["password"]=$password;
            }else{
                $datos[0]["resultado"]="2";
            }
        }else{
            $datos[0]["resultado"]="0";
        }
        //$inserta = mysql_query ($alta, $conexion);
        //echo $alta;
	
//	if(mysql_error()=="Duplicate entry '" . $usuario . "-" . $jugador . "-" . $jornada . "-" . $temporada . "' for key 'PRIMARY'"){
//	
//		
//		$datos[0] = array("Success" => "0") ;
//		$mensaje=$usuario . " vota duplicado";
//	}
	 

}
		

	echo json_encode($datos); //Devolvemos la respuesta en JSON
	

?>