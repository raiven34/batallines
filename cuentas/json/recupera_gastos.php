<?php
session_start();
if ( ISSET($_SESSION["usuario"]) && ISSET($_SESSION["password"]) ){ 

    require_once '../../conexion.php';
    $query="select g.*, gr.nombre as nombre_grupo from gastos g, grupos gr where gr.id=g.grupo";
    $res = mysql_query($query, $conexion) or die(mysql_error());

        if(mysql_affected_rows()>0){
                $contador=0;
                while($row = mysql_fetch_array($res)){
                        $grupo = array("id" => $row["grupo"], "nombre" => $row["nombre_grupo"]);
                        $pagadores=array();
                        $datos []= array("id" => $row["id"], "nombre" => $row["nombre"],"descripcion" => $row["descripcion"],"grupo" => $grupo,"importe" => $row["importe"],"peridiocidad" => $row["peridiocidad"],"fecha" => $row["fecha"],"pagadores" => $pagadores) ;
                        $query2="select * from gastos_usuarios where gasto=" . $row["id"];
                        $res2 = mysql_query($query2, $conexion) or die(mysql_error());
                        if(mysql_affected_rows()>0){
                            while($row2 = mysql_fetch_array($res2)){
                               $datos[$contador]["pagadores"][]= array("id" => $row2["id"], "usuario" => $row2["usuario"],"importe_pagar" => $row2["importe_pagar"], "importe_pagado" => $row2["importe_pagado"], "gasto" => $row2["gasto"]);
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