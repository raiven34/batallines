<?PHP
include('conexion.php');
$quetemp="select * from temporadas order by temporada";
$restemp = mysql_query($quetemp, $conexion) or die(mysql_error());
$regtemp = mysql_affected_rows();
if(isset($_REQUEST['temp']) && $_REQUEST['temp']!=''){
	$temp=$_REQUEST['temp'];
}else{
$temp='';
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title>Charting</title>
	<script type="text/javascript" src="http://filamentgroup.github.com/EnhanceJS/enhance.js"></script>	
	<script type="text/javascript">
		// Run capabilities test
		$(document).ready(function(){
			$("#cerrar").click(function(){
						$("#vmodal").attr("style","display:none;");
						$("#miVentana").attr("style","display:none");
			});
		});
		enhance({
			loadScripts: [
				{src: 'graficas/js/excanvas.js', iecondition: 'all'},
				'graficas/js/visualize.jQuery.js',
				'graficas/js/example.js'
			],
			loadStyles: [
				'graficas/css/visualize.css',
				'graficas/css/visualize-light.css'
			]	
		});   
    </script>
</head>
<body>

<table id="tabla" name="tabla" class="tablagraf" align="center">
	<caption><?PHP echo($_REQUEST['jugador']);?></caption>

    <thead>
		<tr>
			<td></td>
<?PHP
if($temp==''){
for ($d=0; $d<$regtemp; $d++) {
	$subtemp = mysql_fetch_array ($restemp);
?>
			<th scope="col"><?PHP echo($subtemp['temporada']); ?></th>
<?PHP
}
?>
		</tr>
	</thead>
	<tbody>

		<tr>
			<th scope="row">Partidos Jugados</th>
<?PHP
$restemp = mysql_query($quetemp, $conexion) or die(mysql_error());

for ($d=0; $d<$regtemp; $d++) {
	$subtemp = mysql_fetch_array ($restemp);
	$quepartidos = "SELECT count(*) from estadisticas where jugador='" . $_REQUEST['jugador'] . "' and temporada='" . $subtemp['temporada'] . "' and nopresentado=''  order by temporada";
	$respartidos = mysql_query($quepartidos, $conexion) or die(mysql_error());
	$subpartidos = mysql_fetch_array ($respartidos);
?>			
            <td><?PHP if($subpartidos['count(*)']!=''){echo($subpartidos['count(*)']);}else{echo("0");} ?></td>
<?PHP
}
?>
		</tr>
		<tr>
			<th scope="row">Goles</th>
<?PHP
$restemp = mysql_query($quetemp, $conexion) or die(mysql_error());

for ($d=0; $d<$regtemp; $d++) {
	$subtemp = mysql_fetch_array ($restemp);
	$quegoles = "SELECT jugador, sum(goles), temporada from estadisticas where jugador='" . $_REQUEST['jugador'] . "' and temporada='" . $subtemp['temporada'] . "' order by temporada";
	$resgoles = mysql_query($quegoles, $conexion) or die(mysql_error());
	$subgoles = mysql_fetch_array ($resgoles);
?>			
            <td><?PHP if($subgoles['sum(goles)']!=''){echo($subgoles['sum(goles)']);}else{echo("0");} ?></td>
<?PHP
}
?>
		</tr>
		<tr>
			<th scope="row">Amarillas</th>
<?PHP
$restemp = mysql_query($quetemp, $conexion) or die(mysql_error());

for ($d=0; $d<$regtemp; $d++) {
	$subtemp = mysql_fetch_array ($restemp);
	$queamarillas = "SELECT jugador, sum(amarillas), temporada from estadisticas where jugador='" . $_REQUEST['jugador'] . "' and temporada='" . $subtemp['temporada'] . "' order by temporada";
	$resamarillas = mysql_query($queamarillas, $conexion) or die(mysql_error());
	$subamarillas = mysql_fetch_array ($resamarillas);
?>			
            <td><?PHP if($subamarillas['sum(amarillas)']!=''){echo($subamarillas['sum(amarillas)']);}else{echo("0");} ?></td>
<?PHP
}
?>
		</tr>
		<tr>
			<th scope="row">Rojas</th>
<?PHP
$restemp = mysql_query($quetemp, $conexion) or die(mysql_error());

for ($d=0; $d<$regtemp; $d++) {
	$subtemp = mysql_fetch_array ($restemp);
	$querojas = "SELECT jugador, sum(rojas), temporada from estadisticas where jugador='" . $_REQUEST['jugador'] . "' and temporada='" . $subtemp['temporada'] . "' order by temporada";
	$resrojas = mysql_query($querojas, $conexion) or die(mysql_error());
	$subrojas = mysql_fetch_array ($resrojas);
?>			
            <td><?PHP if($subrojas['sum(rojas)']!=''){echo($subrojas['sum(rojas)']);}else{echo("0");} ?></td>
<?PHP
}


}else{

$quejor="select distinct(jornada) from estadisticas where temporada='" . $temp . "' order by jornada";
$resjor = mysql_query($quejor, $conexion) or die(mysql_error());
$regjor = mysql_affected_rows();
for ($d=0; $d<$regjor; $d++) {
	$subjor = mysql_fetch_array ($resjor);
?>
			<th scope="col">J<?PHP echo($subjor['jornada']); ?></th>
<?PHP
}
?>
		</tr>
	</thead>
	<tbody>

		<tr>
			<th scope="row">Goles</th>
<?PHP
$resjor = mysql_query($quejor, $conexion) or die(mysql_error());

for ($d=0; $d<$regjor; $d++) {
	$subjor = mysql_fetch_array ($resjor);
	$quegoles = "SELECT goles from estadisticas where jugador='" . $_REQUEST['jugador'] . "' and temporada='" . $temp . "' and jornada='" . $subjor['jornada'] . "' order by jornada";
	$resgoles = mysql_query($quegoles, $conexion) or die(mysql_error());
	$subgoles = mysql_fetch_array ($resgoles);
?>			
            <td><?PHP if($subgoles['goles']!=''){echo($subgoles['goles']);}else{echo("0");} ?></td>
<?PHP
}
?>
		</tr>
		<tr>
			<th scope="row">Amarillas</th>
<?PHP
$resjor = mysql_query($quejor, $conexion) or die(mysql_error());

for ($d=0; $d<$regjor; $d++) {
	$subjor = mysql_fetch_array ($resjor);
	$queamarillas = "SELECT  amarillas from estadisticas where jugador='" . $_REQUEST['jugador'] . "' and temporada='" . $temp . "'  and jornada='" . $subjor['jornada'] . "' order by jornada";
	$resamarillas = mysql_query($queamarillas, $conexion) or die(mysql_error());
	$subamarillas = mysql_fetch_array ($resamarillas);
?>			
            <td><?PHP if($subamarillas['amarillas']!=''){echo($subamarillas['amarillas']);}else{echo("0");} ?></td>
<?PHP
}
?>
		</tr>
		<tr>
			<th scope="row">Rojas</th>
<?PHP
$resjor = mysql_query($quejor, $conexion) or die(mysql_error());

for ($d=0; $d<$regjor; $d++) {
	$subjor = mysql_fetch_array ($resjor);
	$querojas = "SELECT rojas from estadisticas where jugador='" . $_REQUEST['jugador'] . "' and temporada='" . $temp . "'  and jornada='" . $subjor['jornada'] . "' order by jornada";
	$resrojas = mysql_query($querojas, $conexion) or die(mysql_error());
	$subrojas = mysql_fetch_array ($resrojas);
?>			
            <td><?PHP if($subrojas['rojas']!=''){echo($subrojas['rojas']);}else{echo("0");} ?></td>
<?PHP
}
?>
		</tr>
		<tr>
			<th scope="row">Asistencias</th>
<?PHP
$resjor = mysql_query($quejor, $conexion) or die(mysql_error());

for ($d=0; $d<$regjor; $d++) {
	$subjor = mysql_fetch_array ($resjor);
	$queasistencias = "SELECT asistencias from estadisticas where jugador='" . $_REQUEST['jugador'] . "' and temporada='" . $temp . "'  and jornada='" . $subjor['jornada'] . "' order by jornada";
	$resasistencias = mysql_query($queasistencias, $conexion) or die(mysql_error());
	$subasistencias = mysql_fetch_array ($resasistencias);
?>			
            <td><?PHP if($subasistencias['asistencias']!=''){echo($subasistencias['asistencias']);}else{echo("0");} ?></td>
<?PHP
}
}
?>
		</tr>

	</tbody>
</table>	
<div><a id="cerrar" class="enlace">Cerrar</a><div>
</body>
</html>
<?PHP
mysql_close($conexion);
?>