<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Publicar contenidos</title>
<link href="css/estilosweb.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?PHP 
include('seguridad.php');
if($_SESSION["rango"]>1){
include('publicarjugadores.php');
print("<BR/>");
include('publicarestadisticas.php');
print("<BR/>"); 
$mensaje="Publicar";
include('logbatallines.php');
}else{
	print ("No tienes permiso");	
}
?>

<a href="adminbatallines.php">Volver</a>
</body>
</html>