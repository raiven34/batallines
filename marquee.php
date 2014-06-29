<?PHP

	  

include('conexionmarquee.php');



   // Calcular el n?mero total de filas de la tabla
   $instruccion = "select * from marquee where activado=1 order by orden";
   $consulta = mysql_query ($instruccion, $conexionmarquee)
      or die ("Fallo en la consulta");
   $nfilas = mysql_num_rows ($consulta);
   
   if ($nfilas > 0)
   {
   	for ($i=0; $i<$nfilas; $i++) {
			   $resultadomarquee = mysql_fetch_array ($consulta);
                switch ($resultadomarquee['id']){
                case 'Goles':
               		$goles="select e.jugador, sum(e.goles), j.foto from estadisticas e, jugadores j where temporada='" . $resultadomarquee['contenido'] . "' and j.apodo=e.jugador group by jugador ORDER BY sum( e.goles ) DESC
LIMIT 0 , 3";
			$str = '<a class="textomarquee">Goles: ';
			$congoles = mysql_query ($goles, $conexionmarquee)or die (mysql_error());
			for ($a=0; $a<3; $a++) {
				
				$resgoles = mysql_fetch_array ($congoles);
				$str=  $str . '<img  width="19" height="19" src="' . $resgoles['foto'] . '"/>' . $resgoles['jugador'] . " " . $resgoles['sum(e.goles)'] . " ";
			}
			$str = $str . "</a>";
			 
		break;
		case 'Amarillas':	
			$amarillas="select e.jugador, sum(e.amarillas), j.foto from estadisticas e, jugadores j where temporada='" . $resultadomarquee['contenido'] . "' and j.apodo=e.jugador group by jugador ORDER BY sum( e.amarillas ) DESC
LIMIT 0 , 3";
			$str = '<a class="textomarquee">Amarillas: ';
			$conamarillas = mysql_query ($amarillas, $conexionmarquee)or die (mysql_error());
			for ($a=0; $a<3; $a++) {
				
				$resamarillas = mysql_fetch_array ($conamarillas);
				$str=  $str . '<img  width="19" height="19" src="' . $resamarillas['foto'] . '"/>' . $resamarillas['jugador'] . " "  . $resamarillas['sum(e.amarillas)'] . " ";
			}
			$str = $str . "</a>";
			
		break;
		case 'Rojas':	
			$rojas="select e.jugador, sum(e.rojas), j.foto from estadisticas e, jugadores j where temporada='" . $resultadomarquee['contenido'] . "' and j.apodo=e.jugador group by jugador ORDER BY sum( e.rojas ) DESC
LIMIT 0 , 3";			
			$str = '<a class="textomarquee">Rojas: ';
			$conrojas = mysql_query ($rojas, $conexionmarquee)or die (mysql_error());
			for ($a=0; $a<3; $a++) {
				
				$resrojas = mysql_fetch_array ($conrojas);
				$str= $str . '<img  width="19" height="19" src="' . $resrojas['foto'] . '"/>' . $resrojas['jugador'] . " " . $resrojas['sum(e.rojas)'] . " ";
			}
			$str = $str . "</a>";
			

               break;
	       case 'Asistencias':	
			$asistencias="select e.jugador, sum(e.asistencias), j.foto from estadisticas e, jugadores j where temporada='" . $resultadomarquee['contenido'] . "' and j.apodo=e.jugador group by jugador ORDER BY sum( e.asistencias ) DESC
LIMIT 0 , 3";
			$str = '<a class="textomarquee">Asistencias: ';
			$conasistencias = mysql_query ($asistencias, $conexionmarquee)or die (mysql_error());
			for ($a=0; $a<3; $a++) {
				
				$resasistencias = mysql_fetch_array ($conasistencias);
				$str= $str . '<img  width="19" height="19" src="' . $resasistencias['foto'] . '"/>' . $resasistencias['jugador'] . " " . $resasistencias['sum(e.asistencias)'] . " ";
			}
			$str = $str . "</a>";
			

               break;
	       case 'Puntuaciones':	
			$puntuaciones="select e.jugador, sum(e.puntos), j.foto, round(avg(e.puntos),2) from puntuaciones e, jugadores j where temporada='" . $resultadomarquee['contenido'] . "' and j.apodo=e.jugador group by jugador ORDER BY avg(e.puntos) DESC
LIMIT 0 , 3";
			$str = '<a class="textomarquee">Valoración: ';
			$conpuntuaciones = mysql_query ($puntuaciones, $conexionmarquee)or die (mysql_error());
			for ($a=0; $a<3; $a++) {
				
				$respuntuaciones = mysql_fetch_array ($conpuntuaciones);
				$str= $str . '<img  width="19" height="19" src="' . $respuntuaciones['foto'] . '"/>' . $respuntuaciones['jugador'] . " " . $respuntuaciones['round(avg(e.puntos),2)'] . " ";
			}
			$str = $str . "</a>";
			

               break;
	       case 'Proximo':	
			$partido="select * from partidos where temporada='" . $resultadomarquee['contenido'] . "' and jugado='N' ORDER BY jornada LIMIT 0 , 1";
			$str = '<a class="textomarquee">Próximo Partido: ';
			$conpuntuaciones = mysql_query ($partido, $conexionmarquee)or die (mysql_error());
				
				$respuntuaciones = mysql_fetch_array ($conpuntuaciones);
				$str= $str . $respuntuaciones['local'] . " - " . $respuntuaciones['visitante'] . " " . $respuntuaciones['fecha'] . " " . $respuntuaciones['hora'] . " " . $respuntuaciones['lugar'];
			
			$str = $str . "</a>";
			

               break;                                             
               default:
               		$str = '<a class="textomarquee">' . $resultadomarquee['contenido'] . "</a>";
               				
               }
               $marquee[]=$str;

        }
 print implode('',$marquee);      
   }   

mysql_close($conexionmarquee);
?>