<?PHP

include('conexion.php');
   // Calcular �ltima jornada
				  $instruccion = "select * from partidos where jugado='S' order by temporada desc, jornada desc limit 1";
				  $consulta = mysql_query ($instruccion, $conexion)
					 or die ("Fallo en la consulta");
				  $resultado = mysql_fetch_array ($consulta);
				  $jornada = $resultado['jornada'];
				  $local = $resultado['local'];
				  $visitante = $resultado['visitante'];
				  $goleslocal = $resultado['goleslocal'];
				  $golesvisitante = $resultado['golesvisitante'];
				  $temporada = $resultado['temporada'];
			   // Calcular el n?mero de jugadores

                                  $instruccion = " select j.correo, e.jornada,e.temporada,e.jugador, e.nopresentado, e.goles, e.amarillas, e.rojas, j.apodo, j.foto  from estadisticas e, jugadores j where e.temporada='" . $temporada . "' AND e.jornada=" . $jornada . " and e.jugador=j.apodo and e.nopresentado='' and e.jugador not in(select distinct(votante) from puntuaciones where jornada='" . $jornada . "' and temporada='" . $temporada . "') group by e.jugador";
				  $consulta = mysql_query ($instruccion, $conexion)
					 or die ("Fallo en la consulta");
				  $nfilas = mysql_num_rows ($consulta);

					  				  
			
	   $destinatario="";	
	   for ($i=0; $i<$nfilas; $i++) {
		   	$resultado = mysql_fetch_array ($consulta);
			$asunto="Puntua �ltima jornada";
                        $destinatario.=$resultado['correo'] . ",";
                        $texto="<p>A�n no has puesto nota a la �ltima jornada:</p><p>" . $local . " " . $goleslocal . "-" . $golesvisitante . " " . $visitante . "</p><p>Puedes poner nota haciendo click <a href='http://batallines.es/votacion.php'>aqu�</a></p>";
	   }
	   include("mail.php");
	   echo $destinatario;

		  
		   
	   mysql_close($conexion);
?>
