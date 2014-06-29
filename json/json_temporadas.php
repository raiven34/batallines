
<?php

/*TEMPORADAS*/



require_once '../conexion.php';
$restemporadas = mysql_query("SELECT * from temporadas order by temporada desc", $conexion) or die(mysql_error());
$num_rows = mysql_affected_rows(); //numero de filas retornadas
if ($num_rows > 0) {
	while($row = mysql_fetch_array($restemporadas)){
            $datos []= array("temporada" => $row["temporada"]) ;
        }    
}else{
	$datos []= array("error" => "") ;
}
echo json_encode($datos);
?>
