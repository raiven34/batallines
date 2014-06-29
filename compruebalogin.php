<?php
session_start();
if (isset($_REQUEST["usuario"]) && isset($_REQUEST["pass"])){
	
	include('conexion.php');
	$queEmp = "SELECT * from jugadores where apodo='" . $_REQUEST["usuario"] . "' AND password='" . $_REQUEST["pass"] . "'";
	$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
	$registros = mysql_affected_rows();
	$_SESSION["usuario"]= $_REQUEST["usuario"];
	if ($registros!=0){
		$jugador = mysql_fetch_array ($resEmp);
		$_SESSION["autentificado"]= "SI";
		$_SESSION["rango"]= $jugador['rango'];
		$_SESSION["foto"]= $jugador['foto'];
		$_SESSION["url"]=$_SERVER['HTTP_REFERER'];
		$mensaje="Login correcto";
		include('logbatallines.php');
		$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_REQUEST["usuario"] . "','Login','Login Correcto')";
		$reslog = mysql_query($quelog, $conexion) or die(mysql_error());
		mysql_close($conexion);
		header("Location: votacion.php");
	}else{
		$mensaje="Login incorrecto";
		include('logbatallines.php');
		$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_REQUEST["usuario"] . "','Login','Login Incorrecto')";
		$reslog = mysql_query($quelog, $conexion) or die(mysql_error());
		mysql_close($conexion);
		header("Location: loginvota.php?error");
	}
}else{
echo 'Parametros incorrectos';
}
?>