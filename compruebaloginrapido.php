<script type="text/javascript">
<!--
$(document).ready(function(){
	$("#entrar").click(function(){
		var datos = $("#formlogin").serialize();
		$.get("compruebaloginrapido.php",datos, function(resultado) {  
			$("#login").html(resultado);
                        location.reload();
		});
	        
	});
	$("#salir").click(function(){
		$.get("compruebaloginrapido.php","desconexion", function(resultado) {  
			$("#login").html(resultado);
                        location.reload();
		});
	
	});
});
//-->
</script>
<?php
@session_start();
if(!isset($_SESSION["autentificado"])){

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
			$estado="conectado";
		}else{
			$mensaje="Login incorrecto";
			include('logbatallines.php');
			$quelog = "INSERT INTO log (usuario,tipo,mensaje) VALUES ('" . $_REQUEST["usuario"] . "','Login','Login Incorrecto')";
			$reslog = mysql_query($quelog, $conexion) or die(mysql_error());		
			$estado="desconectado";
			
		}
	mysql_close($conexion);
	}else{
		$estado="desconectado";	
	}
}else{
	if(isset($_REQUEST["desconexion"])){
		session_destroy();
		$estado="desconectado";		
	}else{
		$estado="conectado";
	}
}

if ($estado=="conectado"){
	print('            <a class="usuario">' . $_SESSION["usuario"] . '</a><img title="Salir" class="entrar_salir" id="salir" width="18" height="18" src="img/gnome_session_logout.png" />');
}else{
	print('            <form id="formlogin" method="post" enctype="multipart/form-data">Usuario<input id="usuario" name="usuario" type="text" class="input" size="10"></input>Clave<input id="pass" name="pass" type="password" class="input" size="10"></input><img title="Entrar" class="entrar_salir" id="entrar" width="20" height="20" src="img/flecha-derecha.png" /></form>');
}	
?>	