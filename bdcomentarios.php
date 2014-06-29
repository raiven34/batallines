<?php
session_start();
if (isset($_REQUEST['noticia']) && isset($_REQUEST['fecha_noticia']) && isset($_SESSION['usuario'])){
$noticia=utf8_encode($_REQUEST['noticia']);
if (!isset($_REQUEST['pagcomentario']))
{
	$pagcomentario=0;
}else{
	$pagcomentario=$_REQUEST['pagcomentario'];
}
?>
<script type="text/javascript">
<!--
$(document).ready(function(){

	$(".pag").click(function(){
		numcom = $(this).attr('id');
		pagcom = $(this).attr('title');
		datos = "&noticia=<?PHP 
		echo $noticia;
		?>&fecha_noticia=<?PHP echo $_REQUEST['fecha_noticia']; ?>&paginaactual=" + pagcom + "&pagcomentario=" + numcom;
		$.get("bdcomentarios.php",datos, function(resultado) {  
			$("#comentarios").html(resultado);
		});
	});	
	
});
</script>
<?php
// Conectar con el servidor de base de datos

date_default_timezone_set('Europe/Madrid');
include('conexion.php');
// Compruebo parametros

if (isset($_REQUEST['texto']) && $_REQUEST['texto']!=''){
	$texto=str_replace("\n","<br />",$_REQUEST['texto']);
	$quecomentarios= "insert into comentarios (noticia,fecha_noticia,texto,autor,fecha)values('" . $_REQUEST['noticia'] . "','" . $_REQUEST['fecha_noticia'] . "','" . $texto . "','" . $_SESSION['usuario'] . "','" . date("Y-m-d H:i:s") . "')";
	$rescomentarios = mysql_query($quecomentarios, $conexion) or die(mysql_error());
}
if(isset($_REQUEST['paginaactual'])){
	$paginaactual=$_REQUEST['paginaactual'];
}else{
	$paginaactual=1;
}
$quecomentarios= "select c.autor, c.noticia, c.texto, c.fecha_noticia, c.fecha, j.foto, j.jugador from comentarios c, jugadores j where c.noticia='" . $_REQUEST['noticia'] . "' and j.apodo=c.autor and c.fecha_noticia='" . $_REQUEST['fecha_noticia'] . "' order by fecha";
$rescomentarios = mysql_query($quecomentarios, $conexion) or die(mysql_error());
$ncomentariostot = mysql_num_rows ($rescomentarios);

if ($ncomentariostot>0){
	
	$quecomentarios= "select c.autor, c.noticia, c.texto, c.fecha_noticia, c.fecha, j.foto, j.jugador from comentarios c, jugadores j where c.noticia='" . $_REQUEST['noticia'] . "' and j.apodo=c.autor and c.fecha_noticia='" . $_REQUEST['fecha_noticia'] . "' order by fecha desc limit " . $pagcomentario . ",10";
	$rescomentarios = mysql_query($quecomentarios, $conexion) or die(mysql_error());
	$ncomentarios = mysql_num_rows ($rescomentarios);
	$npaginas = $ncomentariostot / 10;
	if ($ncomentariostot % 10 !=0){
		$npaginas++;
	}
	
	for($i=1; $i<=$ncomentarios; $i++){
		$veccomentarios = mysql_fetch_array ($rescomentarios);
	print('		<div class="regcomentarios">
			<div class="fichacom">
				<table>
					<tr><td><img width="60" height="60" src="' . $veccomentarios['foto'] . '" /></td></tr>
					<tr><td><a class="autor">' . $veccomentarios['autor'] . '</a></td></tr>
					<tr><td><a class="fecha">' . $veccomentarios['fecha'] . '</a></td></tr>
				</table>
			</div>
			<div class="textocom">' . $veccomentarios['texto'] . '</div>															
		</div>');
	
		
	}
	print(' 	<div class="paginacion"><table cellspacing="5" align="center"><tr>');
	
	for($e=0; $e<intval($npaginas); $e++){
		$p = $e + 1;
		$reg=$e*10;
		if ( $paginaactual!=$p){
			print('		<td><a  title="' . $p . '" class="pag" id="' . $reg . '">' . $p . '</a></td>' . "\n");
		}else{
			print('		<td><a  title="' . $p . '" class="pagsel" id="' . $reg . '">' . $p . '</a></td>' . "\n");
		}
	}
	
	print('		</tr></table></div>');
	mysql_close($conexion);
}		
}else{
echo('<a class="resultado">Debes hacer login para ver/escribir comentarios</a>');
}


?>