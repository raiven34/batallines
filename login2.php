<?php
session_start();
if (isset($_REQUEST["usuario"]) && isset($_REQUEST["pass"])){
	if ($_REQUEST["usuario"]=='batallines' && $_REQUEST["pass"]=='2222'){
		$_SESSION["autentificado"]= "SI";
		header("Location: adminbatallines.php");
	}else{
		header("Location: formulariologin.php?error");
	}
}else{
echo 'Parametros incorrectos';
}
?>