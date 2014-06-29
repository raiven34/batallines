<?PHP
include('seguridadvota.php');
			   // Conectar con el servidor de base de datos
				  
include('conexion.php');
			   // Calcular última jornada
				  $instruccion = "select * from partidos where jugado='S' order by temporada desc, jornada desc limit 1";
				  $consulta = mysql_query ($instruccion, $conexion)
					 or die ('<a class="resultado" >Fallo en la consulta</a>');
				  $resultado = mysql_fetch_array ($consulta);
				  $jornada = $resultado['jornada'];
				  $temporada = $resultado['temporada'];
			   // Calcular el n?mero de jugadores
				  $instruccion = " select e.jornada,e.temporada,e.jugador, e.nopresentado, e.goles, e.amarillas, e.rojas, j.apodo, j.foto  from estadisticas e, jugadores j where temporada='" . $temporada . "' AND jornada=" . $jornada . " and e.jugador=j.apodo and e.nopresentado='' and j.apodo<>'" . $_SESSION['usuario'] . "' group by e.jugador";
				  $consulta = mysql_query ($instruccion, $conexion)
					 or die ('<a class="resultado" >Fallo en la consulta</a>');
				  $nfilas = mysql_num_rows ($consulta);		  
	   for ($i=0; $i<$nfilas; $i++) {
	   		$resultado = mysql_fetch_array ($consulta);
			$ptos= $_REQUEST['val' . $resultado['apodo']] + 1;
			$alta = "insert into puntuaciones (votante,jugador,puntos,jornada,temporada) values('" . $_SESSION["usuario"] . "','" . $resultado['apodo'] . "'," . $ptos .  ",'" . $jornada . "','" . $temporada . "')";
			$inserta = mysql_query ($alta, $conexion)or die ('<a class="resultado" >Ya has votado esta semana</a>');
			
			
	   }
	   $mensaje=$_SESSION["usuario"] . " pone nota a la jornada " . $jornada . " temporada " . $temporada;
	   include('logbatallines.php');
	   $quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_SESSION["usuario"] . "','Puntuar','" . $mensaje . "')";
	   $reslog = mysql_query($quelog, $conexion) or die(mysql_error());     	   
	   echo('<a class="resultado" >Voto Guardado</a>');
	   mysql_close($conexion);
?>