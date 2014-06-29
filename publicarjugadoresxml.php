
<?php
	  
include('conexion.php');
//$temporada=$rowtemporadas['temporada'];
$quejugadores = "SELECT distinct(e.jugador), e.temporada, a.apodo, a.foto FROM jugadores a, estadisticas e WHERE e.temporada='" . $rowtemporadas['temporada'] . "' AND a.apodo=e.jugador ORDER BY e.jugador desc";
$resjugadores = mysql_query($quejugadores, $conexion) or die(mysql_error());
$totjugadores = mysql_num_rows($resjugadores);
$temporada=str_replace('/','',$temporada);
$br=fopen("xml/jugadores" . $temporada . ".xml","w") or die("Problemas en la creacion");
fputs($br,'<?xml version="1.0" encoding="UTF-8" standalone="yes"?>');
fputs($br,"\n");
fputs($br,'<jugadores xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">');
fputs($br,"\n");
if ($totjugadores> 0) {
	$id = 0;
	$golestemp=0;
	$amarillastemp=0;
	$rojastemp=0;
	while ($rowjugadores = mysql_fetch_assoc($resjugadores)) {
			$queestad = "SELECT * FROM estadisticas WHERE jugador='" . $rowjugadores['jugador'] . "' AND temporada='" . $rowtemporadas['temporada'] . "' ORDER BY jugador desc";
			$resestad = mysql_query($queestad, $conexion) or die(mysql_error());
			$totestad = mysql_num_rows($resestad);
			$partidos=0;
			$goles=0;
			$amarillas=0;
			$asistencias=0;
			$rojas=0;
			$ausencias='';
			while ($rowestad = mysql_fetch_assoc($resestad)) {
				if($rowestad['nopresentado']==null){
					$partidos++;
				}else{
					if ($ausencias==null){
					$ausencias = 'Jornada ' . $rowestad['jornada'] . ': ' . $rowestad['nopresentado'];	
					}else{
						$ausencias = $ausencias . ', Jornada ' . $rowestad['jornada'] . ': ' . $rowestad['nopresentado'];
					}	
				}
				$goles=$goles + $rowestad['goles'];
				$amarillas=$amarillas + $rowestad['amarillas'];
				$rojas=$rojas + $rowestad['rojas'];
				$asistencias=$asistencias + $rowestad['asistencias'];
			}
  			$golestemp=$golestemp + $goles;
			$amarillastemp=$amarillastemp + $amarillas;
			$rojastemp=$rojastemp + $rojas;
			$asistenciastemp=$asistenciastemp + $asistencias;
  			fputs($br,'<item item_id="' . $id);
  			fputs($br,'">');
  			fputs($br,"\n");
			fputs($br,"	<jugador>" . $rowjugadores['jugador'] . "</jugador>");
			fputs($br,"\n");
			fputs($br,"	<partidos>" . $partidos . "</partidos>");
			fputs($br,"\n");
			fputs($br,"	<goles>" . $goles . "</goles>");
			fputs($br,"\n");
			fputs($br,"	<asistencias>" . $asistencias . "</asistencias>");			
			fputs($br,"\n");
			fputs($br,"	<amarillas>" . $amarillas . "</amarillas>");
			fputs($br,"\n");
			fputs($br,"	<rojas>" . $rojas . "</rojas>");
			fputs($br,"\n");
			fputs($br,"	<foto>" . $rowjugadores['foto'] . "</foto>");
			fputs($br,"\n");
			fputs($br,"	<ausencias>" . $ausencias . "</ausencias>");
			fputs($br,"\n");
			fputs($br,"</item>");
			fputs($br,"\n");
$id++;
			
			
			
   
   }
 
}
fputs($br,'</jugadores>');
fclose($br);
//mysql_close($conexion);
?>
