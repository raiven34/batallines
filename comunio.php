<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Comunio</title>
<link href="css/estilosweb.css" rel="stylesheet" type="text/css" />
</head>
<?PHP
include("conexioncomunio.php");
$query="SELECT * FROM transacciones order be fecha desc limit 1" 
$consulta = mysql_query($query, $conexion) or die(mysql_error());
$resultado = mysql_fetch_array ($consulta);
$ultima=$resultado['fecha'];
$query="SELECT * FROM transacciones order be fecha desc" 
$consulta = mysql_query($query, $conexion) or die(mysql_error());
nfilas = mysql_num_rows ($consulta);
$managers = array("nombre","importe");
for ($i=0; $i<$nfilas; $i++) {
   
            $resultado = mysql_fetch_array ($consulta);
}
?>
<body>
	<a>Última actualización <?PHP $ultima ?></a>
	<form id="formcomunio" method="post" action="cargacomunio.php" enctype="multipart/form-data">
		<textarea name="texto" id="texto" cols="45" rows="5"></textarea>
		<input type="submit" value="cargar"></input>
	</form>


<?PHP
mysql_close($conexion);
?>
</body>
</html>