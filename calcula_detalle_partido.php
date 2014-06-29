

<?php  

if(isset($_REQUEST['temp']) && isset($_REQUEST['jornada'])){

	include('conexion.php');

	$quepart="select * from partidos where temporada='" . $_REQUEST['temp'] . "' AND jornada=" . $_REQUEST['jornada'] ;

	$respart = mysql_query($quepart, $conexion) or die(mysql_error());

	$numpart = mysql_affected_rows();

	$subpart = mysql_fetch_array ($respart);

	$quemvp="SELECT AVG( puntos ), j.foto FROM puntuaciones p, jugadores j WHERE temporada =  '" . $_REQUEST['temp'] . "' AND jornada =" . $_REQUEST['jornada'] ." AND j.apodo=p.jugador GROUP BY p.jugador ORDER BY AVG( puntos ) DESC";
	
	$resmvp = mysql_query($quemvp, $conexion) or die(mysql_error());

	$nummvp = mysql_affected_rows();
	
	$queincidencias="select * from estadisticas where temporada='" . $_REQUEST['temp'] . "' and jornada=" . $_REQUEST['jornada'] . " and (goles>0 or amarillas>0 or rojas>0 or asistencias>0)";
	
	$resincidencias = mysql_query($queincidencias, $conexion) or die(mysql_error());

	$numincidencias = mysql_affected_rows();
?>
<script type="text/javascript">
		
		$(document).ready(function(){
			$("#cerrar").click(function(){
						$("#vmodal").attr("style","display:none;");
						$("#miVentana").attr("style","display:none");
			});
			
		});
		
</script>

<div class="fondonoticiass" style="width:400px; background-size:100% 100%"><?php echo($subpart['local'] . " " . $subpart['goleslocal'] . " - " . $subpart['golesvisitante'] . " " . $subpart['visitante']); ?></div>

<div class="noticias" style="padding-top:10px; width:400px">

	<div style="float:left;padding-left:50px">

	<table cellspacing="0">

		<tr>

			<td>MVP</td>

		</tr>

		<tr>
<?php

$d=1;
$submvp = mysql_fetch_array ($resmvp);
$maxavg = $submvp['AVG( puntos )'];
while ($d<=$nummvp && $submvp['AVG( puntos )']==$maxavg) {

?>
			<td><img width="80" height="100" src="<?php echo($submvp['foto'])?>" /></td>
<?php
;
$d++;
$submvp = mysql_fetch_array ($resmvp);
} 

?>
		</tr>

	</table>

	</div>

	<div  style="text-align:left; padding-left:150px">

	<table>

		<tr>

			<td>Fecha: </td><td><?php echo($subpart['fecha']); ?></td>

		</tr>
		<tr>

			<td>Hora: </td><td><?php echo($subpart['hora']); ?></td>

		</tr>

		<tr>

			<td>Jornada: </td><td><?php echo($subpart['jornada']); ?></td>

		</tr>

		<tr>

			<td>Temporada: </td><td><?php echo($subpart['temporada']); ?></td>

		</tr>

		<tr>

			<td>Incidencias: </td>

		</tr>
<?php
for($d=0; $d<$numincidencias; $d++){
$subincidencias = mysql_fetch_array ($resincidencias);
?>     
		<tr>
			<td style="padding-left:20px;"><?php echo( $subincidencias['jugador']); ?> </td>
			<td>
<?php
for($c=0;$c<$subincidencias['goles'];$c++){
?>  
			<img src="balon.png" width="20" height="20" /> 
<?php
}
?>

<?php
for($c=0;$c<$subincidencias['asistencias'];$c++){
?>  
			<img src="img/asistencias.gif" width="20" height="20" /> 
<?php
}
?>

<?php
for($c=0;$c<$subincidencias['amarillas'];$c++){
?>  
			<img src="amarilla.png" width="12" height="20" /> 
<?php
}
?>

<?php
for($c=0;$c<$subincidencias['rojas'];$c++){
?>  
			<img src="roja.png" width="12" height="20" /> 
<?php
}
?>


			</td>
		</tr>  
<?php
}
?>
	</table>

	</div>

</div>

<div class="fondonoticiasi" style="width:400px; background-size:100% 100%"><a id="cerrar" class="enlace">Cerrar</a></div>		

<?php

}

mysql_close();



?>