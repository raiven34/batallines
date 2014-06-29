<?PHP
include('conexion.php');
$quetemp="select * from temporadas order by temporada desc";
$restemp = mysql_query($quetemp, $conexion) or die(mysql_error());
$regtemp = mysql_affected_rows();
if(isset($_REQUEST['temp']) && $_REQUEST['temp']!=''){
	$temp=$_REQUEST['temp'];
	$queest="SELECT j.foto, j.apodo, e.jugador, SUM( e.goles ) , SUM( e.amarillas ) , SUM( e.rojas ), SUM( e.asistencias ) FROM jugadores j, estadisticas e WHERE temporada =  '". $temp ."' AND j.apodo = e.jugador GROUP BY j.apodo";
}else{
$temp='';
$queest = "SELECT j.foto, j.apodo, e.jugador, SUM( e.goles ) , SUM( e.amarillas ) , SUM( e.rojas ), SUM( e.asistencias ) FROM jugadores j, estadisticas e WHERE j.apodo = e.jugador GROUP BY j.apodo";	
}
$resest = mysql_query($queest, $conexion) or die(mysql_error());
$regest = mysql_affected_rows();

?>
<script type="text/javascript">
	function grafica(jug){
		//			$("#cargando").css("display", "inline");
			$.get("calcula_grafica.php",{jugador:"" + jug, temp:"<?PHP echo($temp); ?>"},function(datos){
               			$("#vmodal").html(datos);
						$("#vmodal").attr("style","display:block;position:fixed;");
						$("#miVentana").attr("style","display:block");
						$( "#vmodal" ).animate({
							opacity: 1
						  }, 300, function() {
							// Animation complete.
						});
												
//				$("#cargando").css("display", "none");
            		});
	}
	$(document).ready(function(){
		var idtr = "";
		$("#myTable").tablesorter( {sortList: [[1,0]],widthFixed: false, widgets: ['zebra']} );
//		$("#myTable tr").click(function(){							
//			$("#divcargando").css("display", "none");
//			$("#myTable tr").removeClass('oddclick');
//			if (idtr !=""){
//				$("#" + idtr).removeClass('oddclick');
//			}
//			idtr = this.id;
//			$(this).addClass('oddclick');
//
//
//
//        	});		
//		$("#myTable tr").mouseover(function(){							
//			if ($(this).attr('class')!='even oddclick' && $(this).attr('class')!='odd oddclick'){
//				$(this).addClass('oddmouseover');
//			}
//        });
//		$("#myTable tr").mouseout(function(){							
//				$(this).removeClass('oddmouseover');
//        	});
        	$("#combotemp").change(function(){							
				$.get("calcula_estadisticas.php",{temp:$("#combotemp").attr('value')}, function(resultado) {  
					$('#divestadisticas').html(resultado);
//					$("#cargando").css("display", "none");
				});
		});

							
	});
</script>
                    	<select class="combo" name="combotemp" id="combotemp">
                    		<option value=''>Todas las temporadas</option>
<?PHP
for ($d=0; $d<$regtemp; $d++) {
	$subtemp = mysql_fetch_array ($restemp);
?>				
				<option value='<?PHP echo($subtemp['temporada']);?>' <?PHP if ($subtemp['temporada']==$temp){ echo (" SELECTED");} ?>><?PHP echo($subtemp['temporada']);?></option>
<?PHP
}
?> 
			</select>  

<table id="myTable" cellspacing="0" class="tablesorter" align="center">
	<thead>
	<tr>
	    <th id="id" name="0">FOTO</th>
	    <th id="nombre" name="1">NOMBRE</th>
	    <th id="nombre" name="1">PARTIDOS</th>
	    <th id="importe" name="2">VALORACIÓN</th>
	    <th id="importe" name="2">GOLES</th>
	    <th id="importe" name="2">ASISTENCIAS</th>
	    <th id="importe" name="2">AMARILLAS</th>
	    <th id="importe" name="2">ROJAS</th>
        <th id="importe" name="2">GRÁFICA</th>
	    
	
	</tr>
	</thead>
	<tbody>
<?PHP
for ($d=0; $d<$regest; $d++) {
	$subest = mysql_fetch_array ($resest);
	if(isset($_REQUEST['temp']) && $_REQUEST['temp']!=''){
		$quepart="select count(*) from estadisticas where jugador='" . $subest['apodo']. "' and nopresentado='' and temporada='" . $temp . "'";
		$quepunt="select jugador, round(avg(puntos),2) from puntuaciones where jugador='" . $subest['apodo'] . "' and temporada='" . $temp . "'";
	}else{	
		$quepart="select count(*) from estadisticas where jugador='" . $subest['apodo']. "' and nopresentado=''";
		$quepunt="select jugador, round(avg(puntos),2) from puntuaciones where jugador='" . $subest['apodo'] . "'";
	}
	$respart = mysql_query($quepart, $conexion) or die(mysql_error());
	$subpart = mysql_fetch_array ($respart);
	$respunt = mysql_query($quepunt, $conexion) or die(mysql_error());
	$subpunt = mysql_fetch_array ($respunt);
?>	
	<tr id="<?PHP echo($subest['apodo']);?>"  name="<?PHP echo($subest['apodo']);?>">
	<td><img width="20" height="20" src='<?PHP echo($subest['foto']);?>'/></td><td><?PHP echo($subest['apodo']);?></td><td><?PHP echo($subpart['count(*)']);?></td><td><?PHP echo($subpunt['round(avg(puntos),2)']);?></td><td><?PHP echo($subest['SUM( e.goles )']);?></td><td><?PHP echo($subest['SUM( e.asistencias )']);?></td><td><?PHP echo($subest['SUM( e.amarillas )']);?></td><td><?PHP echo($subest['SUM( e.rojas )']);?></td><td><img width="20" title="ver gr&aacute;fica" src="estadisticas.jpg" onclick="grafica('<?PHP echo($subest['apodo']);?>')" /></td>
	</tr>
<?PHP
}
?> 	
	</tbody>
</table> 
<?PHP
mysql_close($conexion);
?>
                   