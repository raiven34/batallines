<?php
require_once '../conexion.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$jornada=$_REQUEST['jornada'];
$temp=$_REQUEST['temporada'];
$sql   = "SELECT (select count(*) from estadisticas where jugador=e.jugador and nopresentado='' and temporada='" . $temp . "') as partidos,(select round(avg(puntos),2) from puntuaciones where jugador=e.jugador and temporada='" . $temp . "') as puntos,j.foto, j.apodo, e.jugador, SUM( e.goles ) as goles , SUM( e.amarillas ) as amarillas , SUM( e.rojas ) as rojas, SUM( e.asistencias ) as asistencias FROM jugadores j, estadisticas e WHERE temporada =  '". $temp ."' AND j.apodo = e.jugador GROUP BY j.apodo order by apodo"; 
$clientes = $conexion->get_results($sql);
echo mysql_affected_rows();
return  json_encode($clientes);
?>

