<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<?PHP

include('conexion.php');

$quetemp="select * from temporadas order by temporada desc";

$restemp = mysql_query($quetemp, $conexion) or die(mysql_error());

$regtemp = mysql_affected_rows();

if(isset($_REQUEST['temp']) && $_REQUEST['temp']!=''){

	$temp=$_REQUEST['temp'];

	$quepartidos="SELECT * FROM partidos WHERE temporada =  '". $temp ."' order by temporada desc";

}else{

$temp='';

$quepartidos = "SELECT * FROM partidos order by temporada desc";
}

$respartidos = mysql_query($quepartidos, $conexion) or die(mysql_error());

$regpartidos = mysql_affected_rows();



?>

<script type="text/javascript">

	function detalle_partido(jornada,temporada){

		//			$("#cargando").css("display", "inline");

			$.get("calcula_detalle_partido.php",{jornada:"" + jornada, temp:"" + temporada},function(datos){

               			$("#vmodal").html(datos);

						$("#vmodal").attr("style","display:block;position:fixed;");

						$("#miVentana").attr("style","display:block");
						
						$( "#vmodal" ).animate({
							opacity: 1
						  }, 300, function() {
							// Animation complete.
						});
						$("#vmodal img").fadeOut(1);
						$("#vmodal img").fadeIn(1000);

//				$("#cargando").css("display", "none");

            		});

	}

	$(document).ready(function(){

		var idtr = "";

		$("#myTable").tablesorter( {sortList: [[1,1],[0,1]],widthFixed: false, widgets: ['zebra']} );

//		$("#myTable tr").click(function(){							

//			$("#divcargando").css("display", "none");

//			$("#myTable tr").removeClass('oddclick');

//			if (idtr !=""){

//				$("#" + idtr).removeClass('oddclick');

//			}

//			idtr = this.id;

//			$(this).addClass('oddclick');

//			$("#cargando").css("display", "inline");

//			$.get("detalle_partidos.php",{jugador:this.id, temp:"<?PHP echo($temp); ?>"},function(datos){

//               		$("#divgraficas").html(datos);

//				$("#cargando").css("display", "none");

//            		});

//

//

//        	});		

//		$("#myTable tr").mouseover(function(){							

//			if ($(this).attr('class')!='even oddclick' && $(this).attr('class')!='odd oddclick'){

//				$(this).addClass('oddmouseover');

//			}

//        	});

//		$("#myTable tr").mouseout(function(){							

//				$(this).removeClass('oddmouseover');

//        	});

        	$("#combotemp").change(function(){							

				$.get("calcula_partidos.php",{temp:$("#combotemp").attr('value')}, function(resultado) {  

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

	    <th>JORNADA</th>

	    <th>TEMPORADA</th>

	    <th>LOCAL</th>

	    <th>VISITANTE</th>

	    <th>RESULTADO</th>

	    <th>FECHA</th>
	    
	    <th>HORA</th>	    

        <th>DETALLE</th>

	    

	

	</tr>

	</thead>

	<tbody>

<?PHP

for ($d=0; $d<$regpartidos; $d++) {

	$subpartidos = mysql_fetch_array ($respartidos);
        if($subpartidos['local']=="BATALLINES FC" ){
            if($subpartidos['goleslocal']>$subpartidos['golesvisitante']){
                $resultado="G";
            }elseif($subpartidos['goleslocal']==$subpartidos['golesvisitante']){
                $resultado="E";
            }else{
                $resultado="P";
            }
        }else{
            if($subpartidos['goleslocal']>$subpartidos['golesvisitante']){
                $resultado="P";
            }elseif($subpartidos['goleslocal']==$subpartidos['golesvisitante']){
                $resultado="E";
            }else{
                $resultado="G";
            }            
        }
	

//	if(isset($_REQUEST['temp']) && $_REQUEST['temp']!=''){

//		$queestadisticas="select * from estadisticas where jugador='" . $subpartidos['apodo']. "' and nopresentado='' and temporada='" . $temp . "'";

//	}else{	

//		$queestadisticas="select count(*) from estadisticas where jugador='" . $subpartidos['apodo']. "' and nopresentado=''";

//	}

//	$resestadisticas = mysql_query($queestadisticas, $conexion) or die(mysql_error());

//	$subestadisticas = mysql_fetch_array ($resestadisticas);

?>	

	<tr id="<?PHP echo($subpartidos['jornada']);?>"  name="<?PHP echo($subpartidos['jornada']);?>">
<? if($subpartidos['jugado']=="S"){?>
    <? if($resultado=="G"){?>
            <td style="color:#38D111;"> <?PHP echo($subpartidos['jornada']);?></td><td style="color:#38D111;"><?PHP echo($subpartidos['temporada']);?></td><td style="color:#38D111;"><?PHP echo($subpartidos['local']);?></td><td style="color:#38D111;"><?PHP echo($subpartidos['visitante']);?></td><td style="color:#38D111;"><?PHP echo($subpartidos['goleslocal'] . ' - ' . $subpartidos['golesvisitante']);?></td><td style="color:#38D111;"><?PHP echo($subpartidos['fecha']);?></td><td style="color:#38D111;"><?PHP echo($subpartidos['hora']);?></td><td><img title="Ver detalle" width="20" src="estadisticas.jpg" onclick=detalle_partido("<?PHP echo($subpartidos['jornada']);?>","<?PHP echo($subpartidos['temporada']);?>") /></td>
    <?}else if($resultado=="E"){?>
            <td style="color: #AEBD40;"> <?PHP echo($subpartidos['jornada']);?></td><td style="color: #AEBD40;"><?PHP echo($subpartidos['temporada']);?></td><td style="color: #AEBD40;"><?PHP echo($subpartidos['local']);?></td><td style="color: #AEBD40;"><?PHP echo($subpartidos['visitante']);?></td><td style="color: #AEBD40;"><?PHP echo($subpartidos['goleslocal'] . ' - ' . $subpartidos['golesvisitante']);?></td><td style="color: #AEBD40;"><?PHP echo($subpartidos['fecha']);?></td><td style="color: #AEBD40;"><?PHP echo($subpartidos['hora']);?></td><td><img title="Ver detalle" width="20" src="estadisticas.jpg" onclick=detalle_partido("<?PHP echo($subpartidos['jornada']);?>","<?PHP echo($subpartidos['temporada']);?>") /></td>
    <?}else{?>
            <td style="color: #C93F3F;"> <?PHP echo($subpartidos['jornada']);?></td><td style="color: #C93F3F;"><?PHP echo($subpartidos['temporada']);?></td><td style="color: #C93F3F;"><?PHP echo($subpartidos['local']);?></td><td style="color: #C93F3F;"><?PHP echo($subpartidos['visitante']);?></td><td style="color: #C93F3F;"><?PHP echo($subpartidos['goleslocal'] . ' - ' . $subpartidos['golesvisitante']);?></td><td style="color: #C93F3F;"><?PHP echo($subpartidos['fecha']);?></td><td style="color: #C93F3F;"><?PHP echo($subpartidos['hora']);?></td><td><img title="Ver detalle" width="20" src="estadisticas.jpg" onclick=detalle_partido("<?PHP echo($subpartidos['jornada']);?>","<?PHP echo($subpartidos['temporada']);?>") /></td>
    <?}?>
<?}else{?>
        <td> <?PHP echo($subpartidos['jornada']);?></td><td><?PHP echo($subpartidos['temporada']);?></td><td><?PHP echo($subpartidos['local']);?></td><td><?PHP echo($subpartidos['visitante']);?></td><td><?PHP echo($subpartidos['goleslocal'] . ' - ' . $subpartidos['golesvisitante']);?></td><td><?PHP echo($subpartidos['fecha']);?></td><td><?PHP echo($subpartidos['hora']);?></td><td><img title="Ver detalle" width="20" src="estadisticas.jpg" onclick=detalle_partido("<?PHP echo($subpartidos['jornada']);?>","<?PHP echo($subpartidos['temporada']);?>") /></td>
<?}?>
        </tr>

<?PHP

}

?> 	

	</tbody>

</table> 

<?PHP

mysql_close($conexion);

?>

                   