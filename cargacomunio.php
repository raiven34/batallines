<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CargaComunio</title>
<link href="css/estilosweb.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?PHP
include("conexioncomunio.php"); 
$texto = split("\n",$_REQUEST['texto']);
$nfilas = count($texto);
for ($i=0; $i<$nfilas; $i++) {
	if(strlen($texto[$i])>1){
		$concepto=split(" cambia",$texto[$i]);
		$conceptos[]=$concepto[0];
		$importe=str_replace(" por ","",$concepto[1]);
		$importe=split(" de ",$importe);
		$importe=str_replace(" ?","",$importe);
		$importe=str_replace(".","",$importe);
		$importes[]=$importe[0];
		$vendedor=split(" a ",$importe[1]);
		$vendedores[]=$vendedor[0];
		$comprador=chop($vendedor[1]);
		$comprador=str_replace(".","",$comprador);
		$compradores[]=$comprador;
		
		
	}				
}
$ntransac = count($conceptos);
$fecha = date("Y-m-d");
for ($i=0; $i<$ntransac; $i++) {
	$query="INSERT INTO transacciones (comprador,vendedor,importe,fecha,concepto) VALUES ('" . $compradores[$i] . "','" . $vendedores[$i] . "'," . $importes[$i] . ",'" . $fecha . "','" . $conceptos[$i] . "')" ;
	$resEmp = mysql_query($query, $conexion) or die(mysql_error());
}
mysql_close($conexion);
?>
<a href="comunio.html">Volver</a>
</body>
</html>