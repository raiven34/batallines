<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$conexion = mysql_connect("mysql.webcindario.com", "batallines", "plakaplaka");
mysql_select_db("batallines", $conexion);
$queEmp = "INSERT INTO noticias (titulo,texto,fecha,imagen,autor) VALUES ('" . $_REQUEST['titulo'] . "','" . $_REQUEST['texto'] . "','" . $_REQUEST['fecha'] . "','" . $_REQUEST['imagen'] . "','" . $_REQUEST['autor'] . "')";
$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
mysql_close($conexion);
include("publicarnoticias.php");
?>
</body>
</html>