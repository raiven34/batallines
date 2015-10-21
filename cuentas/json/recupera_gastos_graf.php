<?php
session_start();
if ( ISSET($_SESSION["usuario"]) && ISSET($_SESSION["password"]) ){ 

    require_once '../../conexion.php';
    $query = "SELECT SUM(importe) as total, month(fecha) as mes from gastos";
    if(isset($_REQUEST['grupo']) && $_REQUEST['grupo']!=0){
        $query = $query . " where grupo=" . $_REQUEST['grupo'];
    }
    if(isset($_REQUEST['nombre']) && $_REQUEST['nombre']!='Todos'){
        $query = $query . " where nombre='" . $_REQUEST['nombre'] . "'";
    }    
    $query = $query . " group by month(fecha)";
    
    $res = mysql_query($query, $conexion) or die(mysql_error());

        if(mysql_affected_rows()>0){
                $contador=0;
                while($row = mysql_fetch_array($res)){
                        $datos []= array("mes" => $row["mes"], "total" => $row["total"]) ;
                }
        }else{
                $datos[] = array("resultado" => "0" , "ultima_conexion" => "") ;
        }

    echo json_encode($datos);
}  else {
    $datos[] = array("resultado" => "0" , "ultima_conexion" => "") ;
    echo json_encode($datos);
}
?>