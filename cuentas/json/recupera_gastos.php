<?php
session_start();
if ( ISSET($_SESSION["usuario"]) && ISSET($_SESSION["password"]) ){ 

    require_once '../../conexion.php';
    $query="select *, (select nombre from grupos where id=grupo) as nombre_grupo from gastos";
    $haywhere=FALSE;
    if(isset($_REQUEST['usuario']) && $_REQUEST['usuario']!='Todos'){
        $haywhere=TRUE;
        if(isset($_REQUEST['estado']) && $_REQUEST['estado']!=0){
            if($_REQUEST['estado']==1){
                $query= $query . " where id in(select gasto from  gastos_usuarios where usuario='" . $_REQUEST['usuario'] ."'  and importe_pagar>importe_pagado)"  ;  
            }else{
                $query= $query . " where id in(select gasto from  gastos_usuarios where usuario='" . $_REQUEST['usuario'] ."' and importe_pagar<importe_pagado)"  ;  
            }
        }else{
            $query= $query . " where id in(select gasto from  gastos_usuarios where usuario='" . $_REQUEST['usuario'] ."')"  ;  
        }

//    echo $query;
    }
    if(isset($_REQUEST['grupo']) && $_REQUEST['grupo']!=0){
        if($haywhere){
            $query= $query . " and grupo=" . $_REQUEST['grupo'];
        }  else {
            $query= $query . " where grupo=" . $_REQUEST['grupo'];
            $haywhere=TRUE;
        }
    }
    if(isset($_REQUEST['mes']) && $_REQUEST['mes']!=0){
        if($haywhere){
            $query= $query . " and fecha like('%-" . $_REQUEST['mes'] . "-%')";
        }  else {
            $query= $query . " where fecha like('%-" . $_REQUEST['mes'] . "-%')";
            
        }
    }
    if(isset($_REQUEST['nombre']) && $_REQUEST['nombre']!='Todos'){
        if($haywhere){
            $query= $query . " and nombre='" . $_REQUEST['nombre'] . "'";
        }  else {
            $query= $query . " where nombre='" . $_REQUEST['nombre'] . "'";
            
        }
    }    
//    echo $query;
    $res = mysql_query($query, $conexion) or die(mysql_error());

        if(mysql_affected_rows()>0){
                $contador=0;
                while($row = mysql_fetch_array($res)){
                        $grupo = array("id" => $row["grupo"], "nombre" => $row["nombre_grupo"]);
                        $pagadores=array();
                        $datos []= array("id" => $row["id"], "nombre" => $row["nombre"],"descripcion" => $row["descripcion"],"grupo" => $grupo,"importe" => floatval($row["importe"]),"peridiocidad" => $row["peridiocidad"],"fecha" => $row["fecha"],"pagadores" => $pagadores) ;
                        $query2="select * from gastos_usuarios where gasto=" . $row["id"];
                        $res2 = mysql_query($query2, $conexion) or die(mysql_error());
                        if(mysql_affected_rows()>0){
                            while($row2 = mysql_fetch_array($res2)){
                               $datos[$contador]["pagadores"][]= array("id" => $row2["id"], "usuario" => $row2["usuario"],"importe_pagar" => floatval($row2["importe_pagar"]), "importe_pagado" => floatval($row2["importe_pagado"]), "gasto" => $row2["gasto"]);
                            }
                        }
                        $contador ++;
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